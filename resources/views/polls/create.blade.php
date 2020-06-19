@extends('layouts.app')

@section('title', 'Create a Poll')

@section('content')
<article class="p-6 bg-white rounded-lg shadow">
    <h1 class="text-lg font-medium leading-tight">Create a Poll</h1>
    <p class="mt-1 text-sm text-gray-500">Your poll will be placed in the list of polls and voted on by the Poll Garden community.</p>

    <form class="mt-6" action="{{ route('polls.store') }}" method="POST">
        @csrf

        <div>
            <label class="block text-sm font-medium leading-tight" for="title">Poll Title</label>
            <div class="mt-1.5 rounded-md shadow-sm">
                <input class="form-input block w-full @error('title') border-red-300 text-red-900 @enderror"
                       id="title"
                       name="title"
                       type="text"
                       value="{{ old('title') }}"
                       autocomplete="off"
                       required
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
            <p class="block text-sm font-medium leading-tight">Poll Options</p>
            @for ($i = 0; $i < 5; $i++)
                <div>
                    <label class="sr-only" for="option{{ $i }}">Option {{ $i + 1 }}</label>
                    <div class="mt-1.5 rounded-md shadow-sm">
                        <input class="form-input block w-full {{ $i !== 0 ? 'mt-2' : '' }}"
                               id="option{{ $i }}"
                               name="options[{{ $i }}][name]"
                               type="text"
                               placeholder="Option {{ $i + 1 }}"
                               autocomplete="off"
                               {{ $i < 2 ? 'required' : '' }}>
                    </div>
                </div>
            @endfor
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
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            @error('category_id')
                <p class="mt-2 text-sm text-red-600" id="category-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end mt-6">
            <button class="py-2 px-4 text-sm font-medium leading-5 text-white border-1 border-transparent rounded-md bg-green-600 hover:bg-green-500" type="submit">
                Create Poll
            </button>
        </div>
    </form>
</article>
@endsection
