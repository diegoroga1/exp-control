<template></template>
<script>
export default{
    name: 'ModalConfirmFn',
    created(){
        this.$bus.$on('fireModalConfirmFn',this.fireModal)
    },
    props:{
        text: {require:true}
    },
    methods:{
        fireModal({text,parameters,fn}){
            this.$swal.fire({
                title: '',
                html: text,
                icon: 'warning',
                showCancelButton: true,
                // confirmButtonColor: translate('js_messages.buttons.bg'),
                // cancelButtonColor: translate('js_messages.confirm.cancelBtnColor'),
                confirmButtonText: this.$t('buttons.submit'),
                cancelButtonText: this.$t('buttons.cancel')
            }).then((result) => {
                if (result.isConfirmed) {
                    fn(parameters)
                }
            })
        }
    }
}
</script>
