require('./bootstrap')
import locale from './locale'
import Alpine from 'alpinejs'

window.Vue = require('vue').default
const store = require('./store').default

//listen changes lang session
locale.listen()

require('./components/common_components')

window.Alpine = Alpine
Alpine.start()

require('./components')

//Load modules
function loadModuleComponentsFile(module) {
	require(`../../Modules/${module}/Resources/assets/js/app`)
}

loadModuleComponentsFile('Admin')


if ($('#app').length) {
	const app = new Vue({
		el: '#app',
		store
	})
}
