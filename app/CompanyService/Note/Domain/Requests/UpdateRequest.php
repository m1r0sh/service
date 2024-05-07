<?php

namespace App\CompanyService\Note\Domain\Requests;

use App\Domains\Requests\RequestDefault;

class UpdateRequest extends RequestDefault
{
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:64|min:2',
            'content' => 'required|string|max:255',
            'status' => 'bool',
        ];
    }
}
