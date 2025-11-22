<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class JobAppliedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $jobVacancy;
    public $user;
    public $cvPath;

    public function __construct($jobVacancy, $user, $cvPath = null)
    {
        $this->jobVacancy = $jobVacancy;
        $this->user = $user;
        $this->cvPath = $cvPath;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Lamaran Baru Untuk '.$this->jobVacancy->title,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.job_applied',
            with: [
                'jobVacancy' => $this->jobVacancy,
                'user' => $this->user,
                'cvPath' => $this->cvPath,
            ],  
        );
    }    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
