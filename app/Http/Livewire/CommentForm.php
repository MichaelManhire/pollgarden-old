<?php

namespace App\Http\Livewire;

use App\Comment;
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
    public $poll;
    public $poll_id;

    public function mount($htmlId, $isReply, $parentCommentId, $poll)
    {
        $this->body = '';
        $this->htmlId = $htmlId;
        $this->isReply = $isReply;
        $this->parent_comment_id = $parentCommentId;
        $this->poll = $poll;
        $this->poll_id = $this->poll->id;
    }

    public function comment()
    {
        $this->authorize('create', Comment::class);

        $comment = $this->validate([
            'poll_id' => 'required|integer|exists:polls,id',
            'parent_comment_id' => 'integer|exists:comments,id',
            'body' => 'required|string|max:3000',
        ]);

        $comment['user_id'] = Auth::id();

        $comment = Comment::create($comment);

        // if ($this->isReply) {
        //     $this->sendReplyNotification($comment);
        // } else {
        //     $this->sendCommentNotification($comment);
        // }

        $this->body = '';
        $this->emit('commentAdded');
    }

    public function render()
    {
        return view('livewire.comment-form');
    }
}
