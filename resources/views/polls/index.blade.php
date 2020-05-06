@extends('layouts.app')

@section('title', 'Polls' . ' - ' . config('app.name', 'Poll Garden'))

@section('content')
<ol class="bg-white shadow overflow-hidden sm:rounded-md">
    @foreach ($polls as $poll)
        @include('components.poll-listing', ['poll' => $poll])
    @endforeach
</ol>
{{ $polls->links() }}
@endsection
