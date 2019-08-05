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



import responsive from 'vue-responsive'
Vue.use(responsive)

import Snotify from 'vue-snotify'; 
Vue.use(Snotify)



Vue.use(VeeValidate);
Vue.use(BootstrapVue);


Vue.prototype.$baseUrl = 'http://localhost:8000/api';

new Vue({
  el: '#app',
  store,
  axios,
  render: h => h(App),
  router:Router
})




