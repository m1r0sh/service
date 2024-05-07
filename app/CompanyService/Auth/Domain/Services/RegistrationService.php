<?php

namespace App\CompanyService\Auth\Domain\Services;

use App\CompanyService\Auth\Domain\Models\Users;
use App\Domains\Helpers\JwtHelpers;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class RegistrationService
{
    public function __construct(
        private JwtHelpers $helpers
    ){}

    public function handle(array $data=[]): string
    {
        $user = Users::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $token = JWTAuth::fromUser($user);
        auth()->attempt($data);

        return $token;
    }
}
