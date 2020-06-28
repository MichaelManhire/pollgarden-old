@extends('layouts.app')

@section('title', 'Create a Poll')

@section('content')
<x-panel class="p-6">
    <article>
        <h1 class="text-lg font-medium leading-tight">Create a Poll</h1>
        <p class="mt-1 text-sm text-gray-500">Your poll will be placed in the list of polls and voted on by the Poll Garden community.</p>

        <form class="mt-6" action="{{ route('polls.store') }}" method="POST">
            @csrf

            <div>
                <label class="block text-sm font-medium leading-tight" for="title">Title</label>
                <div class="mt-1.5 rounded-md shadow-sm">
                    <input class="form-input block w-full @error('title') border-red-300 text-red-900 @enderror"
                           id="title"
                           name="title"
                           type="text"
                           value="{{ old('title') }}"
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

            <fieldset class="mt-4">
                <legend class="block text-sm font-medium leading-tight">Options</legend>
                <div>
                    <label class="sr-only" for="option0">Option 1</label>
                    <div class="mt-1.5 rounded-md shadow-sm">
                        <input class="form-input block w-full @error('options.0.name') border-red-300 text-red-900 @enderror"
                               id="option0"
                               name="options[0][name]"
                               type="text"
                               value="{{ old('options.0.name') }}"
                               placeholder="Option 1"
                               required
                               autocomplete="off"
                               maxlength="255"
                               @error('options.0.name')
                               aria-invalid="true"
                               aria-describedby="option0-error"
                               @enderror>
                    </div>
                    @error('options.0.name')
                        <p class="mt-2 text-sm text-red-600" id="option0-error">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="sr-only" for="option0">Option 2</label>
                    <div class="mt-2 rounded-md shadow-sm">
                        <input class="form-input block w-full @error('options.1.name') border-red-300 text-red-900 @enderror"
                               id="option1"
                               name="options[1][name]"
                               type="text"
                               value="{{ old('options.1.name') }}"
                               placeholder="Option 2"
                               required
                               autocomplete="off"
                               maxlength="255"
                               @error('options.1.name')
                               aria-invalid="true"
                               aria-describedby="option0-error"
                               @enderror>
                    </div>
                    @error('options.1.name')
                        <p class="mt-2 text-sm text-red-600" id="option1-error">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="sr-only" for="option0">Option 3</label>
                    <div class="mt-2 rounded-md shadow-sm">
                        <input class="form-input block w-full @error('options.2.name') border-red-300 text-red-900 @enderror"
                               id="option2"
                               name="options[2][name]"
                               type="text"
                               value="{{ old('options.2.name') }}"
                               placeholder="Option 3"
                               autocomplete="off"
                               maxlength="255"
                               @error('options.2.name')
                               aria-invalid="true"
                               aria-describedby="option0-error"
                               @enderror>
                    </div>
                    @error('options.2.name')
                        <p class="mt-2 text-sm text-red-600" id="option2-error">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="sr-only" for="option0">Option 4</label>
                    <div class="mt-2 rounded-md shadow-sm">
                        <input class="form-input block w-full @error('options.3.name') border-red-300 text-red-900 @enderror"
                               id="option3"
                               name="options[3][name]"
                               type="text"
                               value="{{ old('options.3.name') }}"
                               placeholder="Option 4"
                               autocomplete="off"
                               maxlength="255"
                               @error('options.3.name')
                               aria-invalid="true"
                               aria-describedby="option0-error"
                               @enderror>
                    </div>
                    @error('options.3.name')
                        <p class="mt-2 text-sm text-red-600" id="option3-error">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="sr-only" for="option0">Option 5</label>
                    <div class="mt-2 rounded-md shadow-sm">
                        <input class="form-input block w-full @error('options.4.name') border-red-300 text-red-900 @enderror"
                               id="option4"
                               name="options[4][name]"
                               type="text"
                               value="{{ old('options.4.name') }}"
                               placeholder="Option 5"
                               autocomplete="off"
                               maxlength="255"
                               @error('options.4.name')
                               aria-invalid="true"
                               aria-describedby="option0-error"
                               @enderror>
                    </div>
                    @error('options.4.name')
                        <p class="mt-2 text-sm text-red-600" id="option4-error">{{ $message }}</p>
                    @enderror
                </div>
            </fieldset>

            <div class="mt-4">
                <label class="block text-sm font-medium leading-tight" for="category_id">Category</label>
                <div class="mt-1.5 rounded-md shadow-sm">
                    <select class="form-select block w-full @error('category_id') border-red-300 text-red-900 @enderror"
                            id="category_id"
                            name="category_id"
                            required
                            autocomplete="off"
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
                <x-button>Create Poll</x-button>
            </div>
        </form>
    </article>
</x-panel>
@endsection
