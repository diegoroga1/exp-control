<template>
    <card-template padding="p-0">
        <template slot="titleCard">{{ this.$trans.roles.assign_roles }}</template>
        <ul class="list-group">
            <li :key="i" v-for="(role,i) in roles" class="list-group-item">
                <div class="row">
                    <div class="col-6 col-sm-4">{{ role.name }}</div>
                    <div class="d-none d-sm-inline-block col-sm-5">{{ role.description }}</div>
                    <div class="col-6 col-sm-3">
                        <VueToggles :width="50" class="float-right" :value="role.selected" @click="toggleRole(role)"></VueToggles>
                    </div>
                </div>
            </li>
        </ul>
    </card-template>

</template>
<script>
import VueToggles from 'vue-toggles/dist/vue-toggles.ssr'
import 'vue-toggles/dist/vue-toggles.ssr.css'

export default {
    name: 'AssignRolesComponent',
    mounted() {
        this.getData()
    },
    props: {
        'current': {'required': true, type: Array, default: []},
    },
    watch: {
        current: function () {
           this.refreshSelecteds()
        }
    },
    components: {
        VueToggles
    },
    data() {
        return {
            roles: [],
        }
    },
    filters: {
        upper(value) {
            return value.toUpperCase()
        }
    },
    methods: {
        getData() {
            axios.get('/api-admin/admin/roles').then(response => {
                this.roles = response.data
                this.refreshSelecteds()
            })
        },
        refreshSelecteds() {
            this.roles.map((role) => {
                role.selected = this.current.find(curr => curr.name === role.name) ? true : false
            })
        },

        toggleRole(role) {
            let currentSelected = this.current.map(object => ({name: object.name, id: object.id}))
            const enable = !role.selected
            if (enable) {
                currentSelected.push({name: role.name, id: role.id})
            } else {
                currentSelected = currentSelected.filter(item => item.id !== role.id)
            }
            this.$emit('toggled', currentSelected)
        }
    }
}
</script>
