import Vuex from 'vuex';
import createPersistedState from 'vuex-persistedstate'


Vue.use(Vuex)


export default new Vuex.Store({
	modules:{
		// zones: ZoneStore,
	},
	plugins: [
		createPersistedState({
			storage: window.sessionStorage,
		}),
	],
})
