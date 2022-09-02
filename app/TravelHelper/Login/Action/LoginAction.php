<?php

namespace App\TravelHelper\Login\Action;

use App\Infrastructure\Jwt\JwtService;
use App\Repository\UserRepository;
use App\TravelHelper\Login\AuthenticatableServiceInterface;
use App\TravelHelper\Login\Contract\CredentialDataInterface;
use App\TravelHelper\Login\Exception\LoginException;
use Exception;
use Illuminate\Support\Facades\Hash;

class LoginAction
{
    private AuthenticatableServiceInterface $authenticatableService;
    private UserRepository                  $userRepository;

    public function __construct(JwtService $jwtService, UserRepository $userRepository)
    {
        $this->authenticatableService = $jwtService;
        $this->userRepository         = $userRepository;
    }

    /**
     * @throws LoginException
     * @throws Exception
     */
    public function run(CredentialDataInterface $dto): string
    {
        $user = $this->userRepository->getByEmail($dto->getEmail());
        if (!$user) {
            throw new LoginException('Wrong email or password');
        }

        if (!Hash::check($dto->getPassword(), $user->password)) {
            throw new LoginException('Wrong email or password');
        }

        return $this->authenticatableService->encode($user);
    }
}
