<template></template>
<script>
import Swal from 'sweetalert2'

export default{
    name: 'ModalConfirm',
    created(){
        this.$bus.$on('fireConfirm',this.fireModal)
    },
    props:{
        text: {require:true}
    },
    methods:{
        fireModal(value){
            // this.$swal.confirm(html, callback, parameters) {
            //     Swal.fire({
            //         title: translate('js_messages.confirm.delete.title'),
            //         html,
            //         icon: 'question',
            //         showCancelButton: true,
            //         confirmButtonColor: translate('js_messages.buttons.bg'),
            //         cancelButtonColor: translate('js_messages.confirm.cancelBtnColor'),
            //         confirmButtonText: translate('js_messages.confirm.confirmBtnText'),
            //         cancelButtonText: translate('js_messages.confirm.cancelBtnText'),
            //     }).then((result) => {
            //         if (result.isConfirmed) {
            //             callback(parameters)
            //         }
            //     })
            // },
        }
    }
}
</script>
