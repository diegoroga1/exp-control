<template>
    <div class="modal fade" :id="id" tabindex="-1" role="dialog" aria-labelledby="NewPermissionModal"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ this.$trans.permissions.permissions }}</h5>
                    <button @click="hideModal" class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form @submit="saveData">
                    <div class="modal-body">
                        <label class="required">{{ this.$trans.permissions.permission_name }}</label>
                        <input type="text" v-model="item.name" class="form-control">
                    </div>
                    <div class="modal-body">
                        <label class="required">{{ this.$trans.permissions.group}}</label>
                        <v-select v-model="item.group"  :options="groups"></v-select>
                    </div>
                    <div class="modal-body">
                        <label class="required">{{ this.$trans.permissions.permission_description }}</label>
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
import vSelect from 'vue-select'
import "vue-select/dist/vue-select.css"
export default {
    name: "PermissionFormModal",
    props: ['id', 'current'],
    components:{
      vSelect
    },
    created(){
        this.getGroups()
    },
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
            groups:[]
        }
    },
    methods: {
        getGroups(){
          axios.get('/api-admin/admin/permissions/groups').then(response =>{
              this.groups = response
          })
        },
        hideModal() {
            $(`#${this.id}`).modal('hide')
        },
        resetData() {

        },
        saveData(e) {
            e.preventDefault()
            axios.post('/api-admin/admin/permissions', this.item).then(response => {
                this.hideModal()
                this.resetData()
                this.$helpers.toastSuccess()
                this.$emit('saved')
            })
        }
    }
}
</script>
