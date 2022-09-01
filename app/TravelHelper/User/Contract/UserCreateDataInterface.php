<?php

namespace App\TravelHelper\User\Contract;

interface UserCreateDataInterface
{
    public function getFirstName(): string;
    public function getLastName(): ?string;
    public function getEmail(): string;
    public function getPassword(): string;
}
