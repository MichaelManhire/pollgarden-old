<article class="block mt-5" @auth x-data="ballotBox({{ $hasVoted }})" @vote.window="showResults()" @endauth">
    @auth
        <h2 class="sr-only">{{ $hasVoted ? 'Change Your Vote' : 'Cast Your Vote' }}</h2>
        <form class="px-2 sm:px-6 js-ballot-box-form"
              action="{{ $hasVoted ? route('votes.update', $vote->id) : route('votes.store') }}"
              method="POST"
              @if ($hasVoted)
                  wire:submit.prevent="vote()"
              @endif>
            @csrf
            @if ($hasVoted)
                @method('PATCH')
            @endif

            <fieldset>
                <legend class="sr-only">{{ $poll->title }}</legend>
                @foreach ($poll->options as $option)
                    <div class="flex items-center {{ ($loop->first) ? '' : 'mt-2' }}">
                        <div class="flex-shrink-0 mr-3 text-green-600 {{ !$hasVoted || $vote->option_id != $option->id ? 'invisible' : '' }}">
                            @include('icons.check-circled', ['height' => '24', 'width' => '24'])
                        </div>
                        <label class="relative flex-grow block py-5 pl-12 pr-4 leading-tight bg-gray-100 rounded-md js-label cursor-pointer hover:bg-gray-200 transition-colors duration-150 ease-in-out fancy-radio-button-wrapper"
                               for="{{ $option->id }}">
                            <input class="fancy-radio-button"
                                   id="{{ $option->id }}"
                                   name="option_id"
                                   type="radio"
                                   value="{{ $option->id }}"
                                   required
                                   @if ($hasVoted)
                                       {{ $vote->option_id == $option->id ? 'checked' : '' }}
                                       @change="vote()"
                                   @else
                                       wire:model="option_id"
                                       wire:change="$emit('optionSelected')"
                                   @endif>
                            <span class="relative z-10 font-medium">{{ $option->name }}</span>
                            <span class="relative z-10 float-right font-bold" x-show="isShowingResults">
                                {{ $option->percentage($totalVotes) }}
                            </span>
                            <span class="result-bar js-result-bar"
                                  data-percentage="{{ $option->percentage($totalVotes) }}"
                                  style="background-color: {{ $option->color($loop->index) }}; max-width: {{ $hasVoted ? $option->percentage($totalVotes) : 0 }};"></span>
                        </label>
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
                    <div class="flex-shrink-0 mr-3 text-green-600 invisible">
                        @include('icons.check-circled', ['height' => '24', 'width' => '24'])
                    </div>
                    <p class="relative flex-grow block py-5 pl-12 pr-4 leading-tight bg-gray-100 rounded-md">
                        <span class="fancy-radio-button-placeholder"></span>
                        <span class="relative z-10 font-medium">{{ $option->name }}</span>
                        <span class="relative z-10 float-right font-bold">{{ $option->percentage($totalVotes) }}</span>
                        <span class="result-bar js-result-bar"
                              data-percentage="{{ $option->percentage($totalVotes) }}"
                              style="background-color: {{ $option->color($loop->index) }}; max-width: {{ $option->percentage($totalVotes) }};"></span>
                    </p>
                </li>
            @endforeach
        </ul>
    @endauth

    <div class="flex items-center mt-6 py-2 px-2 sm:px-6 border-t border-gray-100">
        <div class="text-xs sm:text-sm text-gray-600">
            <div class="inline-block align-middle">
                @include('icons.poll', ['width' => '16', 'height' => '16'])
            </div>
            <p class="inline-block align-middle">
                {{ $totalVotes }} {{ $totalVotes === 1 ? 'vote' : 'votes' }}
            </p>
        </div>

        <div class="ml-4 text-xs sm:text-sm text-gray-600">
            <div class="inline-block align-middle">
                @include('icons.comment', ['width' => '16', 'height' => '16'])
            </div>
            <p class="inline-block align-middle">{{ $poll->numberOfComments() }}</p>
        </div>

        @auth
            <button class="ml-auto text-xs sm:text-sm text-green-600 hover:underline"
                    type="button"
                    x-show="! isShowingResults"
                    :disabled="isShowingResults"
                    @click="showResults()">
                Show Results
            </button>

            @can('delete', $vote)
                <form class="ml-auto"
                      action="{{ route('votes.destroy', $vote->id) }}"
                      method="POST">
                    @csrf
                    @method('DELETE')

                    <button class="text-xs sm:text-sm text-green-600 hover:underline" type="submit">
                        Withdraw Your Vote
                    </button>
                </form>
            @endcan
        @endauth
    </div>
</article>
