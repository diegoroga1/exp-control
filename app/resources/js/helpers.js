import Swal from 'sweetalert2'
import 'js-loading-overlay'
import locale from './locale'

const messages = locale.getMessages()

const helpers = {
	t(key) {
		const sessionLocale = window.lang
		let translation = messages[sessionLocale]
		const keys = key.split('.')
		keys.map((k) => {
			translation = translation[k]
		})
		return translation
	},
	showLoading() {
		JsLoadingOverlay.show({spinnerIcon: 'ball-clip-rotate-multiple'})
	},
	hideLoading() {
		JsLoadingOverlay.hide()
	},
	showError(message) {
		Swal.fire({
			title: helpers.t('modals.error.title'),
			text: message,
			icon: 'error',
			showCancelButton: false,
			// confirmButtonColor: i18n.t('modals.error.title'),
			confirmButtonText: helpers.t('buttons.success'),
		})
	},

	showErrorValidation(errors) {
		let message = ''
		Object.keys(errors).map((key) => {
			message += `<p>${errors[key]}</p>`
		})
		Swal.fire({
			title: helpers.t('modals.error.title'),
			html: `<div class="col-xs-12 col-sm-8 offset-sm-2 text-left">${message}</div>`,
			icon: 'error',
			showCancelButton: false,
			// confirmButtonColor: i18n.t('modals.error.title'),
			confirmButtonText: helpers.t('buttons.success'),
		})
	},

	toastSuccess() {
		toast.success(helpers.t('toast.create_success'))
	},

	hasPermission(permission) {
		return window.userAdmin || window.userPermissions.includes(permission)
    },

	setUrlParameters(object) {
		const keys = Object.keys(object)
		let glue = ''
		let string = '?'
		keys.map(key => {
			string += `${glue}${key}=${object[key]}`
			glue = '&'
		})
		return string
	},

	// confirm(html, callback, parameters) {
	// 	Swal.fire({
	// 		title: translate('js_messages.confirm.delete.title'),
	// 		html,
	// 		icon: 'question',
	// 		showCancelButton: true,
	// 		confirmButtonColor: translate('js_messages.buttons.bg'),
	// 		cancelButtonColor: translate('js_messages.confirm.cancelBtnColor'),
	// 		confirmButtonText: translate('js_messages.confirm.confirmBtnText'),
	// 		cancelButtonText: translate('js_messages.confirm.cancelBtnText'),
	// 	}).then((result) => {
	// 		if (result.isConfirmed) {
	// 			callback(parameters)
	// 		}
	// 	})
	// },

	// confirmForm(form, callback, parameters) {
	// 	Swal.fire({
	// 		title: null,
	// 		html: form,
	// 		icon: null,
	// 		showCancelButton: true,
	// 		confirmButtonColor: translate('js_messages.buttons.bg'),
	// 		cancelButtonColor: translate('js_messages.confirm.cancelBtnColor'),
	// 		confirmButtonText: translate('js_messages.confirm.confirmBtnText'),
	// 		cancelButtonText: translate('js_messages.confirm.cancelBtnText'),
	// 	}).then((result) => {
	// 		if (result.isConfirmed) {
	// 			var form = helpers.parseFormToObject($('.modal-form'))
	// 			parameters = {
	// 				...parameters,
	// 				form,
	// 			}
	// 			callback(parameters)
	// 		}
	// 	})
	// },
	// confirmDelete(itemName, route, callback) {
	// 	Swal.fire({
	// 		title: translate('js_messages.confirm.delete.title'),
	// 		text: translate('js_messages.confirm.delete.text', {
	// 			item: itemName,
	// 		}),
	// 		icon: 'error',
	// 		showCancelButton: true,
	// 		confirmButtonColor: translate('js_messages.buttons.bg'),
	// 		cancelButtonColor: translate('js_messages.confirm.cancelBtnColor'),
	// 		confirmButtonText: translate('js_messages.confirm.confirmBtnText'),
	// 		cancelButtonText: translate('js_messages.confirm.cancelBtnText'),
	// 	}).then((result) => {
	// 		if (result.isConfirmed) {
	// 			callback(route)
	// 		}
	// 	})
	// },
	//
	// parseFormToObject(formItem) {
	// 	var array = formItem.serializeArray()
	// 	var form = {}
	// 	array.map((n, i) => {
	// 		form[n['name']] = n['value']
	// 	})
	// 	return form
	// },
}

window.helpers = helpers

export default helpers
