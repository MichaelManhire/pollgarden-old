<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class VotesReceived extends Notification
{
    use Queueable;
    protected $poll;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($poll)
    {
        $this->poll = $poll;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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
            'poll' => $this->poll->title,
            'pollSlug' => $this->poll->slug,
        ];
    }
}
