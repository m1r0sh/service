<?php

namespace App\CompanyService\Auth\Domain\Requests;

use App\Domains\Requests\RequestDefault;

class AuthRequest extends RequestDefault
{
    public function rules(): array
    {
        return [
            'email' => 'required|string',
            'password' => 'required|string',
        ];
    }
}
