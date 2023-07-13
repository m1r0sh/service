<?php

namespace App\Listeners;

use App\Events\ServiceCreated;
use App\Jobs\ServiceJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class NewServiceMailCreated implements ShouldQueue
{
    public function handle(ServiceCreated $event): void
    {
        $service = $event->service;

        dispatch(new ServiceJob($service->email, $service->name));
    }
}
