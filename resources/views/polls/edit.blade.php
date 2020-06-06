@extends('layouts.app')

@section('title', 'Create a Poll' . ' - ' . config('app.name', 'Poll Garden'))

@section('content')
<div class="bg-white shadow px-4 py-5 rounded-lg sm:p-6">
    <h1 class="text-lg leading-tight font-medium">{{ __('Edit Your Poll') }}</h1>

    <form class="mt-6" action="{{ route('polls.update', $poll) }}" method="POST">
        @csrf
        @method('PATCH')

        <div>
            <label class="block text-sm font-medium leading-tight text-gray-700" for="title">{{ __('Poll Title') }}</label>
            <div class="mt-1.5 rounded-md shadow-sm">
                <input class="form-input block w-full @error('title') border-red-300 text-red-900 @enderror"
                       id="title"
                       name="title"
                       type="text"
                       value="{{ $poll->title }}"
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
            <label class="block text-sm font-medium leading-tight text-gray-700" for="category_id">{{ __('Category') }}</label>
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
            <button class="py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-green-600 hover:bg-green-500" type="submit">
                {{ __('Update Poll') }}
            </button>
        </div>
    </form>
</div>
@endsection
