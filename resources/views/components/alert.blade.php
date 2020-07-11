<aside class="p-4 mb-4 bg-green-50 rounded-md" role="alert">
    <div class="flex">
        <div class="flex-shrink-0 text-green-400">
            @include('icons.check', ['width' => '20', 'height' => '20'])
        </div>
        <div class="ml-3">
            <h2 class="sr-only">Success</h2>
            <div class="text-sm font-medium leading-5 text-green-800">
                <p>{{ $slot }}</p>
            </div>
        </div>
    </div>
</aside>
