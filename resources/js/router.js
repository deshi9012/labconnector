window.Vue = require('vue');
import VueRouter from 'vue-router'

window.Vue.use(VueRouter)

import Example from './components/ExampleComponent'

var routes = [{path: '/admin/test', component: Example, name:'Example'}]

const router = new VueRouter({
	routes: routes
});

export { router }