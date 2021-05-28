require('./bootstrap');
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

// Import Bootstrap an BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

window.Vue = require('vue');

// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)

import router from './router';
import App from './layouts/App.vue';


Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const app = new Vue({
    router,
    el: '#app',
    render: h => h(App)
});
