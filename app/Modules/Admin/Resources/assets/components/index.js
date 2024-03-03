Vue.component('users-list', require('./users/UsersList.vue').default)
Vue.component('user-form', require('./users/UserForm.vue').default)

Vue.component('roles-list', require('./roles/RolesList.vue').default)
Vue.component('roles-details', require('./roles/RoleItem.vue').default)

Vue.component(
	'permissions-list',
	require('./permissions/PermissionsList.vue').default
)
Vue.component(
	'permission-details',
	require('./permissions/PermissionItem.vue').default
)
