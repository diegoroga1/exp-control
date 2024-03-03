const locale = {
	listen: () => {
		$(document).on('click', '.locale-item', locale.setLocale)
	},
	setLocale: (ev) => {
		const locale = $(ev.target).data('value')
		const input = $('#localeInput')
		input.val(locale)
		const form = $('#formLocale')
		form.submit()
	},

	getMessages: () => {
		const ca = require('../../resources/lang/ca.json')
		const es = require('../../resources/lang/es.json')
		const en = require('../../resources/lang/en.json')
		const messages = {ca, es, en}
		return messages
	},
}

export default locale
