@extends('layouts.app')

@section('title', $poll->title)
@section('description', 'Vote and engage with others on interesting questions' . ($poll->category->id !== 1 ? ' about ' . strtolower($poll->category->name) : '') . '.')

@section('content')
<article>
    <x-panel class="pt-6">
        <div class="flex-1 flex items-start px-2 sm:px-6">
            <div class="flex-shrink-0 text-white">
                <x-avatar class="w-12 sm:w-16 h-12 sm:h-16" :src="$poll->getImage()" :width="64" :height="64" />
            </div>

            <div class="ml-4">
                <h1 class="text-2xl sm:text-3xl leading-tight font-extrabold">
                    {{ $poll->title }}
                    @if ($poll->is_deleted)
                        <span class="text-red-600">[DELETED]</span>
                    @endif
                </h1>

                <div class="mt-2 text-sm text-gray-500">
                    <p class="inline-block mb-2 mr-2">
                        <span>Posted by</span>
                        <a class="text-green-600 hover:underline" href="{{ route('users.show', $poll->author) }}">{{ $poll->author->username }}</a>
                        <time datetime="{{ $poll->created_at }}">{{ $poll->created_at->diffForHumans() }}</time>
                        <span>in {{ $poll->category->name }}</span>
                        @if ($poll->created_at != $poll->updated_at)
                            <span>(edited <time datetime="{{ $poll->updated_at }}">{{ $poll->updated_at->diffForHumans() }})</time></span>
                        @endif
                    </p>

                    @can('update', $poll)
                        <a class="inline-block mb-2 mr-2 text-green-600 hover:underline" href="{{ route('polls.edit', $poll) }}">Edit Poll</a>
                    @endcan

                    @can('delete', $poll)
                        <form class="inline-block mb-2" action="{{ route('polls.destroy', $poll) }}" method="POST" x-data @submit.prevent="if (confirm('Are you sure you want to delete your poll?')) { $el.submit() }">
                            @csrf
                            @method('DELETE')

                            <input name="id" type="hidden" value="{{ $poll->id }}">
                            <button class="text-green-600 hover:underline" type="submit">Delete Poll</button>
                        </form>
                    @endcan
                </div>
            </div>
        </div>

        @auth
            @include('_ballot-box', ['hasVoted' => Auth::user()->hasVoted($poll) ? 1 : 0, 'totalVotes' => $poll->votes->count()])
        @else
            @include('_ballot-box', ['hasVoted' => false, 'totalVotes' => $poll->votes->count()])
        @endauth
    </x-panel>

    <article class="mt-6">
        <h2 class="text-2xl leading-tight font-extrabold">Comments</h2>

        @include('_comment-form', ['id' => 'comment-for-poll-' . $poll->id, 'isReply' => false])

        @if ($comments->isNotEmpty())
            <ol id="comments">
                @foreach ($comments as $comment)
                    <li class="my-4" x-data="comment()">
                        @include('_comment', ['comment' => $comment])
                        @include('_comment-form-edit', ['comment' => $comment, 'id' => 'edit-for-comment-' . $comment->id, 'isReply' => false])
                        @include('_comment-form', ['id' => 'reply-for-comment-' . $comment->id, 'isReply' => true])
                    </li>

                    @if ($comment->replies->isNotEmpty())
                        <ol class="ml-8">
                            @foreach ($comment->replies as $reply)
                                <li class="my-4" x-data="comment()">
                                    @include('_comment', ['comment' => $reply])
                                    @include('_comment-form-edit', ['comment' => $reply, 'id' => 'edit-for-comment-' . $reply->id, 'isReply' => true])
                                    @include('_comment-form', ['id' => 'reply-for-comment-' . $reply->id, 'isReply' => true])
                                </li>
                            @endforeach
                        </ol>
                    @endif
                @endforeach
            </ol>
        @else
            <x-panel class="p-3 mt-4">
                <p>No one has left a comment on this poll yet!</p>
            </x-panel>
        @endif

        @if ($comments->hasPages())
            {{ $comments->fragment('comments')->links() }}
        @endif
    </article>
</article>
@endsection
