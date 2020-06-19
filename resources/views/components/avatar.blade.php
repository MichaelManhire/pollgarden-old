@if ($isLink)
    <a class="flex-shrink-0 text-white" href="{{ $href }}">
        <img class="rounded-full shadow-solid" src="{{ $src }}" alt="" height="48" width="48" loading="lazy">
    </a>
@else
    <div class="flex-shrink-0 text-white">
        <img class="rounded-full shadow-solid" src="{{ $src }}" alt="" height="48" width="48" loading="lazy">
    </div>
@endif
