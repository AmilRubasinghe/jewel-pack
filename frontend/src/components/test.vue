<template>
  <div>
    <div id="my-signin2"></div>

    <v-btn @click="route">Route</v-btn>
    <v-btn @click="signOut">Sign Out</v-btn>
  </div>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {};
  },

  created() {},
  mounted() {
    this.init();
    this.renderButton();
    
    
  },

  methods: {


    route() {
     console.log(this.$route.path);
    },
    init() {
      gapi.load("auth2", function() {
        /* Ready. Make a call to gapi.auth2.init or some other API */
      });
    },

    onSuccess(googleUser) {
      console.log(googleUser.getAuthResponse().id_token);
      console.log("Logged in as: " + googleUser.getBasicProfile().getName());

      let $token = googleUser.getAuthResponse().id_token;
      axios
        .post("http://localhost:8000/api/tokensignin", {
          token: $token
        })
        .then(response => {
          this.alert = response.data.message;

          this.snackActive = true;
          this.snack = response.data.snack;

          let $token = response.data.token;

          this.$store.dispatch("setUser", null);
          if ($token) {
            console.log($token);
            localStorage.setItem("token", $token);
            //console.log(response.data.role);

            this.$store.dispatch("setUser", response.data.user);
            // console.log("User");
            //  console.log(this.$store.state.user);
            // console.log(Store.getters.role);
            if (response.data.role == "admin") {
              this.$router.push("/admin");
            } else {
              this.$router.push("/profile");
            }
          }
        })
        .catch(error => {
          console.log(error.response);
          console.log("ERROR");
        });
    },
    onFailure(error) {
      console.log(error);
    },

    init() {
      gapi.load("auth2", function() {
        /* Ready. Make a call to gapi.auth2.init or some other API */
      });
    },

    renderButton() {
      gapi.signin2.render("my-signin2", {
        scope: "profile email",
        width: 240,
        height: 50,
        longtitle: true,
        theme: "dark",
        onsuccess: this.onSuccess,
        onfailure: this.onFailure
      });
    },

    

  
    signOut() {
      var auth2 = gapi.auth2.getAuthInstance();
      auth2.signOut().then(function() {
        console.log("User signed out.");
      });
    }
  }
};
</script>
