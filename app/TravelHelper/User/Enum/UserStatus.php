<?php

namespace App\TravelHelper\User\Enum;

enum UserStatus: string
{
    case Active = 'Active';
    case Frozen = 'Frozen';
    case Banned = 'Banned';
}
