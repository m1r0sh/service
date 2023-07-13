<?php

namespace App\Jobs;

use App\Mail\RegisterSucces;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class RegisterJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected $user,
        protected $descr
    ){}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->user)->send(new RegisterSucces($this->descr));
    }
}
