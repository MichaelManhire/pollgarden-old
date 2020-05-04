@extends('layouts.app')

@section('content')
<ol class="bg-white shadow overflow-hidden sm:rounded-md">
    @foreach ($polls as $poll)
        <li class="{{ (! $loop->first) ? 'border-t border-gray-100' : '' }}">
            <a class="block hover:bg-gray-50" href="{{ route('polls.show', $poll) }}">
                <div class="flex items-center px-4 py-4 sm:px-6">
                    <div class="min-w-0 flex-1 flex items-center">
                        <div class="flex-shrink-0">
                            <img class="h-12 w-12 rounded-full" src="https://source.unsplash.com/96x96/" alt="" height="48" width="48" loading="lazy">
                        </div>
                        <div class="min-w-0 flex-1 px-4 md:grid md:grid-cols-2 md:gap-4">
                            <div>
                                <p class="text-sm leading-5 font-medium text-green-600">{{ $poll->title }}</p>
                                <p class="mt-2 text-sm leading-5 text-gray-500">{{ __('Created by') . ' ' . $poll->author->name }} <time datetime="{{ $poll->created_at }}">{{ $poll->created_at->diffForHumans() }}</time></p>
                            </div>
                            <div class="hidden md:block md:text-0">
                                <div>
                                    <p class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 bg-{{ $poll->category->color }}-100 text-{{ $poll->category->color }}-800">{{ $poll->category->name }}</p>
                                    <div class="mt-2 text-sm leading-5 text-gray-500">
                                        <svg class="inline-block align-middle" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                            <line x1="18" y1="20" x2="18" y2="10" />
                                            <line x1="12" y1="20" x2="12" y2="4" />
                                            <line x1="6" y1="20" x2="6" y2="14" />
                                        </svg>
                                        <p class="inline-block align-middle">{{ __('20 votes') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20" height="20" width="20" aria-hidden="true">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
            </a>
        </li>
    @endforeach
</ol>
{{ $polls->links() }}
@endsection
