<?php

namespace App\CompanyService\Note\Domain\Requests;

use App\Domains\Requests\RequestDefault;

class ListRequest extends RequestDefault
{
    public function rules(): array
    {
        return [
            'sort' => 'string|nullable',
        ];
    }
}
