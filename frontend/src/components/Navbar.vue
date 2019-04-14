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
           <v-text-field
           placeholder="Search"
        hide-details
        single-line
      ></v-text-field>
      <v-btn icon  @click.native.stop="modalModel=true"><v-icon>search</v-icon></v-btn>
        <v-btn
          flat
          v-for="item in menuItems"
          :key="item.title"
          :to="item.path">
          <v-icon left dark>{{ item.icon }}</v-icon>
          {{ item.title }}
        </v-btn>


<v-menu offset-y>
      <template v-slot:activator="{ on }">
        <v-btn
          flat          
          v-on="on"
        >
         <v-icon left dark>{{ 'reorder' }}</v-icon>
          categories
        </v-btn>

      </template>
      <v-list>
        <v-list-tile
          v-for="item in categoryItems" :key="item.CID"
          :to="item.path"
        >
        <v-icon left>{{ item.icon }}</v-icon>
          <v-list-tile-title>{{ item.CName }}</v-list-tile-title>
        </v-list-tile>
      </v-list>
    </v-menu>



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
import footers from './footers.vue'
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

     categoryItems: [
         // { title: 'Gem Boxes', path: '/gemBox', icon: 'local_mall'},
         // { title: 'Jewellery Boxes', path: '/jewelleryBox', icon: 'local_mall'},
           // { title: 'Logout', path: '/logout', icon: 'exit_to_app'},
     ],
     
    }
  },

  components:{
    'footers':footers,
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
        },


        catItems(){
              axios.get('http://localhost:8000/api/category')
                  .then(response => {
                    
                    
                      this.categoryItems=response.data.catItems;

                      //console.log(this.categoryItems);
                      
                      
                  })
                  .catch(error => {
                      console.log(error.response);
                      console.log("ERROR");
                  })
          },
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
 
  mounted(){
      this.catItems();
      console.log("000000000000000000000000000000");
      for(item in this.categoryItems){
        console.log("-----------------------------------");
          console.log(item.CID);
      }
  },

  /*
  beforeUpdate(){
      this.token=localStorage.getItem('token');
  }*/
};
</script>
