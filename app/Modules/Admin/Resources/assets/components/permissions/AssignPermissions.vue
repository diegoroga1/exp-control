<template>
    <card-template padding="p-0">
        <template slot="titleCard">{{this.$trans.permissions.assign_permissions}}</template>
        <div  id="AssignPermissions">
            <div  :key="group" v-for="(permissions,group) in permissions"  class="card">
                <a :href="`#group-${group}`" class="d-block card-header py-3" data-toggle="collapse"
                   role="button" aria-expanded="true" :aria-controls="`#group-${group}`">
                    <h6 class="m-0 font-weight-bold text-primary">{{group | upper}}</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div :class="`collapse ${show}`" collapsed="false" :id="`group-${group}`">
                    <ul class="list-group">
                        <li :key="i" v-for="(permission, i) in permissions" class="list-group-item">
                            <div class="row">
                                <div class="col-6 col-sm-4">{{permission.name}}</div>
                                <div class="d-none d-sm-inline-block col-sm-5">{{permission.description}}</div>
                                <div class="col-6 col-sm-3">
                                    <VueToggles :width="50" class="float-right" :value="permission.selected" @click="togglePermission(permission)"></VueToggles>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </card-template>

</template>
<script>
import VueToggles from 'vue-toggles/dist/vue-toggles.ssr';
import 'vue-toggles/dist/vue-toggles.ssr.css';
export default{
    name:'AssignPermissionComponent',
    created(){
        this.getData()
        this.show = this.expanded ? 'show' : null
    },
    props:{
        'current': {'required':true, type: Array, default:[]},
        'expanded': {default:false, type: Boolean}
    },
    watch:{
        current: function(){
            this.refreshSelecteds()
        }
    },
    components:{
      VueToggles
    },
    data(){
        return{
            permissions: [],
            show: null
        }
    },
    filters:{
        upper(value){
            return value.toUpperCase();
        }
    },
    computed:{

    },
    methods:{
        getData(){
            axios.get('/api-admin/admin/permissions/grouped').then(response =>{
                const groups = response
                this.permissions = groups
                this.refreshSelecteds();
            })
        },
        refreshSelecteds(){
            const keys = Object.keys(this.permissions)
            keys.map((group) => {
                this.permissions[group].map(permission => {
                    permission.selected = this.current.find(curr => curr.name === permission.name) ? true : false
                })
            })
        },

        togglePermission(permission){
            let currentSelected = this.current.map(object => ({name:object.name,id:object.id}))
            const enable = !permission.selected
            if(enable){
                currentSelected.push({name: permission.name, id: permission.id})
            }else{
                currentSelected = currentSelected.filter(item => item.id !== permission.id)
            }
            this.$emit('toggled',currentSelected)
        }
    }
}
</script>
<style lang="scss" scoped>
.card{
    border-radius: 0 !important;
    .card-header{
        border-radius: 0 !important;
    }

    ul{
        border-radius: 0 !important;
        li{
            &:hover{
                background-color: #f1f1f1
            }
        }
    }

}
</style>
