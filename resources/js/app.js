
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./bootstrap.js')

import {router} from './router.js'
import {store} from './store.js'

import Vue from 'vue'

import Vuetify from 'vuetify'

import Vue2Filters from 'vue2-filters'
// index.js or main.js
import 'vuetify/dist/vuetify.min.css' // Ensure you are using css-loader

Vue.use(Vuetify)
Vue.use(Vue2Filters)



window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Get logged user info
window.axios.get('getAuthUser').then(response => {
	store.commit('setUser', response.data)
}).catch((error) => {
	console.log(error)
})
import Root from './components/RootComponent.vue'

const app = new Vue({
	el: '#app',
	router,	//router:router
	store,


	components: {
		Root //mount general component
	}
});

//
// Vue.component('example-component', require('./components/ExampleComponent.vue'));
//
// const app = new Vue({
//     el: '#app'
// });
