<div>
    <label class="block text-sm font-medium leading-tight" for="title">Title</label>
    <div class="mt-1.5 rounded-md shadow-sm">
        <input class="form-input block w-full focus:border-green-300 focus:shadow-outline-green @error('title') border-red-300 text-red-900 @enderror"
               id="title"
               name="title"
               type="text"
               value="{{ old('title') }}"
               autocomplete="off"
               autofocus
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
