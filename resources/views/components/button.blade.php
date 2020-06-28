<button {{ $attributes->merge([
    'class' => 'py-2 px-4 text-sm font-medium leading-5 text-white border-1 border-transparent rounded-md bg-green-600 hover:bg-green-500',
    'type' => 'button'
]) }}>
    {{ $slot }}
</button>
