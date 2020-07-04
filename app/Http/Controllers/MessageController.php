<?php

namespace App\Http\Controllers;

use App\Conversation;
use App\Message;
use App\Notifications\MessageReceived;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', [Message::class, Conversation::find($request['conversation_id'])]);

        $message = $this->validateMessage();

        $message['user_id'] = Auth::id();

        $message = Message::create($message);

        if (Auth::id() === $message->conversation->sender_id) {
            $recipient = $message->conversation->recipient;
        } else {
            $recipient = $message->conversation->sender;
        }

        $recipient->notify(new MessageReceived($message));

        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        $this->authorize('update', $message);

        $updatedMessage = $this->validateMessage();
        $updatedMessage['updated_at'] = Carbon::now();

        $message->update($updatedMessage);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        $this->authorize('delete', $message);

        $message->update(['is_deleted' => true]);

        return back();
    }

    protected function validateMessage()
    {
        return request()->validate([
            'conversation_id' => 'required|integer|exists:conversations,id',
            'body' => 'required|string|max:3000',
        ]);
    }
}
