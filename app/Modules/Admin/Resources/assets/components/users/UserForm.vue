<template>
    <div class="card shadow mb-4">
        <div class="card-body">
            <h6 v-if="user !== undefined" class="text-right">
                <i>#{{ user.id }}</i>
            </h6>
            <div class="row">
                <div class="col-xs-12 col-sm-6 mb-2">
                    <div class="col-12 mb-2">
                        <label class="required">{{ this.$trans.users.name }}</label>
                        <input v-model="formData.name" type="text" class="form-control">
                    </div>
                    <div class="col-12 mb-2">
                        <label class="required">{{ this.$trans.users.email }}</label>
                        <input v-model="formData.email" type="email" class="form-control">
                    </div>

										
                </div>

                <div class="col-xs-12 col-sm-6 mb-2">
                    <div class="col-12 mb-2">
                        <label class="required">{{ this.$trans.users.password }}</label>
                        <input v-model="formData.password" type="password" class="form-control">
                    </div>
                    <div class="col-12 mb-2">
                        <label class="required">{{ this.$trans.users.repeat_password }}</label>
                        <input v-model="formData.password_confirmation" type="password" class="form-control">
                    </div>
                </div>
            </div>

            <hr/>
            <div class="row">
                <div class="col-sm-6" v-if="this.$helpers.hasPermission('admin.perms.list')">
                    <assign-permissions :expanded="false" :current="formData.permissions" @toggled="togglePermission"></assign-permissions>
                </div>
                <div class="col-sm-6" v-if="this.$helpers.hasPermission('admin.roles.list')">
                    <assign-roles :current="formData.roles" @toggled="toggleRole"></assign-roles>
                </div>
            </div>

        </div>
        <div class="card-footer">
            <button @click="save" class="btn btn-primary">{{ this.$t('buttons.save') }}</button>
        </div>
    </div>
</template>
<script>
import AssignPermissions from '../permissions/AssignPermissions'
import AssignRoles from '../roles/AssignRoles'
export default {
    name: 'UserForm',
    props: {
        user: {required: false}
    },
    components: {
        AssignPermissions,
        AssignRoles,
    },
    created() {
        if (this.user) this.setUser()
    },
		computed:{
				isAdmin: function(){
						return this.user && this.user.is_admin
				}
		},
    data() {
        return {
            formData: {
                id: null,
                name: null,
                email: null,
                password: null,
                password_confirmation: null,
                permissions: [],
                roles: [],
            }
        }
    },
    methods: {
        setUser() {
            this.formData.id = this.user.id
            this.formData.name = this.user.name
            this.formData.email = this.user.email
            this.formData.permissions = this.user.permissions
            this.formData.roles = this.user.roles
        },
        save() {
            const parameters = this.formData
            axios.post('/api-admin/admin/users', parameters).then(response => {
                this.$toast.success(this.$t('toast.create_success'))
                if (!this.user)
                    setTimeout(() => {
                        window.location = `/admin/users/${response.data.id}`
                    }, 1000)


            })
        },
        togglePermission(currentSelected) {
            this.formData.permissions = currentSelected
        },
        toggleRole(currentSelected) {
            this.formData.roles = currentSelected
        },


    }
}
</script>
