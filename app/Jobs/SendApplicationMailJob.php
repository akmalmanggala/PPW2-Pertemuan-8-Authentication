<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\JobAppliedMail;
use Exception;

class SendApplicationMailJob implements ShouldQueue
{
    use Queueable, Dispatchable, InteractsWithQueue, SerializesModels;

    public $jobVacancy;
    public $user;
    public $cvPath;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 3;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 60;

    /**
     * Create a new job instance.
     */
    public function __construct($jobVacancy, $user, $cvPath = null)
    {
        $this->jobVacancy = $jobVacancy;
        $this->user = $user;
        $this->cvPath = $cvPath;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            Log::info('🚀 [QUEUE START] Sending application email', [
                'user_id' => $this->user->id,
                'user_email' => $this->user->email,
                'job_id' => $this->jobVacancy->id,
                'job_title' => $this->jobVacancy->title,
                'time' => now()->format('H:i:s')
            ]);

            Mail::to($this->user->email)
                ->send(new JobAppliedMail($this->jobVacancy, $this->user, $this->cvPath));

            Log::info('✅ [QUEUE DONE] Application email sent successfully', [
                'user_id' => $this->user->id,
                'job_id' => $this->jobVacancy->id,
                'time' => now()->format('H:i:s')
            ]);
        } catch (Exception $e) {
            Log::error('Failed to send application email', [
                'user_id' => $this->user->id,
                'job_id' => $this->jobVacancy->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            // Re-throw the exception to mark job as failed
            throw $e;
        }
    }

    /**
     * Handle a job failure.
     */
    public function failed(Exception $exception): void
    {
        Log::error('Application email job failed permanently', [
            'user_id' => $this->user->id,
            'job_id' => $this->jobVacancy->id,
            'error' => $exception->getMessage()
        ]);
    }
}
