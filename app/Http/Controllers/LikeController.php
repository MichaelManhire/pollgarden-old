<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Like;
use App\Notifications\CommentLiked;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Like::class);

        $like = $this->validateLike();

        $comment = Comment::find($like['comment_id']);
        abort_if($comment->hasBeenLiked(Auth::user()), 403);

        $like['user_id'] = Auth::id();

        $like = Like::create($like);

        $comment->author->notify(new CommentLiked($like));

        return redirect()->to(url()->previous() . '#comment' . $comment->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function destroy(Like $like)
    {
        $this->authorize('delete', $like);

        $comment = Comment::find($like['comment_id']);

        $like->delete();

        return redirect()->to(url()->previous() . '#comment' . $comment->id);
    }

    protected function validateLike()
    {
        return request()->validate([
            'comment_id' => 'required|integer|exists:comments,id',
        ]);
    }
}
