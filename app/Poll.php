<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

    public function parentComments()
    {
        return $this->hasMany('App\Comment')->whereNull('parent_comment_id');
    }

    public function options()
    {
        return $this->hasMany('App\PollOption');
    }

    public function votes()
    {
        return $this->hasManyThrough('App\Vote', 'App\PollOption', 'poll_id', 'option_id');
    }

    public function optionVotedForBy($userId)
    {
        $vote = $this->votes->where('user_id', $userId)->first();

        if ($vote) {
            return $vote->option_id;
        }

        return null;
    }
}
