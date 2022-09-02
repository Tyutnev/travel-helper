<?php

namespace App\TravelHelper\Login;

use App\TravelHelper\Login\Contract\AuthenticatableInterface;

interface AuthenticatableServiceInterface
{
    public function encode(AuthenticatableInterface $authenticatable): string;
    public function decode(string $token): ?AuthenticatableInterface;
}
