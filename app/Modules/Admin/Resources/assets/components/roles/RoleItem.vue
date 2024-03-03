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
            <div class="col-sm-6 mb-4">
                <assign-permissions :expanded="true" :current="item.permissions" @toggled="togglePermission"></assign-permissions>
            </div>
            <div class="col-sm-6 mb-4">
                <user-selector :multiple="true" @add="addUser" :current="item.users"></user-selector>
            </div>
        </div>

    </div>
</template>
<script>
import AssignPermissions from '../permissions/AssignPermissions'
import UserSelector from '../users/UserSelector'

export default {
    name: "RoleItem",
    props: ['role_id'],
    created() {
        this.setData()
    },
    components: {
        AssignPermissions,
        UserSelector
    },
    data() {
        return {
            item: {
                permissions: [],
                users: []
            },
        }
    },
    methods: {
        setData() {
            axios.get(`/api-admin/admin/roles/${this.role_id}`).then(response => {
                this.setItemResponse(response)
            })
        },
        setItemResponse(response) {
            const item = response.item
            item.permissions = item.permissions.map(per => ({name: per.name, id: per.id}))
            this.item = item
        },
        togglePermission(currentSelected) {
            this.item.permissions = currentSelected
        },
        save() {
            axios.post(`/api-admin/admin/roles/${this.item.id}/permissions`, {'permissions': this.item.permissions}).then(response => {
                axios.post(`/api-admin/admin/roles/${this.item.id}/users`, {'users': this.item.users}).then(response => {
                    this.setItemResponse(response)
                    this.$helpers.toastSuccess()
                })
            })
        },
        addUser(currentUsers) {
            this.item.users = currentUsers
        }
    }
}
</script>
