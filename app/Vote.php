<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $guarded = [];

    public function recipient()
    {
        return $this->belongsTo('App\PollOption', 'option_id');
    }

    public function caster()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
