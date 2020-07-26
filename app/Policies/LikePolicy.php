<?php

namespace App\Policies;

use App\Like;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LikePolicy
{
    use HandlesAuthorization;

    public function before(?User $user)
    {
        if (optional($user)->isAdmin()) {
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
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Like  $like
     * @return mixed
     */
    public function delete(User $user, Like $like)
    {
        return $user->id === $like->user_id;
    }
}
