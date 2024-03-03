<template>
    <card-template>
        <template slot="titleCard">{{ this.$trans.users.system_users }}</template>
        <div class="table-responsive">
            <inno-core-datatable
                :enableCreateBtn="this.$helpers.hasPermission('admin.users.create')"
                :enableEditBtn="this.$helpers.hasPermission('admin.users.update')"
                :enableDeleteBtn="this.$helpers.hasPermission('admin.users.delete')"
                :idTable="idTable"
                :columnsData="columns"
                :rowItems="items"
                :customFields="customFields"
                @edit="editUser"
                @delete="deleteUser"
                @new="newUser"
            />
        </div>
        <modal-confirm-delete @confirmed="removeUser"/>
    </card-template>
</template>
<script>
export default {
    name: 'UsersList',
    created() {
        this.getItems()
    },
    data() {
        return {
            idTable: 'usersTable',
            items: [],
            customFields: [],
            columns: [
                {
                    field: 'id',
                    label: '#',
                    display: 'min_tabletP',
                },
                {
                    field: 'name',
                    label: this.$trans.users.name,
                },
                {
                    field: 'email',
                    label: this.$trans.users.email,
                    display: 'min_tabletP',
                },
                {
                    field: 'customer',
                    label: this.$trans.users.customer,
                    display: 'min_tabletP',
                },
                {
                    field: 'options',
                    label: this.$trans.users.options,
                }
            ]
        }
    },
    computed: {},
    methods: {
        getItems() {
            axios.get('/api-admin/admin/users').then(response => {
                const rows = response.data
                this.items = rows
            })
        },
        editUser(user) {
            window.location = `/admin/users/${user.id}`
        },
        deleteUser(user) {
            this.$bus.$emit('fireModalConfirmDelete', {
                text: this.$t('modals.confirm_delete.delete_user', {user: user.name}),
                parameters: user
            })
        },
        removeUser(user) {
            axios.delete(`/api-admin/admin/users/${user.id}`).then(response => {
                const {data} = response
                this.items = data
                this.$toast.success(this.$t('toast.delete_success'))
            })
        },
        newUser() {
            window.location = '/admin/users/create'
        }
    }

}
</script>
