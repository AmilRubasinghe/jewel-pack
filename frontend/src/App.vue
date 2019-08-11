<template>
  <div id="app">
    <v-app>
      <navbar></navbar>
      <v-content>
        <transition :name="transitionName" mode="out-in">
          <router-view></router-view>
        </transition>
      </v-content>

      <footers></footers>

      <LOADER></LOADER>
    </v-app>
  </div>
</template>

<script>
//:key="$route.fullPath"
import axios from "axios";
import Navbar from "./components/Navbar.vue";
import Home from "./components/home.vue";
import Loader from "./components/loader";
import adminPanel from "./components/admin/adminPanel";
import manageProducts from "./components/admin/manageProducts";
import manageUsers from "./components/admin/manageUsers";
import footers from "./components/footers.vue";
//import alert from './components/alert.vue'
import Store from "./store.js";

export default {
  components: {
    navbar: Navbar,
    home: Home,
    LOADER: Loader,
    adminPanel: adminPanel,
    manageProducts: manageProducts,
    manageUsers: manageUsers,

    footers: footers

    //  'alert':alert
  },
  data() {
    return {
      loader: true,
      transitionName: "slide-left"
    };
  },

  watch: {
    $route(to, from) {
      const toDepth = to.path.split("/").length;
      const fromDepth = from.path.split("/").length;
      this.transitionName = toDepth < fromDepth ? "slide-right" : "slide-left";
    }
  },

  created() {
    axios.interceptors.request.use(
      config => {
        // Do something before request is sent
        this.$store.commit("LOADER", true);
        return config;
      },
      error => {
        // Do something with request error
        this.$store.commit("LOADER", false);
        return Promise.reject(error);
      }
    );

    // Add a response interceptor
    axios.interceptors.response.use(
      response => {
        // Do something with response data

        this.$store.commit("LOADER", false);
        if (response.data.exp) {
          console.log("Token Expired");
          localStorage.removeItem("token");
          Store.commit("setUser", null);
          Store.state.user = null;
          this.$router.push("/loginPage");
        }
        return response;
      },
      error => {
        // Do something with response error
        return new Promise((resolve, reject) => {
          this.$store.commit("LOADER", false);

          /*  this.$store.dispatch('logout').then(()=>{
            //this.$store.commit('LOADER',false);
            this.$router.push('/logout')
          })*/
          throw error;
        });
      }
    );
  }
};
</script>

<style>


.slide-right-leave-active {
  transition: transform 0.2s, opacity 1s;
}

.slide-left-leave-active {
  transition: transform 0.2s, opacity 1s;
}
.slide-right-leave-active {
  position: absolute;
}

.slide-left-enter,
.slide-right-leave-to {
  opacity: 0;
  transform: translate3d(100%, 0, 0);
}

.slide-right-enter,
.slide-left-leave-to {
  opacity: 0;
  transform: translate3d(-100%, 0, 0);
}

@import "~vue-snotify/styles/material.css";
@import url("https://fonts.googleapis.com/css?family=Dancing+Script:400,700&display=swap");
@import url("https://fonts.googleapis.com/css?family=Fredericka+the+Great&display=swap");
@import url("https://fonts.googleapis.com/css?family=Rye&display=swap");
@import url("https://fonts.googleapis.com/css?family=Eagle+Lake&display=swap");
</style>
