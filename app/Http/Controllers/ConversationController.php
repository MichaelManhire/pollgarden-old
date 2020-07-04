<?php

namespace App\Http\Controllers;

use App\Conversation;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConversationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $conversations = Auth::user()->getConversations();

        return view('conversations.index', compact('conversations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $conversations = Auth::user()->getConversations();
        $recipient = $request['recipient_id'];

        $wasSent = Auth::user()->getConversations()->contains('sender_id', $recipient);
        if ($wasSent) {
            return redirect(route('conversations.show', $conversations->where('sender_id', $recipient)->first()->id));
        }

        $wasReceived = $conversations->contains('recipient_id', $recipient);
        if ($wasReceived) {
            return redirect(route('conversations.show', $conversations->where('recipient_id', $recipient)->first()->id));
        }

        return view('conversations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $conversation = $this->validateConversation();

        $conversation['sender_id'] = Auth::id();

        $conversation = Conversation::create($conversation);

        $conversation->messages()->create([
            'body' => $request['body'],
            'user_id' => $conversation['sender_id'],
        ]);

        return redirect(route('conversations.show', $conversation));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Conversation  $conversation
     * @return \Illuminate\Http\Response
     */
    public function show(Conversation $conversation)
    {
        return view('conversations.show', compact('conversation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Conversation  $conversation
     * @return \Illuminate\Http\Response
     */
    public function edit(Conversation $conversation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Conversations  $conversations
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Conversation $conversation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Conversation  $conversation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Conversation $conversation)
    {
        //
    }

    protected function validateConversation()
    {
        return request()->validate([
            'recipient_id' => 'required|integer|exists:users,id',
        ]);
    }
}
