<?php

namespace App\Domains\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class RequestDefault extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    protected function failedValidation(Validator $validator)
    {
        // Игнорируем валидацию, если команда выполняется в консоли
        if ($this->isRunningInConsole()) {
            return;
        }

        throw (new ValidationException($validator))
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }

    protected function isRunningInConsole(): bool
    {
        return app()->runningInConsole();
    }

}
