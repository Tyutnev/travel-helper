<?php

namespace App\Infrastructure\Jwt;

use App\TravelHelper\Login\AuthenticatableServiceInterface;
use App\TravelHelper\Login\Contract\AuthenticatableInterface;
use DateInterval;
use DateTimeImmutable;
use Exception;
use Firebase\JWT\JWT;
use LogicException;

class JwtService implements AuthenticatableServiceInterface
{
    /**
     * @throws Exception
     */
    public function encode(AuthenticatableInterface $authenticatable): string
    {
        /** @var string|null $secretKey */
        $secretKey = config('jwt.secret_key');
        if (!$secretKey) {
            throw new LogicException('Secret key not defined');
        }

        /** @var int|null $expireTime */
        $expireTime = (int) config('jwt.expire_time');
        if (!$expireTime) {
            throw new LogicException('Expire time not defined');
        }

        /** @var string|null $jwtHashAlgorithm */
        $jwtHashAlgorithm = config('jwt.jwt_hash_algorithm');
        if (!$jwtHashAlgorithm) {
            throw new LogicException('JWT hash algorithm not defined');
        }

        $iat = new DateTimeImmutable();
        $exp = $iat->add($this->getDateInterval($expireTime));

        $data = [
            'iat'     => $iat,
            'iss'     => config('app.name'),
            'nbf'     => $iat,
            'exp'     => $exp,
            'payload' => $authenticatable->getPayload()
        ];

        return JWT::encode($data, $secretKey, $jwtHashAlgorithm);
    }

    public function decode(string $token, AuthenticatableInterface $authenticatable): AuthenticatableInterface
    {
        return $authenticatable;
    }

    /**
     * @throws Exception
     */
    private function getDateInterval(int $seconds): DateInterval
    {
        return new DateInterval('PT' . $seconds . 'S');
    }
}
