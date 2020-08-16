window.ballotBox = function (isShowingResults) {
    return {
        isShowingResults: isShowingResults,

        vote() {
            const form = this.$el.querySelector('.js-ballot-box-form');

            form.submit();
        },

        showResults(hasTransitionEffect) {
            this.isShowingResults = true;

            document.querySelectorAll('.js-result-bar').forEach(function (resultBar) {
                if (hasTransitionEffect) {
                    resultBar.style.transition = 'max-width 0.5s linear';
                }

                resultBar.style.maxWidth = resultBar.dataset.percentage;
            });
        },
    };
};
