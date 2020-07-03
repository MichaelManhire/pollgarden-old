<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Notifications\CommentReceived;
use App\Notifications\CommentReplyReceived;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Comment::class);

        $comment = $this->validateComment();

        $comment['user_id'] = Auth::id();

        $comment = Comment::create($comment);

        if (Arr::exists($comment, 'parent_comment_id')) {
            $comment->parentComment->author->notify(new CommentReplyReceived($comment));
        } else {
            $comment->poll->author->notify(new CommentReceived($comment));
        }

        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        $this->authorize('update', $comment);

        $comment->update($this->validateComment());

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->update(['is_deleted' => true]);

        return back();
    }

    protected function validateComment()
    {
        return request()->validate([
            'poll_id' => 'required|integer|exists:polls,id',
            'parent_comment_id' => 'integer|exists:comments,id',
            'body' => 'required|string|max:3000',
        ]);
    }

    // protected function sendNotification(Comment $comment)
    // {
    //     $comment->poll->author->notify(new CommentReceived([
    //         Auth::user()->name,
    //         Auth::user()->slug,
    //         $comment->poll->title,
    //         $comment->poll->slug,
    //         $comment->body,
    //     ]));
    // }
}
