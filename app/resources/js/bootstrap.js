window._ = require('lodash')
import helpers from './helpers'

try {
	require('bootstrap')
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */
const axios = require('axios')
axios.interceptors.request.use((config) => {
	if (config.hideLoader === undefined || config.hideLoader === false) {
		helpers.showLoading()
	}
	return config
})
axios.interceptors.response.use(
	(response) => {
		helpers.hideLoading()
		return response.data
	},
	(error) => {
		helpers.hideLoading()
		if (error.response.data.errors &&  Object.keys(error.response.data.errors).length > 0) {
			helpers.showErrorValidation(error.response.data.errors)
		} else {
			helpers.showError(error.response.data.message)
		}

		return Promise.reject(error)
	}
)

window.axios = axios

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });
