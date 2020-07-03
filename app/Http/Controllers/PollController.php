<?php

namespace App\Http\Controllers;

use App\Poll;
use App\PollCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class PollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $polls = Poll::where('is_deleted', 0)->latest()->paginate(10);

        return view('polls.index', compact('polls'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Poll::class);

        $categories = PollCategory::all();

        return view('polls.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Poll::class);

        // Validate the poll.
        $poll = $this->validatePoll();

        // Validate the options.
        $options = $this->validateOptions();

        // Attach the poll to the logged-in user.
        $poll['user_id'] = Auth::id();

        // Add a slug for the poll.
        $poll['slug'] = Str::of($poll['title'])->slug('-') . '-' . rand();

        // Create the poll.
        $poll = Poll::create($poll);

        // Strip out the empty options.
        $options = Arr::collapse($options);
        $options = Arr::where($options, function ($option) {
            return $option['name'] !== null;
        });

        // Attach each option to the newly created poll.
        $pollId = $poll->id;
        for ($i = 0; $i < count($options); $i++) {
            Arr::set($options[$i], 'poll_id', $pollId);
        }

        // Create the options.
        $poll->options()->createMany($options);

        // Redirect.
        return redirect(route('polls.show', $poll));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function show(Poll $poll)
    {
        abort_if($poll->is_deleted, 403, 'This poll has been deleted.');

        return view('polls.show', compact('poll'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function edit(Poll $poll)
    {
        $this->authorize('update', $poll);

        $categories = PollCategory::all();

        return view('polls.edit', compact(['categories', 'poll']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Poll $poll)
    {
        $this->authorize('update', $poll);

        $poll->update($this->validatePoll());

        return redirect(route('polls.show', $poll));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function destroy(Poll $poll)
    {
        $this->authorize('delete', $poll);

        $poll->update(['is_deleted' => true]);

        return redirect(route('polls.index'));
    }

    protected function validatePoll()
    {
        return request()->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:poll_categories,id',
        ]);
    }

    protected function validateOptions()
    {
        return request()->validate([
            'options.0.name' => 'required|string|max:255',
            'options.1.name' => 'required|string|max:255',
            'options.2.name' => 'nullable|string|max:255',
            'options.3.name' => 'nullable|string|max:255',
            'options.4.name' => 'nullable|string|max:255',
            'options.5.name' => 'nullable|string|max:255',
        ]);
    }
}
