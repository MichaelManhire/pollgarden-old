<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class CommentReceived extends Notification
{
    use Queueable;
    protected $comment;
    protected $author;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($comment, $author)
    {
        $this->comment = $comment;
        $this->author = $author;
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
            'author' => $this->author->username,
            'authorSlug' => $this->author->slug,
            'poll' => $this->comment->poll->title,
            'pollSlug' => $this->comment->poll->slug,
            'commentId' => $this->comment->id,
        ];
    }
}
