<template>
  
  <v-app>
    <v-toolbar app prominent>
      
<v-toolbar-side-icon>        </v-toolbar-side-icon>
      <v-toolbar-title>
        <router-link to="/" tag="span" style="cursor: pointer">
          {{ appTitle }}
        </router-link>
      </v-toolbar-title>
      <v-spacer></v-spacer>
      <v-toolbar-items class="hidden-xs-only">
        <v-btn
          flat
          
          v-for="item in menuItems"
          
          :key="item.title"
          :to="item.path">
          <v-icon left dark>{{ item.icon }}</v-icon>
          {{ item.title }}
        </v-btn>
      </v-toolbar-items>
    </v-toolbar>
    
    <v-content>
      <router-view></router-view>
    </v-content>
    
  </v-app>

</template>

<script>
//import HelloWorld from "./components/HelloWorld";

export default {
  name: "App",
  data(){
    return {
      appTitle: 'JewelPack',
      sidebar: false,
      token:'',
      menuItems: [
          { title: 'Home', path: '/home', icon: 'home' },
          { title: 'Sign Up', path: '/registerPage', icon: 'face'},
          { title: 'Sign In', path: '/loginPage', icon: 'lock_open' }
     ]
    }
  },
  created(){
      this.token=localStorage.getItem.token;
      console.log(this.token);
  }
};
</script>

<style>
.IS_ACTIVATED{

    background-color: white;
    cursor: pointer;
}
</style>
