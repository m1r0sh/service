<?php

namespace App\Listeners;

use App\Events\ServiceCreated;
use App\Jobs\RegisterJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class NewServiceMailCreated implements ShouldQueue
{
    public function handle(ServiceCreated $event): void
    {
        $user = Auth::user()->toArray();

        dispatch(new RegisterJob($user['email'], $user['name']));
    }
}
