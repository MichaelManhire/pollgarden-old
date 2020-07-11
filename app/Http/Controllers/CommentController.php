<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Notifications\CommentReceived;
use App\Notifications\CommentReplyReceived;
use Carbon\Carbon;
use Illuminate\Http\Request;
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

        if ($comment->isReply()) {
            $this->sendReplyNotification($comment);
        } else {
            $this->sendCommentNotification($comment);
        }

        return back()->with('success', 'Your comment was successfully posted!');
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

        $updatedComment = $this->validateComment();
        $updatedComment['updated_at'] = Carbon::now();

        $comment->update($updatedComment);

        return back()->with('success', 'Your comment was successfully updated!');
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

        return back()->with('success', 'Your comment was deleted!');
    }

    protected function validateComment()
    {
        return request()->validate([
            'poll_id' => 'required|integer|exists:polls,id',
            'parent_comment_id' => 'integer|exists:comments,id',
            'body' => 'required|string|max:3000',
        ]);
    }

    protected function sendCommentNotification(Comment $comment)
    {
        $pollAuthor = $comment->poll->author;

        if ($pollAuthor->id === Auth::id()) {
            return;
        }

        $pollAuthor->notify(new CommentReceived($comment));
    }

    public function sendReplyNotification(Comment $comment)
    {
        $parentCommentAuthor = $comment->parentComment->author;

        if ($parentCommentAuthor->id === Auth::id()) {
            return;
        }

        $parentCommentAuthor->notify(new CommentReplyReceived($comment));
    }
}
