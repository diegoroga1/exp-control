<template>
    <div>
        <div class="card mb-4">
            <div class="p-2 pb-0">
                <div class="row">
                    <div class="col-sm-8 mb-2">
                        <h4 class="mt-2 mb-0"> {{item.description}}</h4>
                    </div>
                    <div class="col-sm-4 text-right mb-2">
                        <button @click="save" class="btn btn-primary">{{ this.$t('buttons.save') }}</button>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 mb-4">
                <user-selector :multiple="true" @add="addUser" :current="item.users"></user-selector>
            </div>
        </div>

    </div>
</template>
<script>
import UserSelector from '../users/UserSelector'

export default {
    name: "PermissionItem",
    props: ['permission_id'],
    created() {
        this.setData()
    },
    components: {
        UserSelector
    },
    data() {
        return {
            item: {
                users: []
            },
        }
    },
    methods: {
        setData() {
            axios.get(`/api-admin/admin/permissions/${this.permission_id}`).then(response => {
                this.item= response.data
            })
        },

        togglePermission(currentSelected) {
            this.item.permissions = currentSelected
        },
        save() {
            axios.post(`/api-admin/admin/permissions/${this.item.id}/users`, {'users': this.item.users}).then(response => {
                this.item = response.data
                this.$helpers.toastSuccess()
            })
        },
        addUser(currentUsers) {
            this.item.users = currentUsers
        }
    }
}
</script>
