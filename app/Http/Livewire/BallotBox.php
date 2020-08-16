<?php

namespace App\Http\Livewire;

use App\Notifications\VotesReceived;
use App\Poll;
use App\PollOption;
use App\Vote;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class BallotBox extends Component
{
    use AuthorizesRequests;

    public $option_id;
    public $poll;
    public $vote;

    protected $listeners = [
        'optionSelected' => 'vote',
        'optionUpdated' => 'updateVote',
    ];

    public function mount()
    {
        $this->poll = request()->poll;
        $this->vote = Auth::check() ? Auth::user()->vote($this->poll) : null;
        $this->option_id = $this->vote ? $this->vote->option_id : null;
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
        $this->vote = $vote;
        $this->dispatchBrowserEvent('vote');
    }

    public function updateVote()
    {
        $this->authorize('update', $this->vote);

        $updatedVote = $this->validate([
            'option_id' => 'required|integer|exists:poll_options,id',
        ]);
        $updatedVote['updated_at'] = Carbon::now();

        $this->vote->update($updatedVote);

        $this->poll = Poll::find($this->poll->id);
        $this->vote = Vote::find($this->vote->id);

        $this->dispatchBrowserEvent('vote');
    }

    public function render()
    {
        return view('livewire.ballot-box');
    }
}
