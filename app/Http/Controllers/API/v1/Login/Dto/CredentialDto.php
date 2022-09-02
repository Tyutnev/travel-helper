<?php

namespace App\Http\Controllers\API\v1\Login\Dto;

use App\TravelHelper\Login\Contract\CredentialDataInterface;

class CredentialDto implements CredentialDataInterface
{
    private string $email;
    private string $password;

    public function __construct(string $email, string $password)
    {
        $this->email    = $email;
        $this->password = $password;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
