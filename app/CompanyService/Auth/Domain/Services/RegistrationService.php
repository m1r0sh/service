<?php

namespace App\CompanyService\Auth\Domain\Services;

use App\CompanyService\Auth\Domain\Models\Users;
use App\Domains\Helpers\JwtHelpers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class RegistrationService
{
    public function __construct(
        private JwtHelpers $helpers
    ){}

    public function handle(array $data=[]): array
    {
        try {
            DB::beginTransaction();

            $user = Users::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);

            $token = JWTAuth::fromUser($user);
            auth()->attempt($data);

            DB::commit();

            Log::channel('user_auth')->info('New User created', [
                'user_id' => auth()->id(),
                'action' => 'Create User',
                'level' => 'info'
            ]);

            return [
                'check' => true,
                'data' => $token,
            ];
        } catch (\Exception $e) {
            DB::rollBack();

            Log::channel('user_auth')->error('Couldnt create New User', [
                'user_id' => auth()->id(),
                'action' => 'Error create User',
                'level' => 'error'
            ]);

            return [
                'check' => false,
                'data' => $e->getMessage(),
            ];
        }
    }
}
