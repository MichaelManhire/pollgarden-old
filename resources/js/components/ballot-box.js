window.ballotBox = function (myParameter) {
    return {
        isShowingResults: myParameter,

        vote() {
            this.$el.querySelectorAll('.js-ballot-box-form')[0].submit()
        },

        initResults() {
            if (this.isShowingResults) {
                setTimeout(() => {
                    this.showResults()
                }, 250)
            }
        },

        showResults() {
            this.isShowingResults = true

            document.querySelectorAll('.js-result-bar').forEach(function (resultBar) {
                resultBar.style.maxWidth = resultBar.dataset.percentage
            })
        },
    }
}
