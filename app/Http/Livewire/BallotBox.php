<?php

namespace App\Http\Livewire;

use App\Notifications\VotesReceived;
use App\PollOption;
use App\Vote;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class BallotBox extends Component
{
    use AuthorizesRequests;

    public $option_id;
    public $poll;
    public $vote;

    protected $listeners = ['optionSelected' => 'vote'];

    public function mount()
    {
        $this->poll = request()->poll;
        // $this->hasVoted = Auth::user()->hasVoted($this->poll) ? true : false;
        // $this->totalVotes = $this->poll->votes->count();
        $this->vote = Auth::check() ? Auth::user()->vote($this->poll) : null;
        // $this->option_id = $this->vote ? $this->vote->option_id : null;
    }

    public function vote()
    {
        $this->authorize('create', Vote::class);

        $vote = $this->validate([
            'option_id' => 'required|integer|exists:poll_options,id',
        ]);

        $poll = PollOption::find($vote['option_id'])->poll;
        abort_if(Auth::user()->hasVoted($poll), 403);

        $vote['user_id'] = Auth::id();

        $vote = Vote::create($vote);

        $poll = $vote->recipient->poll;
        if ($poll->votes->count() === 5) {
            $vote->recipient->poll->author->notify(new VotesReceived($poll));
        }

        $this->poll = $poll;
        $this->hasVoted = true;
        $this->vote = $vote;
        $this->totalVotes = $this->poll->votes->count();
        $this->dispatchBrowserEvent('vote');
    }

    public function render()
    {
        return view('livewire.ballot-box');
    }
}
