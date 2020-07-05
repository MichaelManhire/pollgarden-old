window.comment = function () {
    return {
        isEditing: false,
        isReplying: false,

        toggleReplyForm() {
            this.isReplying = ! this.isReplying

            if (this.isReplying) {
                setTimeout(() => {
                    this.$refs.replyField.focus()
                }, 1)
            }
        },

        toggleEditForm() {
            this.isEditing = ! this.isEditing

            if (this.isEditing) {
                setTimeout(() => {
                    this.$refs.editField.focus()
                }, 1)
            }
        },
    }
}
