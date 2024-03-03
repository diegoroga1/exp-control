<template>
    <div>
        <CardTemplate>
            <template slot="titleCard">{{ this.$trans.roles.roles }}</template>
            <div class="table-responsive">
                <inno-core-datatable
                    :btnConfig="true"
                    :enableCreateBtn="this.$helpers.hasPermission('admin.roles.create')"
                    :enableEditBtn="this.$helpers.hasPermission('admin.roles.update')"
                    :enableDeleteBtn="this.$helpers.hasPermission('admin.roles.delete')"
                    :idTable="idTable"
                    :columnsData="columns"
                    :rowItems="items"
                    :customFields="customFields"
                    @edit="edit"
                    @delete="deleteModal"
                    @new="newItem"
                    @config="show"
                />
            </div>
        </CardTemplate>
        <modal-confirm-delete @confirmed="deleteConfirmed"/>
        <RoleModal :id="idModalForm" :current="currentItem" @saved="getItems"></RoleModal>
    </div>
</template>

<script>
import RoleModal from './RoleFormModal.vue'

export default {
    name: 'RolesList',
    components: {
        RoleModal
    },
    created() {
        this.getItems()
    },
    data() {
        return {
            currentItem: null,
            idModalForm: 'NewRole',
            idTable: 'rolesTable',
            items: [],
            customFields: [
                // {field: 'name', content: 'pepito'}
            ],
            columns: [
                {
                    field: 'id',
                    label: '#',
                    display: 'min_tabletP',
                },
                {
                    field: 'name',
                    label: this.$t('Name'),
                },
                {
                    field: 'description',
                    label: this.$t('Description'),
                    display: 'min_tabletP',
                },
                {
                    field: 'options',
                    label: this.$t('Options'),
                }
            ]
        }
    },
    computed: {},
    methods: {
        getItems() {
            axios.get('/api-admin/admin/roles').then(response => {
                const rows = response.data
                this.items = rows
            })
        },
        edit(item) {
            this.currentItem = item
            $(`#${this.idModalForm}`).modal('show')
        },
        show(item) {
            window.location = `/admin/roles/${item.id}`
        },
        deleteModal(item) {
            this.$bus.$emit('fireModalConfirmDelete', {
                text: this.$t('modals.confirm_delete.delete_item', {item: item.name}),
                parameters: item
            })
        },
        deleteConfirmed(item) {
            axios.delete(`/api-admin/admin/roles/${item.id}`).then(response => {
                const {data} = response
                this.items = data
                this.$helpers.toastSuccess()
            })
        },
        newItem() {
            this.currentItem = null
            $(`#${this.idModalForm}`).modal('show')
        }
    }

}
</script>
