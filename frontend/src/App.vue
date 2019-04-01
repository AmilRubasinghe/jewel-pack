<template>
<div id="app">
<navbar></navbar>

  <router-view></router-view>
<LOADER></LOADER>
</div>
</template>

<script>

import axios from 'axios'
  import Navbar from './components/Navbar.vue'
  import Home from './components/Home.vue'
  import Loader from './components/loader'
  import adminPanel from './components/adminPanel'
  import Store from './store.js'
  


  export default {
    components:{
      'navbar':Navbar,
      'home':Home,
      'LOADER':Loader,
      'adminPanel':adminPanel

    },
    data(){
      return{
        loader:true
      }
    },

    created(){
      
    axios.interceptors.request.use( (config)=> { 
    // Do something before request is sent
    this.$store.commit('LOADER',true);
        return config;
      }, (error) => {
        // Do something with request error
        this.$store.commit('LOADER',false);
        return Promise.reject(error);
      });

    // Add a response interceptor
    axios.interceptors.response.use( (response)=> {
        // Do something with response data
        console.log(response);
        this.$store.commit('LOADER',false);
        return response;
      },  (error) => {
        // Do something with response error
        return new Promise((resolve,reject)=>{
           this.$store.commit('LOADER',false);
        /*  this.$store.dispatch('logout').then(()=>{
            //this.$store.commit('LOADER',false);
            this.$router.push('/logout')
          })*/
          throw error;
        });
      });




  }

    }
  


</script>

<style>

</style>
