<?php

namespace App\TravelHelper\Login\Contract;

interface AuthenticatableInterface
{
    public function getPayload(): string;
}
