<template>
    <div class="tab-content py-3 mt-2">
        <div class="tab-pane active" id="pill-tabpanel-0" role="tabpanel" aria-labelledby="pill-tab-0">

            <div class="table-responsive">
                <inno-core-datatable
                    :btnConfig="false"
                    :enableCreateBtn="false"
                    :enableEditBtn="false"
                    :enableDeleteBtn="false"
                    :idTable="idTable"
                    :columnsData="columns"
                    :rowItems="items"
                    @delete="deleteModal"
                    @config="show"
                >


                </inno-core-datatable>
            </div>
            <modal-confirm-delete @confirmed="deleteConfirmed"/>
        </div>
        <div class="tab-pane" id="pill-tabpanel-1" role="tabpanel" aria-labelledby="pill-tab-1">Tab 2 content</div>
        <div class="tab-pane" id="pill-tabpanel-2" role="tabpanel" aria-labelledby="pill-tab-2">Tab 3 content</div>
    </div>
</template>


<script>

export default {
    name: "TransactionsList",
    created() {
        this. getItems()
    },
    data() {
        return {
            idTable: 'transactionsTable',
            items: [],
            columns: [

                {
                    field: 'amountCurrency',
                    label: this.$t('Amount'),
                },
                {
                    field: 'date',
                    label: this.$t("Date"),
                },
                {
                    field: 'category',
                    label: this.$t('Category'),
                },
                {
                    field: 'subcategory',
                    label: this.$t('Subcategory'),
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
            axios.get('/api-admin/transactions',{headers:{Authorization:"Bearer "}}).then(response => {
                const rows = response.data
                this.items = rows
            })
        },
        show(item) {
            // TODO: OPEN MODAL TO SHOW TRANSACTION DATA
        },
        deleteModal(item) {
            this.$bus.$emit('fireModalConfirmDelete', {
                text: this.$t('modals.confirm_delete.delete_item', {item: item.name}),
                parameters: item
            })
        },
        deleteConfirmed(item) {
            axios.delete(`/api-admin/transactions/${item.id}`).then(response => {
                this.items = response
                this.$helpers.toastSuccess()
            })
        }
    }
}
</script>


<style scoped lang="scss">

</style>
