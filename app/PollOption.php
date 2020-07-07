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

    public function color($index)
    {
        switch ($index) {
            case 0:
                return '#a3d9a5';
                break;
            case 1:
                return '#cfbcf2';
                break;
            case 2:
                return '#f9da8b';
                break;
            case 3:
                return '#a4cafe';
                break;
            case 4:
                return '#f8b4d9';
                break;
            default:
                return '#a3d9a5';
                break;
        }
    }
}
