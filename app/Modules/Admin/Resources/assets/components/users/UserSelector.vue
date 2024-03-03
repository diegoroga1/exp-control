<template>
    <div>
        <card-template>
            <template slot="titleCard">{{ this.$trans.users.users_assigned }}</template>
            <label>{{this.$trans.users.user_selector}}</label>
            <v-select @option:selected="add" @option:deselected="add" v-model="selected" :multiple="multiple" :options="items" label="name" code="id"></v-select>
        </card-template>
    </div>
</template>
<script>
import vSelect from 'vue-select'
import "vue-select/dist/vue-select.css"

export default {
    name: "UserSelector",
    props: {
        'current': {type: Array},
        'multiple': {default: false}
    },
    components: {
        vSelect
    },
    created() {
        this.setData()
        this.selected = this.current ? [...this.current] : []
    },
    watch: {
        current: function () {
            this.selected = [...this.current]
        }
    },
    data() {
        return {
            selected: [],
            items: []
        }
    },
    methods: {
        setData() {
            axios.get('/api-admin/admin/users').then(response => {
                this.items = response.data
            })
        },
        add() {
            this.$emit('add', [...this.selected])
        }
    }
}
</script>
