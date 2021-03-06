<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class CommentReplyReceived extends Notification
{
    use Queueable;
    protected $comment;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($comment)
    {
        $this->comment = $comment;
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
            'author' => $this->comment->author->username,
            'authorSlug' => $this->comment->author->slug,
            'poll' => $this->comment->poll->title,
            'pollSlug' => $this->comment->poll->slug,
            'commentId' => $this->comment->id,
        ];
    }
}
