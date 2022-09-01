<?php

namespace App\TravelHelper\User\Action;

use App\Models\User;
use App\Repository\UserRepository;
use App\TravelHelper\User\Contract\UserCreateDataInterface;
use Exception;
use Illuminate\Support\Facades\Hash;

class UserCreateAction
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @throws Exception
     */
    public function run(UserCreateDataInterface $dto): void
    {
        $user = $this->userRepository->getByEmail($dto->getEmail());
        if ($user) {
            throw new Exception('Email already exists');
        }

        $user = new User();
        $user->first_name = $dto->getFirstName();
        $user->last_name  = $dto->getLastName();
        $user->avatar     = '/uploads/avatars/default.png';
        $user->email      = $dto->getEmail();
        $user->password   = Hash::make($dto->getPassword());

        $user->save();
    }
}
