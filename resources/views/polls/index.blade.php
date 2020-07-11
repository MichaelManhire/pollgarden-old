@extends('layouts.app')

@section('title', 'Polls')
@section('description', 'Ask questions, vote in polls, and engage with others at Poll Garden.')

@section('content')
<article>
    <h1 class="sr-only">Polls</h1>

    <x-panel>
        <ol>
            @forelse ($polls as $poll)
                @include('_poll-listing')

            @empty
                <li>There are currently no polls!</li>
            @endforelse
        </ol>
    </x-panel>
</article>

@if ($polls->hasPages())
    {{ $polls->links() }}
@endif
@endsection
