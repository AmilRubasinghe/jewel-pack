



<template>
  <v-app id="inspire">
    <v-content>
      <v-container fluid fill-height grid-list-md text-center>
        <notification v-if="notify"  :message="notify" :type="status"></notification>
        <v-layout wrap>
          <v-flex xs12 sm12 md6 lg6>
            <v-card class="elevation-14">
              <v-toolbar color="#CD853F" dark flat>
                <v-toolbar-title>Register</v-toolbar-title>
              </v-toolbar>
              <v-card-text>
                <v-form @submit.prevent="registerUser">
                  <v-text-field
                    label="First Name"
                    prepend-icon="person"
                    type="text"
                    v-validate="'required'"
                    v-model="register.firstname"
                    name="first_name"
                    data-vv-as="First Name"
                    :error-messages="errors.collect('first_name')"
                  ></v-text-field>
                  <v-text-field
                    label="Last Name"
                    name="last_name"
                    prepend-icon="person"
                    type="text"
                    v-validate="'required'"
                    data-vv-as="Last Name"
                    v-model="register.lastname"
                    :error-messages="errors.collect('last_name')"
                  ></v-text-field>
                  <v-text-field
                    label="Email"
                    name="email"
                    prepend-icon="email"
                    type="email"
                    v-validate="'email|required'"
                    v-model="register.email"
                    data-vv-as="Email"
                    :error-messages="errors.collect('email')"
                  ></v-text-field>

                  <v-text-field
                    ref="password"
                    label="Password"
                    name="password"
                    prepend-icon="lock"
                    type="password"
                    v-validate="'required|min:6'"
                    v-model="register.password"
                    :error-messages="errors.collect('password')"
                  ></v-text-field>

                  <v-text-field
                    id="confirm password"
                    label="Confirm Password"
                    name="password_confirmation"
                    prepend-icon="lock"
                    type="password"
                    v-validate="'required|min:6|confirmed:password'"
                    data-vv-as="confirm password"
                    v-model="register.confirm_password"
                    :error-messages="errors.collect('password_confirmation')"
                  ></v-text-field>
                </v-form>
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="#FFAB00" @click="registerUser">Register</v-btn>
              </v-card-actions>
            </v-card>
          </v-flex>
          <v-flex xs12 sm12 md6 lg6>
            <v-card height="400">
              <div id="my-signin2"></div>
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
import notification from "./notification.vue";
export default {
  data() {
    return {
      register: {
        firstname: "",
        lastname: "",
        email: "",
        password: "",
        confirm_password: ""
      },
      alert: "",
      notify:'',
      status:'',

    };
  },

  mounted() {
    this.renderButton();
  },
  components: {
    alert,
    notification
  },
  methods: {
    registerUser() {
      this.notify='';
      this.$validator.validateAll().then(result => {
        if (!result) {
          return;
        }

        Store.commit("setEmailToVerify", this.register.email);
        if (!this.errors.any()) {
          axios
            .post(this.$baseUrl + "/register", this.register, {})
            .then(response => {
              //console.log(response.data.message);
              this.$router.push({
                path: "/loginPage",
                query: {
                  alert: response.data.message,
                  snack: response.data.snack
                }
              });
            })
            .catch(error => {
              this.notify = error.response.data.message;
              this.status = 0;
              console.log(error.response.data.message);
              console.log("ERROR");
            });
        }
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
</style>