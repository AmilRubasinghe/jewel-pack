<template>
  <div id="inspire">
    
    <v-layout row justify-center>
      <v-dialog v-model="searchDialog" fullscreen transition="dialog-bottom-transition">
        <v-card class="search-dialog">
          <v-toolbar flat prominent height="80">
            <v-layout justify-right>
              <v-toolbar-title>
                <span class="font-weight-light">Jewel</span>
                <span>Pack</span>
              </v-toolbar-title>
            </v-layout>

            <v-spacer></v-spacer>
            <v-toolbar-items>
              <v-btn icon @click.native="searchDialog=!searchDialog" large>
                <v-icon>close</v-icon>
              </v-btn>
            </v-toolbar-items>
          </v-toolbar>

          <products pageTitle="Search Box" searchMode="true" class="search-dialog"></products>
        </v-card>
      </v-dialog>
    </v-layout>

    <v-toolbar app flat prominent height="80" scroll-off-screen>
      <v-toolbar-side-icon @click.stop="drawer = !drawer" v-if="role=='admin'"></v-toolbar-side-icon>
      <v-toolbar-title>
        <router-link to="/" tag="span" style="cursor: pointer">
         <span class="display-1">
                   <i class="far fa-gem" style="color:#212121;"></i>
                  </span>
          <span class="font-weight-light">Jewel</span>
          <span>Pack</span>
        </router-link>
      </v-toolbar-title>
      <v-divider class="mx-3" inset vertical></v-divider>

      <v-spacer></v-spacer>
      <v-toolbar-items class="hidden-md-and-down">
        <v-btn icon @click="searchDialog=true" large>
          <v-icon>search</v-icon>
        </v-btn>
        <v-btn flat v-for="item in menuItems" :key="item.title" :to="item.path">
          <v-icon left dark>{{ item.icon }}</v-icon>
          {{ item.title }}
        </v-btn>

        <v-btn flat to="/cartView">
          <v-badge right color="red">
            <template v-slot:badge>
              <span>{{cartCount}}</span>
            </template>
            <v-icon left dark color="black">shopping_cart</v-icon>
          </v-badge>Cart
        </v-btn>

        <v-menu offset-y open-on-hover>
          <template v-slot:activator="{ on }">
            <v-btn flat v-on="on">
              <v-icon left dark>{{ 'reorder' }}</v-icon>categories
              <v-icon left dark>{{ 'arrow_drop_down' }}</v-icon>
            </v-btn>
          </template>
          <v-list>
            <v-list-tile
              v-for="item in categoryItems"
              :key="item.CID"
              :to="({ path: `/category/${item.CID}` }) "
            >
              <v-icon left>{{ item.icon }}</v-icon>
              <v-list-tile-title>{{ item.CName }}</v-list-tile-title>
            </v-list-tile>
          </v-list>
        </v-menu>

        <v-btn v-if="!user" flat v-for="item in userItems" :key="item.title" :to="item.path">
          <v-icon left dark>{{ item.icon }}</v-icon>
          {{ item.title }}
        </v-btn>
        <v-btn v-if="user" flat v-for="item in regItems" :key="item.title" :to="item.path">
          <v-icon left dark>{{ item.icon }}</v-icon>
          {{ item.title }}
        </v-btn>
        <v-btn
          v-if="role=='admin'"
          flat
          v-for="item in adminItems"
          :key="item.title"
          :to="item.path"
        >
          <v-icon left dark>{{ item.icon }}</v-icon>
          {{ item.title }}
        </v-btn>
        <v-btn
          v-if="role=='editor'"
          flat
          v-for="item in editorItems"
          :key="item.title"
          :to="item.path"
        >
          <v-icon left dark>{{ item.icon }}</v-icon>
          {{ item.title }}
        </v-btn>
        <v-btn v-if="user" flat @click="logout">
          <v-icon left dark>{{ 'exit_to_app' }}</v-icon>Logout
        </v-btn>
      </v-toolbar-items>
      <v-menu class="hidden-lg-and-up">
        <v-toolbar-side-icon slot="activator" >
           <v-icon dark @click="mobileDrawer = true">{{ 'more_vert' }}</v-icon>
        </v-toolbar-side-icon>

        <v-dialog
          v-model="mobileDrawer"
          fullscreen
          hide-overlay
          transition="dialog-bottom-transition"
        >
          <!-- <v-toolbar-side-icon slot="activator"></v-toolbar-side-icon>-->
          <v-card>
            <v-toolbar flat prominent height="80" scroll-off-screen>
              <v-toolbar-title>
                <router-link to="/" tag="span" style="cursor: pointer">
                  <img src="https://bulma.io/images/bulma-logo.png" width="112" height="28" />
                  <span class="font-weight-light">Jewel</span>
                  <span>Pack</span>
                </router-link>
              </v-toolbar-title>
              <v-spacer></v-spacer>
              <v-btn icon @click.native="mobileDrawer = !mobileDrawer">
                <v-icon>close</v-icon>
              </v-btn>
            </v-toolbar>

            <v-list>
              <v-list-tile>
                <v-flex xs12 sm6 md3>
                  <v-text-field label="Search" v-model.number="term"></v-text-field>
                </v-flex>

                <v-btn icon @click.native.stop="modalModel=true">
                  <v-icon>search</v-icon>
                </v-btn>
              </v-list-tile>

              <v-list-tile v-for="item in menuItems" :key="item.title" :to="item.path">
                >
                <v-list-tile-action>
                  <v-icon v-if="item.icon">{{item.icon}}</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                  <v-list-tile-title :title="item.title">{{ item.title }}</v-list-tile-title>
                </v-list-tile-content>
              </v-list-tile>

              <v-list-tile to="/cartView">
                >
                <v-list-tile-action>
                  <v-icon left dark color="black">shopping_cart</v-icon>
                </v-list-tile-action>

                <v-list-tile-content>
                  <v-list-tile-title>Cart</v-list-tile-title>
                </v-list-tile-content>
              </v-list-tile>

              <v-list-tile to="/gemBox">
                >
                <v-menu offset-y open-on-hover>
                  <template v-slot:activator="{ on }">
                    <v-btn flat v-on="on">
                      <v-icon left dark>{{ 'reorder' }}</v-icon>categories
                      <v-icon left dark>{{ 'arrow_drop_down' }}</v-icon>
                    </v-btn>
                  </template>
                  <v-list>
                    <v-list-tile
                      v-for="item in categoryItems"
                      :key="item.CID"
                      :to="cPath(item.CID)"
                    >
                      <v-icon left>{{ item.icon }}</v-icon>
                      <v-list-tile-title>{{ item.CName }}</v-list-tile-title>
                    </v-list-tile>
                  </v-list>
                </v-menu>
              </v-list-tile>

              <v-list-tile v-if="!user" v-for="item in userItems" :key="item.title" :to="item.path">
                >
                <v-list-tile-action>
                  <v-icon left dark>{{ item.icon }}</v-icon>
                </v-list-tile-action>

                <v-list-tile-content>
                  <v-list-tile-title>{{item.title}}</v-list-tile-title>
                </v-list-tile-content>
              </v-list-tile>

              <v-list-tile v-if="user" v-for="item in regItems" :key="item.title" :to="item.path">
                >
                <v-list-tile-action>
                  <v-icon left>{{ item.icon }}</v-icon>
                </v-list-tile-action>

                <v-list-tile-content>
                  <v-list-tile-title>{{item.title}}</v-list-tile-title>
                </v-list-tile-content>
              </v-list-tile>

              <v-list-tile
                v-if="role=='admin'"
                v-for="item in adminItems"
                :key="item.title"
                :to="item.path"
              >
                >
                <v-list-tile-action>
                  <v-icon left>{{ item.icon }}</v-icon>
                </v-list-tile-action>

                <v-list-tile-content>
                  <v-list-tile-title>{{item.title}}</v-list-tile-title>
                </v-list-tile-content>
              </v-list-tile>

              <v-list-tile
                v-if="role=='editor'"
                v-for="item in editorItems"
                :key="item.title"
                :to="item.path"
              >
                >
                <v-list-tile-action>
                  <v-icon left>{{ item.icon }}</v-icon>
                </v-list-tile-action>

                <v-list-tile-content>
                  <v-list-tile-title>{{item.title}}</v-list-tile-title>
                </v-list-tile-content>
              </v-list-tile>

              <v-list-tile v-if="user" @click="logout">
                >
                <v-list-tile-action>
                  <v-icon left>{{ 'exit_to_app' }}</v-icon>
                </v-list-tile-action>

                <v-list-tile-content>
                  <v-list-tile-title>Logout</v-list-tile-title>
                </v-list-tile-content>
              </v-list-tile>
            </v-list>
          </v-card>
        </v-dialog>
      </v-menu>
    </v-toolbar>

    

   

    <v-navigation-drawer
      v-if="role=='admin'"
      v-model="drawer"
      fixed
      app
      floating
      disable-route-watcher
      temporary
      class="drawer card-5"
      width=350

    >
      <v-list>
        <v-list-tile
          @click.stop="drawer = !drawer"
          v-for="item in menuItems"
          :key="item.title"
          :to="{path: item.path}"
        >
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
        <v-list-tile
          @click.stop="drawer = !drawer"
          v-for="item in adminDrawItems"
          :key="item.title"
          :to="{path: '/admin/' + item.path}"
        >
          <v-list-tile-action>
            <v-icon>{{ item.icon }}</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>{{ item.title }}</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
      </v-list>
    </v-navigation-drawer>
  </div>
</template>

<script>
//import HelloWorld from "./components/HelloWorld";
import { mapState } from "vuex";
import { mapGetters } from "vuex";
import axios from "axios";
import Store from "../store.js";
import products from "./products.vue";
import test from "./test";
import footers from "./footers.vue";

export default {
  name: "App",
  components: {
    products: products
  },

  data() {
    return {
      transitionName: "slide-left",
      delay: 1000,
      adminDrawItems: [
        { title: "Dashboard", icon: "dashboard", path: "" },
        { title: "Users", icon: "supervised_user_circle", path: "users" },
        { title: "Orders", icon: "library_books", path: "orders" },
        { title: "Products", icon: "business_center", path: "products" },
        { title: "Category", icon: "reorder", path: "category" },
        { title: "Reports", icon: "file_copy", path: "reports" },
        { title: "Slide Show", icon: "photo_library", path: "slideshow" },
        { title: "LotQuantity", icon: "add_to_photos", path: "lotQuantity" },
      ],
      appTitle: "JewelPack",
      searchDialog: false,
      drawer: false,

      mobileDrawer: false,
      token: "",

      term: "",
      results: [],
      
      filterKey: "",

      menuItems: [
        { title: "Home", path: "/home", icon: "home" }
        //{ title: 'Cart', path: '/cartView', icon: 'shopping_cart' },
        // { title: 'Sign Up', path: '/registerPage', icon: 'face'},
        //{ title: 'Sign In', path: '/loginPage', icon: 'lock_open' }
      ],
      userItems: [
        { title: "Sign Up", path: "/registerPage", icon: "face" },
        { title: "Sign In", path: "/loginPage", icon: "lock_open" }
      ],
      regItems: [
        { title: "Profile", path: "/profile", icon: "face" }
        // { title: 'Logout', path: '/logout', icon: 'exit_to_app'},
      ],
      adminItems: [
        { title: "Dashboard", path: "/admin", icon: "dashboard" }
        // { title: 'Logout', path: '/logout', icon: 'exit_to_app'},
      ],
      editorItems: [
        { title: "Dashboard", path: "/editor", icon: "dashboard" }
        // { title: 'Logout', path: '/logout', icon: 'exit_to_app'},
      ],

      categoryItems: []
    };
  },

  beforeRouteUpdate(to, from, next) {
    const toDepth = to.path.split("/").length;
    const fromDepth = from.path.split("/").length;
    this.transitionName = toDepth < fromDepth ? "slide-right" : "slide-left";
    next();
  },

  methods: {

    cPath($id) {
      var $path = "category/" + $id;
      return $path;
    },
    logout() {
      let $Token = localStorage.getItem("token");
      /* console.log(Token);*/

      // this.$http.post('http://localhost:8000/api/logout?token='+$Token)
      axios
        .post("http://localhost:8000/api/logout?token=" + $Token)
        .then(response => {
          localStorage.removeItem("token");
          let $Token = localStorage.getItem("token");
          if (!$Token) {
            this.$store.commit("setUser", null);
            this.$router.push("/loginPage");
          }
        })
        .catch(error => {
          console.log(error.response);
          console.log("ERROR");
        });
    },

    catItems() {
      axios
        .get("http://localhost:8000/api/category")
        .then(response => {
          this.categoryItems = response.data.catItems;
          this.$store.commit("setCategory", this.categoryItems);
          //console.log(this.categoryItems);
        })
        .catch(error => {
          console.log(error.response);
          console.log("ERROR");
        });
    }
  },

  computed: {
    /* ...mapState([
            'user',
            ]),*/

    ...mapGetters(["role", "user", "cartCount", "cart"])

    // Other properties
  },

  mounted() {
    this.catItems();
    

    
  },

  beforeRouteUpdate(to, from, next) {
    console.log("befRo");
    this.catItems();
  },

  
};
</script>
<style>
.v-badge__badge {
  right: -0.1px;
}

.card-5 {
  box-shadow: 0 19px 38px rgba(0, 0, 0, 0.3), 0 15px 12px rgba(0, 0, 0, 0.22);
}

.drawer {
  opacity: 0.7;
  filter: alpha(opacity=50); /* For IE8 and earlier */
}

.drawer:hover {
  opacity: 0.9;
  filter: alpha(opacity=100); /* For IE8 and earlier */
}

.search-dialog {
  opacity: 1;
  filter: alpha(opacity=100); /* For IE8 and earlier */
}
</style>

