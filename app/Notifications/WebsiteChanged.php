<?php

namespace App\Notifications;

use App\Checker;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class WebsiteChanged extends Notification
{
    use Queueable;

    /**
     * @var string|null
     */
    public $oldChecksum;

    /**
     * @var string
     */
    public $newChecksum;

    /**
     * @var string
     */
    public $url;

    /**
     * Create a new notification instance.
     */
    public function __construct(string $oldChecksum = null, string $newChecksum, string $url)
    {
        $this->oldChecksum = $oldChecksum;
        $this->newChecksum = $newChecksum;
        $this->url = $url;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting('Website Changed')
            ->line("From: {$this->oldChecksum}")
            ->line("To: {$this->newChecksum}")
            ->action('Check it out', $this->url);
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
            //
        ];
    }
}
