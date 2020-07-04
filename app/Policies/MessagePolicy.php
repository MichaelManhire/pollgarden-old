<?php

namespace App\Policies;

use App\Conversation;
use App\Message;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MessagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user, Conversation $conversation)
    {
        return $user->id === $conversation->sender_id || $user->id === $conversation->recipient_id;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Message  $message
     * @return mixed
     */
    public function update(User $user, Message $message)
    {
        return $user->id === $message->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Message  $message
     * @return mixed
     */
    public function delete(User $user, Message $message)
    {
        return $user->id === $message->user_id;
    }
}
