<?php

namespace App\Listeners;

use App\Events\ServiceCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class NewServiceMailCreated implements ShouldQueue
{
    public function handle(ServiceCreated $event): void
    {
        $user = Auth::user()->toArray();

        Mail::to($user['email'])->send(new \App\Mail\ServiceCreated($user['name']));
    }
}
