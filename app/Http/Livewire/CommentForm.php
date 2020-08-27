<?php

namespace App\Http\Livewire;

use App\Comment;
use App\Notifications\CommentReceived;
use App\Notifications\CommentReplyReceived;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CommentForm extends Component
{
    use AuthorizesRequests;

    public $body;
    public $htmlId;
    public $isReply;
    public $parent_comment_id;
    public $poll_id;

    public function mount($htmlId, $isReply, $parentCommentId, $pollId)
    {
        $this->body = '';
        $this->htmlId = $htmlId;
        $this->isReply = $isReply;
        $this->parent_comment_id = $parentCommentId;
        $this->poll_id = $pollId;
    }

    public function comment()
    {
        $this->authorize('create', Comment::class);

        $comment = $this->validate([
            'poll_id' => 'required|integer|exists:polls,id',
            'parent_comment_id' => 'nullable|integer|exists:comments,id',
            'body' => 'required|string|max:3000',
        ]);

        $comment['user_id'] = Auth::id();

        $comment = Comment::create($comment);

        if ($this->isReply) {
            $this->sendReplyNotification($comment);
        } else {
            $this->sendCommentNotification($comment);
        }

        $this->body = '';
        $this->emit('commentAdded');
    }

    public function sendCommentNotification(Comment $comment)
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

    public function render()
    {
        return view('livewire.comment-form');
    }
}
