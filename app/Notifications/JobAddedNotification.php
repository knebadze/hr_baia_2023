<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Http;

class JobAddedNotification extends Notification
{
    use Queueable;

    protected $job;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($job)
    {
        $this->job = $job;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['customNotix'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toCustomNotix($notifiable)
    {
        $response = Http::withHeaders([
            'Authorization-Token' => config('notix.api_key'),
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->post(config('notix.api_url'), [
            'title' => 'New Job Added',
            'message' => 'Job Title: ' . $this->job->title . "\n" .
                         'Category: ' . $this->job->category . "\n" .
                         'Schedule: ' . $this->job->schedule . "\n" .
                         'Payment: ' . $this->job->payment,
            'recipient' => $notifiable->notix_token,
        ]);

        return $response->successful();
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'job_id' => $this->job->id,
            'job_title' => $this->job->title,
            'job_category' => $this->job->category,
            'job_schedule' => $this->job->schedule,
            'job_payment' => $this->job->payment,
        ];
    }
}

