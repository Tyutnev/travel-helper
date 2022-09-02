<?php

namespace App\TravelHelper\Login\Contract;

interface CredentialDataInterface
{
    public function getEmail(): string;
    public function getPassword(): string;
}
