<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class CommentList extends Component
{
    use WithPagination;

    public $comments;
    public $poll;

    protected $listeners = ['commentAdded' => 'refreshComments'];

    public function mount($poll)
    {
        $this->poll = $poll;
        $this->comments = $this->poll->parentComments;
    }

    public function refreshComments()
    {
        $this->comments = [];
        $this->comments = $this->poll->parentComments;
    }

    public function render()
    {
        return view('livewire.comment-list', [
            'comments' => $this->comments->paginate(10),
        ]);
    }
}
