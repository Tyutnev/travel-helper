<?php

namespace App\Repository;

use App\Models\User;

class UserRepository
{
    public function getById(int $id): ?User
    {
        return User::query()->find($id);
    }

    public function getByEmail(string $email): ?User
    {
        return User::query()
            ->where('email', '=', $email)
            ->first();
    }
}
