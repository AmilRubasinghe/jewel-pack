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


import VueResource from 'vue-resource';
Vue.use(VueResource);

import Vuetify from 'vuetify'
// index.js or main.js
import 'vuetify/dist/vuetify.min.css' // Ensure you are using css-loader
Vue.use(Vuetify)



Vue.use(VeeValidate);
Vue.use(BootstrapVue);

new Vue({
  el: '#app',
  store,
  render: h => h(App),
  router:Router
})




