<template>
    <div class="flex items-center mt-2">
        <!--
        <div class="flex-shrink-0 mr-3 text-green-600"
             v-bind:class="{ 'invisible': !hasVoted }">
            <svg width="24"
                 height="24"
                 viewBox="0 0 24 24"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="2"
                 stroke-linecap="round"
                 stroke-linejoin="round"
                 aria-hidden="true">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                <polyline points="22 4 12 14.01 9 11.01" />
            </svg>
        </div>
        -->
        <label class="relative flex-grow block py-5 pl-12 pr-4 leading-tight bg-gray-100 rounded-md cursor-pointer hover:bg-gray-200 transition-colors duration-150 ease-in-out fancy-radio-button-wrapper"
               :for="id">
            <input class="fancy-radio-button"
                   name="option_id"
                   type="radio"
                   required
                   :id="id"
                   :value="id"
                   v-model="option">
            <span class="relative z-10 font-medium">{{ name }}</span>
            <span class="relative z-10 float-right font-bold">{{ percentage }}</span>
            <span class="result-bar js-result-bar"
                  :style="{ 'background-color': color, 'max-width': percentage }"></span>
        </label>
    </div>
</template>

<script>
export default {
    props: ['id', 'index', 'name', 'totalVotes', 'votes'],
    computed: {
        percentage: function () {
            return `${Math.round(this.votes / this.totalVotes * 100)}%`;
        },

        color: function () {
            switch (this.index) {
                case 0:
                    return '#a3d9a5';
                    break;
                case 1:
                    return '#cfbcf2';
                    break;
                case 2:
                    return '#f9da8b';
                    break;
                case 3:
                    return '#a4cafe';
                    break;
                case 4:
                    return '#f8b4d9';
                    break;
                default:
                    return '#a3d9a5';
                    break;
            }
        },
    },
};
</script>
