window.Vue = require('vue');
import VueRouter from 'vue-router'

window.Vue.use(VueRouter)

import Example from './components/ExampleComponent'
import Channel from './components/channels/ChannelComponent'
import User from './components/users/UserComponent'

var routes = [
	{path: '/admin/test', component: Example, name: 'Example'},
	{path: '/channels/:id', component: Channel, name:'Chanel', props: true},
	{path: '/users/:id', component: User, name:'User', props: true}
	];

const router = new VueRouter({
	routes: routes
});

export {router}