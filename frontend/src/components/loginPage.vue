<template>
  <div>
    
      <v-container>
        <alert v-if="alert" v-bind:message="alert" />
        <notification v-if="notify" :message="notify" :type="status"></notification>
        <v-snackbar v-if="snack" v-model="snackActive" bottom center multi-line :timeout="0">
          {{ snack }}
          <v-btn flat color="red" @click="resendEmail">Resend</v-btn>
          <v-btn flat color="red" @click="snackActive=!snackActive">Close</v-btn>
        </v-snackbar>
      </v-container>

      <v-container grid-list-md text-lg-center>
        <v-layout justify-center>
          <v-flex lg9 md9 sm12 xs12>
            <v-card class="card-5">
              <v-card-title class="justify-center">
                <h3 color="primary">Sign In</h3>
              </v-card-title>
              <v-divider class="mx-5 justify-center v-divider-1"></v-divider>
              <v-layout row wrap align-center justify-center>
                <v-flex>
                  <v-card-text>
                    <v-form @submit.prevent="loginUser">
                      <v-text-field
                        label="Email"
                        name="Email"
                        prepend-icon="email"
                        type="email"
                        v-validate="'email|required'"
                        v-model="login.email"
                        :error-messages="errors.collect('Email')"
                      ></v-text-field>

                      <v-text-field
                        id="password"
                        label="Password"
                        name="password"
                        prepend-icon="lock"
                        type="password"
                        v-validate="'required|min:6'"
                        v-model="login.password"
                        :error-messages="errors.collect('password')"
                      ></v-text-field>
                    </v-form>
                  </v-card-text>
                  <v-card-actions class="justify-center">
                    <v-btn block color="#FFAB00" @click="loginUser">Login</v-btn>
                  </v-card-actions>
                    <v-btn to="request-password-reset" flat left>Forget Password?</v-btn>

                </v-flex>
                <v-divider class="mx-3 align-center hidden-sm-and-down" vertical></v-divider>

                <v-flex lg6 md6 sm12 xs12>
                  <v-divider class="mx-3 align-center hidden-md-and-up">
                  </v-divider>
                  <div class="my-signin2" id="my-signin2"></div>

                  <v-card-title class="justify-center">
                    <h4>or</h4>
                  </v-card-title>

                  <v-btn block dark color="red" to="registerPage">Create an account</v-btn>
                  <v-btn block dark color="green" to="home">Continue as guest</v-btn>
                </v-flex>
              </v-layout>
            </v-card>
          </v-flex>
        </v-layout>
      </v-container>
    
  </div>
</template>

<script>
import alert from "./alert.vue";
import axios from "axios";
import Store from "../store.js";
import notification from "./notification.vue";
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
      status: ""
    };
  },
  components: {
    alert,
    notification
  },
  created() {
    if (this.$route.query.alert) {
      this.alert = this.$route.query.alert;
    }
    if (this.$route.query.snack) {
      (this.snackActive = true), (this.snack = this.$route.query.snack);
    }
    if (this.$route.query.status) {
      this.status = this.$route.query.status;
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
      this.notify = "";
      this.$validator.validateAll().then(result => {
        if (!result) {
          return;
        }

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
            this.notify = error.response.data.message;
            this.status = 0;
            console.log(error.response);
            console.log("ERROR");
          });
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
        width: 200,
        height: 40,
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

.my-signin2 {
  width: 100%;
}

.my-signin2 > div {
  margin: 0 auto;
}

.g-signin2 {
  width: 100%;
}

.g-signin2 > div {
  margin: 0 auto;
}

.v-divider-1 {
  display: block !important;
  flex: 1 1 0px !important;
  max-width: 100% !important;
  border: solid !important;
  border-width: thin 0 0 0 !important;
}

</style>
