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
      
      this.http.interceptors.push(function(request) {
console.log("interceptor req");
      this.$store.commit('LOADER',true);

}),

this.http.interceptors.push(function(response) {
console.log("interceptor res");
      this.$store.commit('LOADER',false);

});



    }
  }


</script>

<style>

</style>
