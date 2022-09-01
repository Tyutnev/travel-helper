<?php

namespace App\Repository;

use App\Models\User;

class UserRepository
{
    public function getByEmail(string $email): ?User
    {
        return User::query()
            ->where('email', '=', $email)
            ->first();
    }
}
