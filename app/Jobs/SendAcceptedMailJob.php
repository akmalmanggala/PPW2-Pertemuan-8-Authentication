<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApplicationAcceptedMail;
use App\Models\Application;

class SendAcceptedMailJob implements ShouldQueue
{
    use Queueable;

    public $application;

    /**
     * Create a new job instance.
     */
    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->application->user->email)
            ->send(new ApplicationAcceptedMail($this->application));
    }
}
