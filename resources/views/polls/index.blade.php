@extends('layouts.app')

@section('title', 'Polls')

@section('content')
<article>
    <h1 class="sr-only">Polls</h1>

    <x-panel>
        @if ($polls->isNotEmpty())
            <ol>
                @foreach ($polls as $poll)
                    @include('_poll-listing')
                @endforeach
            </ol>
        @else
            <p>There are currently no polls!</p>
        @endif
    </x-panel>
</article>

{{ $polls->links() }}
@endsection
