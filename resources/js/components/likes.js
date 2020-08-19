window.likes = function (totalLikes) {
    return {
        totalLikes,

        like() {
            const form = this.$el.querySelector('.js-like-form')

            axios.post(form.getAttribute('action'), {
                'comment_id': form.querySelector('input[name="comment_id"]').value,
            })
                .then((response) => {
                    if (response.status === 200) {
                        this.addLike()
                    } else {
                        form.submit()
                    }
                })
        },

        unlike() {
            const form = this.$el.querySelector('.js-like-form')

            axios.delete(form.getAttribute('action'),)
                .then((response) => {
                    if (response.status === 200) {
                        this.removeLike()
                    } else {
                        form.submit()
                    }
                })
        },

        addLike() {
            const totalWrapper = this.$el.querySelector('.js-total-likes')

            this.totalLikes = this.totalLikes + 1
            totalWrapper.textContent = this.totalLikes
        },

        removeLike() {
            const totalWrapper = this.$el.querySelector('.js-total-likes')

            this.totalLikes = this.totalLikes - 1
            totalWrapper.textContent = this.totalLikes
        }
    }
}
