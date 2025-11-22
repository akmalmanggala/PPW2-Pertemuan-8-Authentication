<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewApplicationNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $application;

    /**
     * The number of times the notification may be attempted.
     *
     * @var int
     */
    public $tries = 3;

    /**
     * The number of seconds the notification can run before timing out.
     *
     * @var int
     */
    public $timeout = 60;

    /**
     * Create a new notification instance.
     */
    public function __construct($application)
    {
        $this->application = $application;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $message = (new MailMessage)
            ->subject('Lamaran Baru Diterima')
            ->line('Ada lamaran baru untuk pekerjaan: ' . ($this->application->jobVacancy?->title ?? 'N/A'))
            ->line('Pelamar: ' . ($this->application->user?->name ?? 'N/A'))
            ->line('Email: ' . ($this->application->user?->email ?? 'N/A'));

        // Tambahkan link download CV jika ada
        if ($this->application->resume) {
            $message->action('📄 Download CV', url('storage/' . $this->application->resume));
        }

        $message->action('Lihat Semua Lamaran', url('admin/applications'));

        return $message;
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
