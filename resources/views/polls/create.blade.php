@extends('layouts.app')

@section('content')
<main class="flex-grow flex-shrink-0 bg-gray-50">
    <div class="container py-12">
        <div class="bg-white shadow px-4 py-5 sm:rounded-lg sm:p-6">
            <h1 class="text-lg leading-tight font-medium">{{ __('Create a Poll') }}</h1>
            <p class="mt-1 text-sm text-gray-500">{{ __('Your poll will be placed in the list of polls and voted on by the Poll Garden community.') }}</p>

            <form class="mt-6" action="{{ route('polls.store') }}" method="POST">
                @csrf

                <div>
                    <label class="block text-sm font-medium leading-tight text-gray-700" for="title">{{ __('Poll Title') }}</label>
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
                    <p class="block text-sm font-medium leading-tight text-gray-700">{{ __('Poll Options') }}</p>
                    @for ($i = 0; $i < 5; $i++)
                        <label class="sr-only" for="option{{ $i }}">{{ __('Option') . ' ' . ($i + 1) }}</label>
                        <div class="mt-1.5 rounded-md shadow-sm">
                            <input class="form-input block w-full {{ $i !== 0 ? 'mt-2' : '' }}"
                                   id="option{{ $i }}"
                                   name="options[{{ $i }}][name]"
                                   type="text"
                                   placeholder="{{ __('Option') . ' ' . ($i + 1) }}"
                                   autocomplete="none"
                                   {{ $i < 2 ? 'required' : '' }}>
                        </div>
                    @endfor
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
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('category_id')
                        <p class="mt-2 text-sm text-red-600" id="category-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end mt-6">
                    <button class="py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-green-600 hover:bg-green-500" type="submit">
                        {{ __('Create Poll') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection
