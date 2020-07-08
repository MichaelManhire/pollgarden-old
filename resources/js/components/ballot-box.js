window.ballotBox = function (hasVoted, totalVotes) {
    return {
        hasVoted: !!hasVoted,
        isShowingResults: this.hasVoted,
        totalVotes: totalVotes,

        vote() {
            const form = this.$el.querySelector('.js-ballot-box-form')
            const selectedOptionId = form.querySelector('input[name="option_id"]:checked').value

            if (hasVoted) {
                form.submit();
                return;
            }

            axios.post(form.getAttribute('action'), {
                'option_id': selectedOptionId,
            })
                .then((response) => {
                    if (response.status === 200) {
                        this.updateTotal()
                        this.updateOptions(selectedOptionId)
                        this.showResults()
                    } else {
                        form.submit()
                    }
                })
                .catch(function (error) {
                    if (error) {
                        console.error(error)
                    }
                })
        },

        updateTotal() {
            const totalWrapper = this.$el.querySelector('.js-total-votes')

            this.totalVotes = this.totalVotes + 1
            totalWrapper.textContent = `${this.totalVotes} ${this.totalVotes === 1 ? 'vote' : 'votes'}`
        },

        updateOptions(selectedOptionId) {
            const totalVotes = parseInt(this.totalVotes, 10)

            this.$el.querySelectorAll('.js-option').forEach(function (option) {
                let numberOfVotes = parseInt(option.dataset.votes, 10)

                if (option.dataset.id === selectedOptionId) {
                    numberOfVotes = numberOfVotes + 1
                    option.querySelector('.js-vote-icon').classList.remove('invisible')
                }

                const percentage = `${Math.round(numberOfVotes / totalVotes * 100)}%`
                option.querySelector('.js-percentage').textContent = percentage
                option.querySelector('.js-result-bar').dataset.percentage = percentage
            })
        },

        showResults() {
            this.isShowingResults = true

            document.querySelectorAll('.js-result-bar').forEach(function (resultBar) {
                resultBar.style.maxWidth = resultBar.dataset.percentage
            })
        },
    }
}
