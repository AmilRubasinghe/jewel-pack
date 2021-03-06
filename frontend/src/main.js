import Vue from 'vue'
import App from './App.vue'
import Router from './routes.js'
import BootstrapVue from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import VeeValidate from 'vee-validate'
import store from './store';

import axios from 'axios'
Vue.use(axios);


//import VueResource from 'vue-resource';
//Vue.use(VueResource);

import Vuetify from 'vuetify'
// index.js or main.js
import 'vuetify/dist/vuetify.min.css' // Ensure you are using css-loader
Vue.use(Vuetify)
Vue.prototype.$vuetify.theme = {
  primary: '#CD853F',
  secondary: '#FFAB00',
  accent: '#8c9eff',
  error: '#E65100'
};

import Snotify from 'vue-snotify/vue-snotify.min.js'
Vue.use(Snotify)

Vue.use(VeeValidate);
Vue.use(BootstrapVue);

import ProductZoomer from 'vue-product-zoomer';
Vue.use(ProductZoomer);


import { VueSpinners } from '@saeris/vue-spinners'
Vue.use(VueSpinners)


import VuejsDialog from 'vuejs-dialog';
import VuejsDialogMixin from 'vuejs-dialog/dist/vuejs-dialog-mixin.min.js'; // only needed in custom components

// include the default style
import 'vuejs-dialog/dist/vuejs-dialog.min.css';

// Tell Vue to install the plugin.
Vue.use(VuejsDialog);



Vue.prototype.$baseUrl = 'http://localhost:8000/api';
Vue.prototype.$url = 'http://localhost:8000/';





new Vue({
  el: '#app',
  store,
  axios,
  render: h => h(App),
  router:Router
})




