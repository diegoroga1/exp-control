<template>
    <div class="card shadow mb-4">
        <div class="card-body">
            <h6 v-if="user !== undefined" class="text-right">
                <i>#{{ user.id }} </i>
            </h6>
            <div class="row">
                <div class="col-xs-12 col-sm-6 mb-2">
                    <div class="col-12 mb-2">
                        <label class="required">{{ this.$t('Name') }}</label>
                        <input v-model="formData.name" type="text" class="form-control">
                    </div>
                    <div class="col-12 mb-2">
                        <label class="required">{{ this.$t('Email') }}</label>
                        <input v-model="formData.email" type="email" class="form-control">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-6 mb-2">
                    <div class="col-12 mb-2">
                        <label class="required">{{ this.$t('Password') }}</label>
                        <input v-model="formData.password" type="password" class="form-control">
                    </div>
                    <div class="col-12 mb-2">
                        <label class="required">{{ this.$t('Password Confirmation') }}</label>
                        <input v-model="formData.password_confirmation" type="password" class="form-control">
                    </div>

                </div>

            </div>
        </div>

        <div class="card-footer">
            <button @click="save" class="btn btn-primary">{{ this.$t('buttons.save') }}</button>
        </div>
    </div>
</template>
<script>
export default {
    name: 'ProfileForm',
    props: {
        user: {required: true}
    },
    created() {
        this.setUser()
    },
    data() {
        return {
            formData: {
                id: null,
                name: null,
                email: null,
                password: null,
                password_confirmation: null,
            }
        }
    },
    methods: {
        setUser() {
            this.formData.id = this.user.id
            this.formData.name = this.user.name
            this.formData.email = this.user.email
        },
        save() {
            const parameters = this.formData
            axios.post('/api-admin/profile', parameters).then(response => {
                this.$toast.success(this.$t('toast.create_success'))
            })
        }
    }
}
</script>
