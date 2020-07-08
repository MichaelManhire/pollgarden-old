<?php

namespace App\Http\Controllers;

use App\Notifications\VotesReceived;
use App\PollOption;
use App\Vote;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Vote::class);

        $vote = $this->validateVote();

        $poll = PollOption::find($vote['option_id'])->poll;
        abort_if(Auth::user()->hasVoted($poll), 403);

        $vote['user_id'] = Auth::id();

        $vote = Vote::create($vote);

        $poll = $vote->recipient->poll;
        if ($poll->votes->count() === 5) {
            $vote->recipient->poll->author->notify(new VotesReceived($poll));
        }

        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vote $vote)
    {
        $this->authorize('update', $vote);

        $updatedVote = $this->validateVote();
        $updatedVote['updated_at'] = Carbon::now();

        $vote->update($updatedVote);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vote $vote)
    {
        $this->authorize('delete', $vote);

        $vote->delete();

        return back();
    }

    protected function validateVote()
    {
        return request()->validate([
            'option_id' => 'required|integer|exists:poll_options,id',
        ]);
    }
}
