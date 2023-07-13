<?php

namespace App\Listeners;

use App\Events\ServiceCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Twilio\Rest\Client;

class NewServicePhoneCreated
{

    public function handle(ServiceCreated $event, Client $twilio): void
    {
        $user = Auth::user()->toArray();

        $twilio->messages->create(
            $user['phone'],
            [
                'from' => config('services.twilio.phone_number'),
                'body' => "Hello, you created new Service!"
            ]
        );
    }
}
