<?php

namespace App\Http\Requests\API\v1\Login;

use App\Http\Controllers\API\v1\Login\Dto\CredentialDto;
use App\TravelHelper\Login\Contract\CredentialDataInterface;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'email'    => 'required|email',
            'password' => 'required'
        ];
    }

    public function getData(): CredentialDataInterface
    {
        return new CredentialDto($this->get('email'), $this->get('password'));
    }
}
