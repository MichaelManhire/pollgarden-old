<?php

namespace App\Policies;

use App\Poll;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PollPolicy
{
    use HandlesAuthorization;

    public function before(?User $user)
    {
        if (optional($user)->isAdmin()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Poll  $poll
     * @return mixed
     */
    public function view(?User $user, Poll $poll)
    {
        if ($poll->is_deleted) {
            return $this->deny('This poll has been deleted.');
        } else {
            return true;
        }
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Poll  $poll
     * @return mixed
     */
    public function update(User $user, Poll $poll)
    {
        return $user->id === $poll->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Poll  $poll
     * @return mixed
     */
    public function delete(User $user, Poll $poll)
    {
        return $user->id === $poll->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Poll  $poll
     * @return mixed
     */
    public function restore(User $user, Poll $poll)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Poll  $poll
     * @return mixed
     */
    public function forceDelete(User $user, Poll $poll)
    {
        //
    }
}
