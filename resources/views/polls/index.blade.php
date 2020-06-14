@extends('layouts.app')

@section('title', 'Polls - Poll Garden')

@section('content')
<article>
    <h1 class="sr-only">Polls</h1>

    @if ($polls->isNotEmpty())
        <ol class="bg-white rounded-lg shadow">
            @foreach ($polls as $poll)
                @include('components.poll-listing', ['poll' => $poll])
            @endforeach
        </ol>
    @else
        <p>There are currently no polls!</p>
    @endif
</article>

{{ $polls->links() }}
@endsection
