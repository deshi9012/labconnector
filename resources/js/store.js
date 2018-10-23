import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

export const store = new Vuex.Store({
	state: {
		user: {}
		// contractor: {
		// 	company_name: '',
		// 	person_name: '',
		// 	email: '',
		// 	phone: '',
		// 	address: '',
		// 	lat: '',
		// 	lng: '',
		// 	price_from: '',
		// 	price_to: '',
		// 	contractor_services: []
		//
		// }
	},
	getters: {
		// Modified data
		// contractorInfo: state => {
		// 	return state.contractor
		// }
		user: state => {
			return state.user
		},
	},
	mutations: {
		// Ways to modify the store
		// setUser: (state, value) => {
		// 	state.user = value
		// }
		//
		setUser: (state, value) => {
			state.user = value
		},
	},
	actions: {

		// createContractorAction(context) {
		// 	// context.commit('editContractor')
		//
		// 	return new Promise((resolve, reject) => {
		// 		axios({
		// 			method: 'post',
		// 			url: 'admin/contractors/create',
		// 			data: {
		// 				contractor: context.state.contractor
		// 			}
		// 		}).then(res => {
		// 			// may use if we deside against local storage storing
		//
		// 			// context.commit("setUserData", res.data);
		// 			// context.commit("setLoginData", credentials);
		//
		//
		// 			resolve();
		// 		})
		// 			.catch(err => {
		// 				console.log(err);
		// 			})
		// 	})
		// },
		//

	}
});