<article class="block mt-5" @auth x-data="ballotBox({{ $hasVoted }})" x-init="initResults() @endauth">
@auth
    <h2 class="sr-only">{{ $hasVoted ? 'Change Your Vote' : 'Cast Your Vote' }}</h2>
    <form class="js-ballot-box-form px-6" action="{{ $hasVoted ? route('votes.update', Auth::user()->vote($poll)->id) : route('votes.store') }}" method="POST">
        @csrf
        @if ($hasVoted)
            @method('PATCH')
        @endif

        <fieldset>
            <legend class="sr-only">{{ $poll->title }}</legend>
            @foreach ($poll->options as $option)
                <div class="flex items-center {{ ($loop->first) ? '' : 'mt-2' }}">
                    <label class="relative flex-grow block py-4 pl-12 pr-4 bg-gray-100 rounded-md
                           {{ !$hasVoted || (Auth::user()->vote($poll)->option_id !== $option->id) ? 'cursor-pointer hover:bg-gray-200 transition-colors duration-150 ease-in-out      fancy-radio-button-wrapper' : '' }}"
                           for="{{ $option->id }}">
                        <input class="fancy-radio-button"
                               id="{{ $option->id }}"
                               name="option_id"
                               type="radio"
                               value="{{ $option->id }}"
                               required
                               @if ($hasVoted)
                                    {{ Auth::user()->vote($poll)->option_id === $option->id ? 'checked' : '' }}
                               @endif
                               @change="vote()">
                        <span class="relative z-10 font-medium">{{ $option->name }}</span>
                        <span class="relative z-10 float-right font-bold" x-show="isShowingResults">{{ $option->percentage($poll->votes->count()) }}</span>
                        <span class="result-bar js-result-bar"
                              data-percentage="{{ $option->percentage($poll->votes->count()) }}"
                              style="background-color: {{ $option->color($loop->index) }};"></span>
                    </label>
                    <div class="flex-shrink-0 ml-3 text-green-600 {{ !$hasVoted || (Auth::user()->vote($poll)->option_id !== $option->id) ? 'invisible' : '' }}">
                        @include('icons.checkmark', ['height' => '24', 'width' => '24'])
                    </div>
                </div>
            @endforeach
        </fieldset>

        <button class="sr-only" type="submit">{{ $hasVoted ? 'Change Your Vote' : 'Cast Your Vote' }}</button>
    </form>
@else
    <h2 class="sr-only">Poll Results</h2>
    <ul>
        @foreach ($poll->options as $option)
            <li class="flex items-center px-6 {{ ($loop->first) ? '' : 'mt-2' }}">
                <p class="relative flex-grow block py-4 pl-12 pr-4 bg-gray-100 rounded-md">
                    <span class="fancy-radio-button-placeholder"></span>
                    <span class="relative z-10 font-medium">{{ $option->name }}</span>
                    <span class="relative z-10 float-right font-bold">{{ $option->percentage($poll->votes->count()) }}</span>
                    <span class="result-bar js-result-bar"
                          data-percentage="{{ $option->percentage($poll->votes->count()) }}"
                          style="background-color: {{ $option->color($loop->index) }}; max-width: {{ $option->percentage($poll->votes->count()) }};"></span>
                </p>
                <div class="flex-shrink-0 ml-3 text-green-600 invisible">
                    @include('icons.checkmark', ['height' => '24', 'width' => '24'])
                </div>
            </li>
        @endforeach
    </ul>
@endauth

<div class="flex mt-6 py-2 px-6 border-t border-gray-100">
    <div class="text-sm text-gray-600">
        <div class="inline-block align-middle">
            @include('icons.poll', ['width' => '16', 'height' => '16'])
        </div>
        <p class="inline-block align-middle">{{ $poll->numberOfVotes() }}</p>
    </div>

    <div class="ml-4 text-sm text-gray-600">
        <div class="inline-block align-middle">
            @include('icons.comment', ['width' => '16', 'height' => '16'])
        </div>
        <p class="inline-block align-middle">{{ $poll->numberOfComments() }}</p>
    </div>

    @auth
        <button class="ml-auto text-sm text-green-600 hover:underline"
                type="button"
                x-show="! isShowingResults"
                :disabled="isShowingResults"
                @click="showResults()">
            Show Results
        </button>

        @can('delete', Auth::user()->vote($poll))
            <form class="ml-auto" action="{{ route('votes.destroy', Auth::user()->vote($poll)->id) }}" method="POST">
                @csrf
                @method('DELETE')

                <button class="text-sm text-green-600 hover:underline" type="submit">Withdraw Your Vote</button>
            </form>
        @endcan
    @endauth
</div>
</article>
