



<template>
  <v-app id="inspire">
    <v-content>
      <v-container fluid fill-height>
        <v-layout align-Top justify-top>
          <v-flex xs12 sm8 md8>
            <v-card class="elevation-14">
              <v-toolbar color="primary" dark flat>
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
                <v-btn color="blue" @click='registerUser'>Register</v-btn>
              </v-card-actions>
            </v-card>
          </v-flex>
          <v-flex xs12 sm8 md8>
            <v-card height="400"></v-card>
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
      register: {
        firstname: "",
        lastname: "",
        email: "",
        password: "",
        confirm_password: ""
      },
      alert: ""
    };
  },
  components: {
    alert
  },
  methods: {
    registerUser() {
      this.$validator.validateAll();

      Store.commit("setEmailToVerify", this.register.email);
      if (!this.errors.any()) {
        axios
          .post(this.$baseUrl+"/register", this.register, {})
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
            console.log(error.response);
            console.log("ERROR");
          });
      }
    }
  }
};
</script>


<style>
</style>