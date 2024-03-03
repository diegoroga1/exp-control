<template>
    <div>
        <CardTemplate>
            <template slot="titleCard">{{ this.$trans.permissions.permissions }}</template>
            <div class="table-responsive">
                <inno-core-datatable
                    :btnConfig="true"
                    :enableCreateBtn="this.$helpers.hasPermission('admin.perms.create')"
                    :enableEditBtn="this.$helpers.hasPermission('admin.perms.update')"
                    :enableDeleteBtn="this.$helpers.hasPermission('admin.perms.delete')"
                    :idTable="idTable"
                    :columnsData="columns"
                    :rowItems="items"
                    :customFields="customFields"
                    @edit="edit"
                    @delete="deleteModal"
                    @new="newItem"
                    @config="show"
                ></inno-core-datatable>
            </div>
        </CardTemplate>
        <modal-confirm-delete @confirmed="deleteConfirmed"/>
        <permission-form-modal :id="idModalForm" :current="currentItem" @saved="getItems"></permission-form-modal>
    </div>
</template>

<script>
import PermissionFormModal from './PermissionFormModal'
export default {
    name: 'PermissionsList',
    components: {
        PermissionFormModal
    },
    created() {
        this.getItems()
    },
    data() {
        return {
            currentItem: null,
            idModalForm: 'newPermission',
            idTable: 'permissionsTable',
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
                    field: 'group',
                    label: this.$trans.permissions.group,
                    display: 'min_tabletP',
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
            axios.get('/api-admin/admin/permissions').then(response => {
                const rows = response
                this.items = rows
            })
        },
        edit(item) {
            this.currentItem = item
            $(`#${this.idModalForm}`).modal('show')
        },
        show(item) {
            window.location = `/admin/permissions/${item.id}`
        },
        deleteModal(item) {
            this.$bus.$emit('fireModalConfirmDelete', {
                text: this.$t('modals.confirm_delete.delete_item', {item: item.name}),
                parameters: item
            })
        },
        deleteConfirmed(item) {
            axios.delete(`/api-admin/admin/permissions/${item.id}`).then(response => {
                this.items = response
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
