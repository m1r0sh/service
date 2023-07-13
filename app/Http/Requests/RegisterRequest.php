<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:32',
            'email'=> 'required|string|email',
            'password' => 'required|string',
        ];
    }

    protected function failedValidation(Validator $validator):JsonResponse
    {
        return throw new ValidationException($validator, response()->json([
            'status' => JsonResponse::HTTP_BAD_REQUEST,
            'errors' => $validator->errors()
        ]));
    }
}
