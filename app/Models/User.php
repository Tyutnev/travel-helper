<?php

namespace App\Models;

use DateTime;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property string        $first_name
 * @property string|null   $last_name
 * @property string        $avatar
 * @property DateTime|null $birthday
 * @property string|null   $phone
 * @property DateTime|null $phone_verified_at
 * @property string        $email
 * @property DateTime|null $email_verified_at
 * @property string        $password
 * @property string        $status
 */
class User extends Authenticatable implements MustVerifyEmail
{

}
