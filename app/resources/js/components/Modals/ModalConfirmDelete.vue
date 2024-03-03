<template></template>
<script>
export default {
    name: 'ModalConfirmDelete',
    created() {
        this.$bus.$on('fireModalConfirmDelete', this.fireModal)
    },

    methods: {
        fireModal({text, parameters}) {
            this.$swal.fire({
                title: this.$t('modals.confirm_delete.title'),
                html: text,
                icon: 'warning',
                showCancelButton: true,
                // confirmButtonColor: translate('js_messages.buttons.bg'),
                // cancelButtonColor: translate('js_messages.confirm.cancelBtnColor'),
                confirmButtonText: this.$t('buttons.submit'),
                cancelButtonText: this.$t('buttons.cancel')
            }).then((result) => {
                if (result.isConfirmed) {
                    this.$emit('confirmed', parameters)
                }
            })
        },
    }
}
</script>
