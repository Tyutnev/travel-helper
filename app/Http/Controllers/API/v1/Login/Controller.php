<?php

namespace App\Http\Controllers\API\v1\Login;

use App\Infrastructure\Jwt\JwtService;
use App\Repository\UserRepository;
use App\TravelHelper\Login\AuthenticatableServiceInterface;
use Exception;
use Illuminate\Http\Request;

class Controller
{
    private AuthenticatableServiceInterface $authenticatableService;
    private UserRepository                  $userRepository;

    public function __construct(
        JwtService     $jwtService,
        UserRepository $userRepository
    )
    {
        $this->authenticatableService = $jwtService;
        $this->userRepository         = $userRepository;
    }

    /**
     * @throws Exception
     */
    public function run(Request $request): void
    {

    }
}
