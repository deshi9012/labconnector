window.Vue = require('vue');
import VueRouter from 'vue-router'

window.Vue.use(VueRouter)

import Example from './components/ExampleComponent'
import Channel from './components/channels/ChannelComponent'

var routes = [
	{path: '/admin/test', component: Example, name: 'Example'},
	{path: '/channel/:id', component: Channel, name:'Chanel', props: true}
	];

const router = new VueRouter({
	routes: routes
});

export {router}