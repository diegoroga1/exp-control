<template></template>
<script>
export default{
    name: 'ModalForm',
    created(){
        this.$bus.$on('fireModalForm',this.fireModal)
    },
    props:{
        text: {require:true}
    },
    methods:{
            fireModal() {
                this.$swal.fire({
                    title: this.$t('modals.confirm_delete.title'),
                    html: "<input type='text' name='name' id='IdName'>",
                    showCancelButton: true,
                    // confirmButtonColor: translate('js_messages.buttons.bg'),
                    // cancelButtonColor: translate('js_messages.confirm.cancelBtnColor'),
                    confirmButtonText: this.$t('buttons.save'),
                    cancelButtonText: this.$t('buttons.cancel')
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.$emit('save', result.value)
                    }
                })
            }

    }
}
</script>
