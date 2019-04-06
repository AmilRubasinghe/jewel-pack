<template>
  
  <v-app>
     
    <v-toolbar app prominent>
      

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
        <v-btn
            v-if="!user"
            flat
            v-for="item in userItems"
            :key="item.title"
            :to="item.path">
            <v-icon left dark>{{ item.icon }}</v-icon>
            {{ item.title }}
        </v-btn>
        <v-btn
            v-if="user"
            flat
            v-for="item in regItems"
            :key="item.title"
            :to="item.path">
            <v-icon left dark>{{ item.icon }}</v-icon>
            {{ item.title }}
        </v-btn>
        <v-btn
        
            v-if="role=='admin'"
          flat
          v-for="item in adminItems"
          :key="item.title"
          :to="item.path">
          <v-icon left dark>{{ item.icon  }}</v-icon>
          {{  item.title }}
        </v-btn>
        <v-btn
        
            v-if="role=='editor'"
          flat
          v-for="item in editorItems"
          :key="item.title"
          :to="item.path">
          <v-icon left dark>{{ item.icon  }}</v-icon>
          {{  item.title }}
        </v-btn>
        <v-btn
            v-if="user"
          flat
          @click="logout">
          <v-icon left dark>{{ 'exit_to_app' }}</v-icon>
          {{ 'Logout' }}
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
import { mapState } from 'vuex'
import { mapGetters } from 'vuex'
import axios from 'axios'
import Store from '../store.js'
export default {
  name: "App",

  
  data(){
    return {
      appTitle: 'JewelPack',
      sidebar: false,
      token:'',
      
      
      menuItems: [
          { title: 'Home', path: '/home', icon: 'home' },
          { title: 'Cart', path: '/cart', icon: 'shopping_cart' },
         // { title: 'Sign Up', path: '/registerPage', icon: 'face'},
     //{ title: 'Sign In', path: '/loginPage', icon: 'lock_open' }
     ],
     userItems: [
          { title: 'Sign Up', path: '/registerPage', icon: 'face'},
          { title: 'Sign In', path: '/loginPage', icon: 'lock_open' },
     ],
     regItems: [
          { title: 'Profile', path: '/profile', icon: 'face'},
           // { title: 'Logout', path: '/logout', icon: 'exit_to_app'},
     ],
     adminItems: [
          { title: 'Dashboard', path: '/admin', icon: 'dashboard'},
           // { title: 'Logout', path: '/logout', icon: 'exit_to_app'},
     ],
     editorItems: [
          { title: 'Dashboard', path: '/editor', icon: 'dashboard'},
           // { title: 'Logout', path: '/logout', icon: 'exit_to_app'},
     ],
     
    }
  },
    methods:{
    logout(){
            let $Token=localStorage.getItem('token');
           /* console.log(Token);*/
            
        // this.$http.post('http://localhost:8000/api/logout?token='+$Token)
         axios.post('http://localhost:8000/api/logout?token='+$Token)
            .then(response => {
                localStorage.removeItem('token');
                let $Token=localStorage.getItem('token');
                if(!$Token){
                     this.$store.commit("setUser",null);
                    this.$router.push('/loginPage');
                }
            })
            .catch(error => {
                console.log(error.response);
                console.log("ERROR");
                
            })
        }
    },

    
     computed: {
            ...mapState([
            'user',
            ]),

            ...mapGetters([
                'role',
            ])
    // Other properties
  },
 /* 
  beforeMount(){
      this.token=localStorage.getItem('token');
  },
  beforeUpdate(){
      this.token=localStorage.getItem('token');
  }*/
};
</script>

<style>
.IS_ACTIVATED{

    background-color: white;
    cursor: pointer;
}
</style>
