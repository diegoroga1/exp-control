const {ClientTable} = require('vue-tables-2-premium')
import CustomBaseDataTable from './CustomDatatable/CustomBaseDataTable.vue'
import vuei18n from '../Vuei18n'
import helpers from '../helpers'
import bus from '../event-bus'
import VueSweetalert2 from 'vue-sweetalert2'
import 'sweetalert2/dist/sweetalert2.min.css'
import Toastr from 'toastr2'
import 'toastr2/dist/toastr.min.css'

const toastr = new Toastr({
	closeButton: true,
	closeMethod: 'fadeOut',
	closeEasing: 'swing',
	preventDuplicates: true,
	progressBar: true,
})

window.toast = toastr

//Vue global variables in components
Vue.prototype.$t = (key, values) => vuei18n.t(key, values)
Vue.prototype.$helpers = helpers
Vue.prototype.$bus = bus
Vue.prototype.$toast = toastr

//Vue plugins
Vue.use(ClientTable, {}, false, 'bootstrap4', {
	dataTable: CustomBaseDataTable,
})
Vue.use(VueSweetalert2)

//Vue Global components
Vue.component('InnoCoreDatatable', require('./InnoCoreDatatable.vue').default)
Vue.component('ModalForm', require('./Modals/ModalForm.vue').default)
Vue.component('ModalConfirm', require('./Modals/ModalConfirm.vue').default)
Vue.component('ModalConfirmFn', require('./Modals/ModalConfirmFn.vue').default)
Vue.component(
	'ModalConfirmDelete',
	require('./Modals/ModalConfirmDelete.vue').default
)
Vue.component(
	'ModalConfirmDeleteFn',
	require('./Modals/ModalConfirmDeleteFn.vue').default
)
Vue.component('CardTemplate', require('./CardTemplate.vue').default)
