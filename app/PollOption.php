<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PollOption extends Model
{
    public $timestamps = false;
    protected $guarded = [];
    protected $with = ['votes'];

    public function poll()
    {
        return $this->belongsTo('App\Poll');
    }

    public function votes()
    {
        return $this->hasMany('App\Vote', 'option_id');
    }

    public function percentage($totalVotes)
    {
        if ($totalVotes > 0) {
            return round($this->votes->count() / $totalVotes * 100) . '%';
        }

        return '0%';
    }
}
