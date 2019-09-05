<template>
  <v-app id="inspire">
    <v-content>
      <v-container grid-list-md text-xs-center>
        <v-layout row wrap align-center>
          <v-flex xs12 sm12 md6>
            <v-card class="card-5" height=400>
              <v-toolbar color='primary' dark flat>
                <v-toolbar-title>Login</v-toolbar-title>
              </v-toolbar>
              <v-card-text>
                <v-form @submit.prevent="loginUser">
                  <v-text-field
                    label="Email"
                    name="Email"
                    prepend-icon="email"
                    type="email"
                    v-validate="'required'"
                    v-model="login.email"
                  ></v-text-field>

                  <div
                    v-show="errors.has('email')"
                    class="help block alert alert-danger"
                  >{{ errors.first('email') }}</div>

                  <v-text-field
                    id="password"
                    label="Password"
                    name="password"
                    prepend-icon="lock"
                    type="password"
                    v-validate="'required'"
                    v-model="login.password"
                  ></v-text-field>

                  <div
                    v-show="errors.has('password')"
                    class="help block alert alert-danger"
                  >{{ errors.first('password') }}</div>
                </v-form>
              </v-card-text>
              
                
                <v-btn color="#FFAB00" @click="loginUser">Login</v-btn>
              
                    
                  <v-divider></v-divider>
                 <div class="my-signin2" id="my-signin2"></div>
              
            </v-card>
          </v-flex>
          <v-flex xs12 sm12 md6>

            
            
                  <v-card height="300" class="card-5">
                    <v-toolbar light flat >
                <v-toolbar-title>Already have an account</v-toolbar-title>
              </v-toolbar>
                    
                    <div class="my-signin2" id="my-signin2"></div>
                  </v-card>
                
            
          </v-flex>
        </v-layout>
      </v-container>
    </v-content>
  </v-app>
</template>

<script>
import alert from "./alert.vue";
import axios from "axios";
import Store from "../store.js";
export default {
  data() {
    return {
      login: {
        email: "",
        password: ""
      },

      user: {
        email: ""
      },

      alert: "",
      snack: "",
      snackActive: false,

      notify: "",
      status: 2
    };
  },
  components: {
    alert
  },
  created() {
    if (this.$route.query.alert) {
      this.alert = this.$route.query.alert;
    }
    if (this.$route.query.snack) {
      (this.snackActive = true), (this.snack = this.$route.query.snack);
    }
    if (this.$route.query.notify) {
      this.notify = this.$route.query.notify;
    }
  },

  mounted() {
    this.renderButton();
  },

  methods: {
    resendEmail() {
      this.user.email = Store.getters.vEmail;
      axios
        .post(this.$baseUrl + "/resendvEmail", this.user, {})
        .then(response => {
          if (response.data.alert) {
            this.alert = response.data.message;
          }
          if (response.data.snack) {
            (this.snackActive = true), (this.snack = response.data.snack);
          }
        })
        .catch(error => {
          console.log(error.response);
          console.log("ERROR");
        });
    },

    loginUser() {
      axios
        .post(this.$baseUrl + "/login", this.login, {})
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

    onSuccess(googleUser) {
      // console.log(googleUser.getAuthResponse().id_token);
      console.log("Logged in as: " + googleUser.getBasicProfile().getName());

      let $token = googleUser.getAuthResponse().id_token;
      axios
        .post(this.$baseUrl + "/tokensignin", {
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

    renderButton() {
      gapi.signin2.render("my-signin2", {
        scope: "profile email",
        width: 240,
        height: 50,
        longtitle: true,
        theme: "dark",
        onsuccess: this.onSuccess,
        onfailure: this.onFailure,
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


<style>
html,
body,
app-root {
  height: 100%;
  margin: 0;
}
.inventory-body {
  min-width: 100%;
  background-image: url("https://coloredbrain.com/wp-content/uploads/2016/07/login-background.jpg");
  background-repeat: no-repeat;
  background-size: 50%;
  background-position: center;
  background-size: cover;
}

.wrapper {
  height: 100%;
  width: 100%;
}

.card-5 {
  box-shadow: 0 19px 38px rgba(0, 0, 0, 0.3), 0 15px 12px rgba(0, 0, 0, 0.22);
}

.my-signin2{
  width: 100%;
}

.my-signin2 > div{
  margin: 0 auto;
}

.g-signin2{
  width: 100%;
}

.g-signin2 > div{
  margin: 0 auto;
}
</style>
