<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Poll extends Model
{
    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function author()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function category()
    {
        return $this->belongsTo('App\PollCategory', 'category_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function numberOfComments()
    {
        return $this->comments->count() . ' ' . Str::plural('comment', $this->comments->count());
    }

    public function numberOfVotes()
    {
        return $this->votes->count() . ' ' . Str::plural('vote', $this->votes->count());
    }

    public function options()
    {
        return $this->hasMany('App\PollOption');
    }

    public function parentComments()
    {
        return $this->hasMany('App\Comment')->whereNull('parent_comment_id')->latest();
    }

    public function votes()
    {
        return $this->hasManyThrough('App\Vote', 'App\PollOption', 'poll_id', 'option_id');
    }

    public function usersVote($userId)
    {
        $vote = $this->votes->where('user_id', $userId)->first();

        if ($vote) {
            return $vote;
        }

        return null;
    }
}
