<template>
<div id="app">
<navbar></navbar>

  <router-view></router-view>
<LOADER></LOADER>
</div>
</template>

<script>


  import Navbar from './components/Navbar.vue'
  import Home from './components/Home.vue'
  import Loader from './components/loader.vue'
  import Store from './store.js'
  


  export default {
    components:{
      'navbar':Navbar,
      'home':Home,
      'LOADER':Loader,

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
      }, function (error) {
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
      }, function (error) {
        // Do something with response error
        return new Promise((resolve,reject)=>{
          this.$store.dispatch('logout').then(()=>{
            this.$router.push('/loginPage')
          })
        })
        return Promise.reject(error);
      });




  }

    }
  


</script>

<style>

</style>
