<?php

namespace App\CompanyService\Auth\Domain\Services;

use Illuminate\Support\Facades\Log;

class AuthService
{
    public function handle(array $data=[]): array
    {
        $token = auth()->attempt($data);

        if (!$token) {
            Log::channel('user_auth')->error('User authentication failed', [
                'action' => 'Error auth User',
                'level' => 'error'
            ]);

            return [
                'check' => false,
                'error' => 'Unauthorized'
            ];
        }

        Log::channel('user_auth')->info('Auth success', [
            'user_id' => auth()->id(),
            'action' => 'Auth User',
            'level' => 'info'
        ]);

        return [
            'check' => true,
            'token' => $token,
        ];
    }
}
