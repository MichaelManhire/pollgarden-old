<template>
    <form class="px-2 sm:px-6" action="" method="">
        <fieldset>
            <legend class="sr-only">{{ title }}</legend>
            <ballot-box-option :id="option.id"
                               :index="index"
                               :name="option.name"
                               :total-votes="totalVotes"
                               :votes="option.votes.length"
                               v-for="(option, index) in options"
                               v-bind:key="option.id" />
        </fieldset>

        <button class="sr-only" type="submit">Cast Your Vote</button>
    </form>
</template>

<script>
export default {
    props: ['hasVoted', 'options', 'title'],
    computed: {
        totalVotes: function () {
            return this.options.reduce(function (accumulator, currentValue) {
                return accumulator + currentValue.votes.length;
            }, 0);
        },
    },
    data: function () {
        return {
            option: '',
        };
    },
};
</script>
