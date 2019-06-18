<template>
  
  <v-app>

     
    <v-toolbar app prominent scroll-off-screen color="#FFFFFF"> 
      
<v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
      <v-toolbar-title>
        <router-link to="/" tag="span" style="cursor: pointer">
          {{ appTitle }}
        </router-link>
      </v-toolbar-title>
      <v-divider
      class="mx-3"
      inset
      vertical
    ></v-divider>
    


      
      <v-spacer></v-spacer>
      <v-toolbar-items class="hidden-xs-only">


        <v-flex xs12 sm6 md3>
          <v-text-field
            label="Search"
          ></v-text-field>
        </v-flex>
        
      <v-btn icon  @click.native.stop="modalModel=true"><v-icon>search</v-icon></v-btn>
        <v-btn
          flat
          v-for="item in menuItems"
          :key="item.title"
          :to="item.path">
          <v-badge v-if="item.title=='Cart'" v-model="show" left>
            <template v-slot:badge><span>{{item.badge}}</span></template></v-badge>
           
          <v-icon left dark>{{ item.icon }}</v-icon>
           
          {{ item.title }}
        </v-btn>

      
   

<v-btn
          flat
          to="/cart">
          
               <v-badge left color="red">
      <template v-slot:badge>
        <span>{{cartCount}}</span>
      </template>
      <v-icon left dark color="black">shopping_cart</v-icon>
    </v-badge>
        Cart
        </v-btn>

<v-menu offset-y  open-on-hover>
      <template v-slot:activator="{ on }">
        <v-btn
          flat
               
          v-on="on"
        >
         <v-icon left dark>{{ 'reorder' }}</v-icon>
          categories
          <v-icon left dark>{{ 'arrow_drop_down' }}</v-icon>
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

    
    <v-navigation-drawer 
      v-model="drawer"
      fixed
      app
      floating
      dark
      >
 
      <v-img 
      src="https://coloredbrain.com/wp-content/uploads/2016/07/login-background.jpg"  
      height="100%"
      >

      <v-list>
      <v-list-tile  @click.stop="drawer = !drawer" v-for="item in menuItems" :key="item.title" :to="{path: item.path}">
        <v-list-tile-action>
          <v-icon>{{ item.icon }}</v-icon>
        </v-list-tile-action>
        <v-list-tile-content>
          <v-list-tile-title>{{ item.title }}</v-list-tile-title>
        </v-list-tile-content>
      </v-list-tile>
      
    </v-list>

<v-divider></v-divider>
    <v-list v-if="role=='admin'">
      <v-list-tile  @click.stop="drawer = !drawer" v-for="item in adminDrawItems" :key="item.title" :to="{path: '/admin/' + item.path}">
        <v-list-tile-action>
          <v-icon>{{ item.icon }}</v-icon>
        </v-list-tile-action>
        <v-list-tile-content>
          <v-list-tile-title>{{ item.title }}</v-list-tile-title>
        </v-list-tile-content>
        
      </v-list-tile>
    </v-list>


      </v-img>

    
  </v-navigation-drawer>
    
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
       adminDrawItems: [
          { title: 'Dashboard', icon: 'dashboard' ,path:'' },
          { title: 'Users', icon: 'supervised_user_circle' ,path:'users' },
          { title: 'Orders', icon: 'library_books' , path:'orders'},
          { title: 'Products', icon: 'business_center' , path:'products'},
          { title: 'Category', icon: 'reorder' , path:'category'},
          { title: 'Reports', icon: 'file_copy' , path:'reports'},
          { title: 'Slide Show', icon: 'photo_library' , path:'slideshow'},
        ],
        /*userDrawItems: [
          { title: 'Dashboard', icon: 'dashboard' ,path:'' },
          { title: 'Users', icon: 'supervised_user_circle' ,path:'users' },
          { title: 'Orders', icon: 'library_books' , path:'orders'},
          { title: 'Products', icon: 'business_center' , path:'products'},
          { title: 'Category', icon: 'reorder' , path:'category'},
          { title: 'Reports', icon: 'file_copy' , path:'reports'},
          { title: 'Slide Show', icon: 'photo_library' , path:'slideshow'},
        ],*/
      appTitle: 'JewelPack',
      drawer: false,
      token:'',
      
      
      
      menuItems: [
          { title: 'Home', path: '/home', icon: 'home' },
<<<<<<< HEAD
          { title: 'Cart', path: '/cartView',badge:"0", icon: 'shopping_cart' },
         // { title: 'Sign Up', path: '/registerPage', icon: 'face'},
     //{ title: 'Sign In', path: '/loginPage', icon: 'lock_open' }
=======
        //  { title: 'Cart', path: '/cart', icon: 'shopping_cart' },
>>>>>>> a8d069eba4564d311729a865990611642e0422dc
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

     categoryItems: [],
     
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
           /* ...mapState([
            'user',
            ]),*/

            ...mapGetters([
                'role',
                'user',
                'cartCount',
                'cart'
            ])
    // Other properties
  },
 
  mounted(){
      this.catItems();
      console.log(Store.getters.user);
      console.log(Store.getters.role);
      console.log(localStorage.getItem('token'));
      
  }
};
</script>

