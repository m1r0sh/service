<?php

namespace App\CompanyService\Auth\Domain\Requests;

use App\Domains\Requests\RequestDefault;

class RegistrationRequest extends RequestDefault
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string',
        ];
    }
}
