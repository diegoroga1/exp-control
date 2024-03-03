<template>
    <div class="modal fade" :id="id" tabindex="-1" role="dialog" aria-labelledby="NewRoleModal"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ this.$trans.roles.roles }}</h5>
                    <button @click="hideModal" class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form @submit="saveData">
                    <div class="modal-body">
                        <label class="required">{{ this.$trans.roles.role_name }}</label>
                        <input type="text" v-model="item.name" class="form-control">
                    </div>
                    <div class="modal-body">
                        <label class="required">{{ this.$trans.roles.role_description }}</label>
                        <input type="text" v-model="item.description" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button @click="hideModal" class="btn btn-dark" type="button" data-dismiss="modal">
                            {{ this.$t('buttons.cancel') }}
                        </button>
                        <button type="submit" class="btn btn-primary">{{ this.$t('buttons.save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: "RoleFormModal",
    props: ['id', 'current'],
    watch: {
        current: function (newItem) {
            this.item = {...newItem}
            if (!newItem) this.item = {name: null,description:null}
        }
    },
    data() {
        return {
            item: {
                name: null,
                description:null
            },
        }
    },
    methods: {
        hideModal() {
            $(`#${this.id}`).modal('hide')
        },
        resetData() {

        },
        saveData(e) {
            e.preventDefault()
            axios.post('/api-admin/admin/roles', this.item).then(response => {
                this.hideModal()
                this.resetData()
                this.$helpers.toastSuccess()
                this.$emit('saved')
            })
        }
    }
}
</script>
