<?php

namespace App\Http\Requests\API\v1\Registration;

use App\Http\Controllers\API\v1\Registration\Dto\UserDto;
use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
{
    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|min:2',
            'last_name'  => 'min:2',
            'email'      => 'required|email',
            'password'   => 'required|min:8|confirmed',
        ];
    }

    public function getData(): UserDto
    {
        return (new UserDto())
            ->setFirstName($this->get('first_name'))
            ->setLastName($this->get('last_name'))
            ->setEmail($this->get('email'))
            ->setPassword($this->get('password'));
    }
}
