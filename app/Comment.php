<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = [];

    public function author()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function childComments()
    {
        return $this->hasMany('App\Comment', 'parent_comment_id');
    }

    public function parentComment()
    {
        return $this->belongsTo('App\Comment', 'parent_comment_id');
    }

    public function poll()
    {
        return $this->belongsTo('App\Poll');
    }
}