<template>
    <div>
        <v-client-table :ref="idTable" :data="items" :columns="columns" :options="options">
            <div v-show="enableCreateBtn" class="text-right" slot="beforeTable">
                <button @click="newItem" class="btn btn-primary btn-sm mb-2"><i class="fa fa-plus"></i> {{this.$t('buttons.new')}}</button>
            </div>
            <div slot="amountCurrency" slot-scope="{row}" class="text-center">
                <span class="badge m-auto amount-badge" :class="row.type=='income'?'badge-success':'badge-danger'">{{row.amountCurrency}}</span>
            </div>
            <div slot="options" slot-scope="{row}">
                <button @click="editUser(row)" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></button>
                <button @click="deleteUser(row)" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>
                <button v-if="btnConfig" @click="config(row)" class="btn btn-xs btn-primary"><i class="fa fa-cog"></i></button>
            </div>
            <template v-for="(item) in customFields">
                <div :slot="item.field">{{item.content}}</div>
            </template>
        </v-client-table>
    </div>
</template>
<script>

export default {
    name: 'InnoCoreDatatable',
    props: {
        btnConfig:{default:false},
        columnsData: {required: true},
        idTable: {required: true},
        rowItems: {required: true},
        customFields:{ default: null,required: false},
        enableCreateBtn: {default: true}
    },
    created() {
        this.setColumns()
        this.items = [...this.rowItems]
        // this.getData()
    },
    watch: {
        rowItems: function (newItems) {
            this.items = [...newItems]
        }
    },
    data() {
        return {
            items: [],
            columns: [],

            options: {
                resizableColumns: true,
                 perPage: 50,
                // perPageValues: [5, 10, 50, 100],
                pagination: {chunk: 5},
                datepickerOptions: {
                    showDropdowns: true,
                    autoUpdateInput: true,
                },
                sortIcon: {
                    base: 'fa float-right',
                    is: 'fa-sort',
                    up: 'fa-sort-up',
                    down: 'fa-sort-down'
                },
                texts: {
                    count: `${this.$t("Showing {from} to {to} of {count} records|{count} records|One record")}`,
                    first: `${this.$t("First")}`,
                    last: `${this.$t("Last")}`,
                    filter: `${this.$t("Filter")}:`,
                    filterPlaceholder: `${this.$t("Search query")}`,
                    limit: `${this.$t("Records")}:`,
                    page: `${this.$t("Page")}:`,
                    noResults: `${this.$t("No matching records")}`,
                    filterBy: `${this.$t("Filter by {column}")}`,
                    loading: `${this.$t("Loading")}...`,
                    defaultOption: `${this.$t("Select {column}")}`,
                    columns: `${this.$t("Columns")}`,
                },
                columnsDisplay:{}
                // columnsDropdown: true,
                // columnsDisplay: {
                //     email: 'min_tabletP',
                //     id: 'min_tabletP'
                // },
                // selectable:{
                //     mode: 'multiple', // or 'multiple'
                //     only: function(row) {
                //         return true // any condition
                //     },
                //     selectAllMode: 'all', // or 'page',
                //     programmatic: false
                // }
            }
        }
    },
    methods: {
        setColumns() {
            const headings = {}
            this.columnsData.map(item => {
                this.columns.push(item.field)
                headings[item.field] = item.label
                if(item.display){
                    this.options.columnsDisplay[item.field]= item.display
                }
            })
            this.options.headings = headings

        },
        getData() {
            this.$refs.usersTable.setLoadingState(true)
            axios.get('/api-admin/admin/users').then(response => {
                const rows = response.data.data

                this.items = rows
                this.$refs.usersTable.setLoadingState(false)
            })
        },

        editUser(item) {
            this.$emit('edit', item)
        },
        deleteUser(item) {
            this.$emit('delete', item)
        },
        newItem(){
            this.$emit('new')
        },
        config(item){
            this.$emit('config',item)
        }
    }

}
</script>
<style lang="scss">
.VueTables {
    label {
        margin-right: 10px;
    }
}

.VueTables__wrapper {
    max-height: 500px;
    overflow-y: scroll;
}

.VueTables__search-field {
    display: none;
}

.VueTables__limit-field {
    display: none;
}

.VueTables__columns-dropdown-wrapper {
    margin-right: 10px;
}
.VueTables__table{
    thead{
        th{
            padding: 15px 5px;
            text-align:center;
        }
    }
}
.VueTables__row {

    td {
        padding: 15px 5px;
        vertical-align: middle;
        text-align:center;

    }
}

.VueTables__columns-dropdown {
    input {
        margin-right: 3px;
    }
}
.amount-badge{
    font-size:1.2rem;
}
</style>
