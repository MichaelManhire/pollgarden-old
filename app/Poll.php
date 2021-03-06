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
        return $this->hasMany('App\Comment')->where('is_deleted', 0);
    }

    public function getImage()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }

        return $this->author->getAvatar();
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
        return $this->hasMany('App\Comment')->where('is_deleted', 0)->whereNull('parent_comment_id')->latest();
    }

    public function votes()
    {
        return $this->hasManyThrough('App\Vote', 'App\PollOption', 'poll_id', 'option_id');
    }
}
