<?php

namespace App\Http\Controllers;

use App\Conversation;
use App\Message;
use App\Notifications\MessageReceived;
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
        $this->authorize('viewAny', Conversation::class);

        $conversations = Auth::user()->getConversations()->paginate(10);

        return view('conversations.index', compact('conversations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Conversation::class);

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
        $this->authorize('create', Conversation::class);

        $conversation = $this->validateConversation();

        $conversation['sender_id'] = Auth::id();

        $conversation = Conversation::create($conversation);

        $message = $conversation->messages()->create([
            'body' => $request['body'],
            'user_id' => $conversation['sender_id'],
        ]);

        $conversation->recipient->notify(new MessageReceived($message));

        return redirect(route('conversations.show', $conversation))->with('success', 'Your message was successfully sent!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Conversation  $conversation
     * @return \Illuminate\Http\Response
     */
    public function show(Conversation $conversation)
    {
        $this->authorize('view', $conversation);

        $messages = $conversation->messages()->paginate(10);

        return view('conversations.show', compact(['conversation', 'messages']));
    }

    protected function validateConversation()
    {
        return request()->validate([
            'recipient_id' => 'required|integer|exists:users,id',
        ]);
    }
}
