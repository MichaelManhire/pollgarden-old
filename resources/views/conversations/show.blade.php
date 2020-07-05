@extends('layouts.app')

@section('title', $conversation->sender->username . ' and ' . $conversation->recipient->username)

@section('content')
<article>
    <h1 class="sr-only">Messages between {{ $conversation->sender->username }} and {{ $conversation->recipient->username }}</h1>

    <x-panel class="p-4">
        <form action="{{ route('messages.store') }}" method="POST">
            @csrf

            <div>
                <label class="sr-only" for="body">Message</label>
                    <div class="rounded-md shadow-sm">
                        <textarea class="form-input block w-full @error('body') border-red-300 text-red-900 @enderror"
                                  id="body"
                                  name="body"
                                  placeholder="Write your message here..."
                                  rows="5"
                                  required
                                  autocomplete="off"
                                  autofocus
                                  maxlength="3000"
                                  @error('body')
                                  aria-invalid="true"
                                  aria-describedby="body-error"
                                  @enderror></textarea>
                    </div>
                    @error('body')
                        <p class="mt-2 text-sm text-red-600" id="body-error">{{ $message }}</p>
                    @enderror
            </div>

            <input name="conversation_id" type="hidden" value="{{ $conversation->id }}">

            <div class="flex justify-end mt-4">
                <x-button>Send Message</x-button>
            </div>
        </form>
    </x-panel>

    <ol class="mt-4">
        @foreach ($messages as $message)
            <li class="{{ ($loop->first) ? '' : 'mt-4' }}" x-data="{ isEditing: false }">
                <x-panel class="p-4">
                    <article>
                        <div class="flex items-start">
                            <a class="flex-shrink-0 text-white" href="{{ route('users.show', $message->author) }}">
                                <x-avatar :src="$message->author->getAvatar()" />
                            </a>

                            <div class="ml-4">
                                <h2>
                                    <a class="text-green-600 hover:underline" href="{{ route('users.show', $message->author) }}">{{ $message->author->username }}</a>
                                </h2>
                                <p class="mt-1">{{ $message->body }}</p>
                            </div>
                        </div>

                        <footer class="mt-2 text-right text-sm">
                            <p class="inline-block">
                                <span>Sent</span>
                                <time datetime="{{ $message->created_at }}">{{ $message->created_at->diffForHumans() }}</time>
                                @if ($message->created_at != $message->updated_at)
                                    <span>(edited <time datetime="{{ $message->updated_at }}">{{ $message->updated_at->diffForHumans() }}</time>)</span>
                                @endif
                            </p>

                            @can('update', $message)
                                <button class="inline-block ml-2 text-green-600 hover:underline"
                                        type="button"
                                        @click="isEditing = !isEditing; if (isEditing) { setTimeout(function () { $refs.editField.focus() }, 1) }"
                                        x-text="! isEditing ? 'Edit' : 'Cancel Edit'">
                                    Edit
                                </button>
                            @endcan

                            @can('delete', $message)
                                <form class="inline-block ml-2" action="{{ route('messages.destroy', $message) }}" method="POST" x-data @submit.prevent="if (confirm('Are you sure you want to delete your message?')) { $el.submit() }">
                                    @csrf
                                    @method('DELETE')

                                    <button class="text-green-600 hover:underline" type="submit">Delete</button>
                                </form>
                            @endcan
                        </footer>
                    </article>
                </x-panel>

                <x-panel class="p-4 mt-4" x-show="isEditing">
                    <form action="{{ route('messages.update', $message) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div>
                            <label class="block text-sm font-medium leading-tight" for="body">Edit Message</label>
                                <div class="mt-1.5 rounded-md shadow-sm">
                                    <textarea class="form-input block w-full @error('body') border-red-300 text-red-900 @enderror"
                                              id="body"
                                              name="body"
                                              placeholder="Write your message here..."
                                              rows="5"
                                              required
                                              autocomplete="off"
                                              autofocus
                                              maxlength="3000"
                                              x-ref="editField"
                                              @error('body')
                                              aria-invalid="true"
                                              aria-describedby="body-error"
                                              @enderror>{{ $message->body }}</textarea>
                                </div>
                                @error('body')
                                    <p class="mt-2 text-sm text-red-600" id="body-error">{{ $message }}</p>
                                @enderror
                        </div>

                        <input name="conversation_id" type="hidden" value="{{ $conversation->id }}">

                        <div class="flex justify-end mt-4">
                            <x-button>Update Message</x-button>
                        </div>
                    </form>
                </x-panel>
            </li>
        @endforeach
    </ol>

    @if ($messages->hasPages())
        {{ $messages->links() }}
    @endif
</article>
@endsection
