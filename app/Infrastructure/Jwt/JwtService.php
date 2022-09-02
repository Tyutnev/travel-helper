<?php

namespace App\Infrastructure\Jwt;

use App\Infrastructure\Jwt\Exception\JwtException;
use App\Repository\UserRepository;
use App\TravelHelper\Login\AuthenticatableServiceInterface;
use App\TravelHelper\Login\Contract\AuthenticatableInterface;
use DateInterval;
use DateTime;
use DateTimeImmutable;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use LogicException;

class JwtService implements AuthenticatableServiceInterface
{
    private ?string        $applicationName;
    private ?string        $secretKey;
    private ?int           $expireTime;
    private ?string        $jwtHashAlgorithm;
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->applicationName = config('app.name');
        if (!$this->applicationName) {
            throw new LogicException('Application name not defined');
        }

        /** @var string|null $secretKey */
        $this->secretKey = config('jwt.secret_key');
        if (!$this->secretKey) {
            throw new LogicException('Secret key not defined');
        }

        /** @var int|null $expireTime */
        $this->expireTime = (int) config('jwt.expire_time');
        if (!$this->expireTime) {
            throw new LogicException('Expire time not defined');
        }

        /** @var string|null $jwtHashAlgorithm */
        $this->jwtHashAlgorithm = config('jwt.jwt_hash_algorithm');
        if (!$this->jwtHashAlgorithm) {
            throw new LogicException('JWT hash algorithm not defined');
        }

        $this->userRepository = $userRepository;
    }

    /**
     * @throws Exception
     */
    public function encode(AuthenticatableInterface $authenticatable): string
    {
        $iat = new DateTimeImmutable();
        $exp = $iat->add($this->getDateInterval($this->expireTime));

        $data = [
            'iat'     => $iat->getTimestamp(),
            'iss'     => $this->applicationName,
            'nbf'     => $iat->getTimestamp(),
            'exp'     => $exp->getTimestamp(),
            'payload' => $authenticatable->getPayload()
        ];

        return JWT::encode($data, $this->secretKey, $this->jwtHashAlgorithm);
    }

    /**
     * @throws JwtException
     */
    public function decode(string $token): ?AuthenticatableInterface
    {
        $now   = new DateTime();
        $token = JWT::decode($token, new Key($this->secretKey, $this->jwtHashAlgorithm));

        if ($token->iss !== $this->applicationName) {
            throw new JwtException('Invalid JWT token');
        }

        if ($now->getTimestamp() > $token->exp) {
            throw new JwtException('Invalid JWT token');
        }

        $id = (int) $token->payload;
        if (!$id) {
            throw new JwtException('Invalid JWT token');
        }

        return $this->userRepository->getById($id);
    }

    /**
     * @throws Exception
     */
    private function getDateInterval(int $seconds): DateInterval
    {
        return new DateInterval('PT' . $seconds . 'S');
    }
}
