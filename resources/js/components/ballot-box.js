window.ballotBox = function (hasVoted) {
    return {
        isShowingResults: !!hasVoted,

        vote() {
            const form = this.$el.querySelector('.js-ballot-box-form')

            form.submit();
        },

        showResults() {
            this.isShowingResults = true

            document.querySelectorAll('.js-result-bar').forEach(function (resultBar) {
                resultBar.style.maxWidth = resultBar.dataset.percentage
            })
        },
    }
}
