@extends('layouts.app')

@section('title', 'Edit Your Poll')

@section('content')
<x-panel class="p-6">
    <article>
        <h1 class="text-lg font-medium leading-tight">Edit Your Poll</h1>

        <form class="mt-6" action="{{ route('polls.update', $poll) }}" method="POST">
            @csrf
            @method('PATCH')

            <div>
                <label class="block text-sm font-medium leading-tight" for="title">Title</label>
                <div class="mt-1.5 rounded-md shadow-sm">
                    <input class="form-input block w-full @error('title') border-red-300 text-red-900 @enderror"
                           id="title"
                           name="title"
                           type="text"
                           value="{{ $poll->title }}"
                           required
                           autocomplete="off"
                           autofocus
                           maxlength="255"
                           @error('title')
                           aria-invalid="true"
                           aria-describedby="title-error"
                           @enderror>
                </div>
                @error('title')
                    <p class="mt-2 text-sm text-red-600" id="title-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-4">
                <label class="block text-sm font-medium leading-tight" for="category_id">Category</label>
                <div class="mt-1.5 rounded-md shadow-sm">
                    <select class="form-select block w-full @error('category_id') border-red-300 text-red-900 @enderror"
                            id="category_id"
                            name="category_id"
                            autocomplete="off"
                            required
                            @error('category_id')
                            aria-invalid="true"
                            aria-describedby="category-error"
                            @enderror>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $poll->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('category_id')
                    <p class="mt-2 text-sm text-red-600" id="category-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end mt-6">
                <x-button>Update Poll</x-button>
            </div>
        </form>
    </article>
</x-panel>
@endsection
