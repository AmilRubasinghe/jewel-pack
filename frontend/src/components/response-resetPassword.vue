<template>
  <div>
    <v-container grid-list-md text-lg-center>
      <v-layout justify-center>
        <v-flex lg9 md9 sm12 xs12>
          <v-card class="card-5">
            <v-card-title class="justify-center">
              <h2 color="primary">Reset Password</h2>
            </v-card-title>
            <v-divider class="mx-5 justify-center v-divider-1"></v-divider>

            <notification v-if="notify" :message="notify" :type="status"></notification>
            <v-layout row wrap align-center justify-center>
              <v-flex lg8 md8 sm10 xs10>
                <notification v-if="notify" :message="notify" :type="status"></notification>

                <form>
                  <v-text-field
                    v-model="newData.email"
                    label="Email Address"
                    v-validate="'email'"
                    data-vv-as="email"
                    name="email_field"
                    type="text"
                    :error-messages="errors.collect('email_field')"
                  ></v-text-field>

                  <v-text-field
                    type="password"
                    ref="password"
                    name="password"
                    v-model="newData.password"
                    label="New Password"
                    v-validate="'required'"
                    :error-messages="errors.collect('password')"
                  ></v-text-field>
                  <v-text-field
                    type="password"
                    name="password_confirmation"
                    v-model="newData.password_confirmation"
                    label="Confirm Password"
                    v-validate="'required|confirmed:password'"
                    data-vv-as="password"
                    :error-messages="errors.collect('password_confirmation')"
                  ></v-text-field>
                  <v-btn dark @click="reset" color="#FFAB00">Reset password</v-btn>
                </form>
              </v-flex>
            </v-layout>
          </v-card>
        </v-flex>
      </v-layout>
    </v-container>
  </div>
</template>

<script>
import axios from "axios";
import notification from "./notification.vue";

export default {
  mounted() {
    this.getToken();
  },
  data() {
    return {
      newData: {
        email: "",
        password: "",
        password_confirmation: "",
        resetToken: ""
      },
      notify: "",
      status: ""
    };
  },

  components: {
    notification
  },
  methods: {
    getToken() {
      this.newData.resetToken = this.$route.query.token;
    },
    reset() {
      this.$validator.validateAll();
      (this.notify = ""),
        axios
          .post(this.$baseUrl + "/resetPassword/", this.newData)

          .then(response => {
            this.$router.push({
              path: "/loginPage",
              query: { notify: response.data.data, status: 2 }
            });
          })
          .catch(error => {
            this.notify = error.response.data.error;
            this.status = 0;
            console.log(error.response);
            console.log("ERROR");
          });
    }
  }
};
</script>

