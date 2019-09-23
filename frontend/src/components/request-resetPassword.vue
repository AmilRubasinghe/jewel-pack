<template>
  <div>
    <v-container grid-list-md text-lg-center>
      <v-layout justify-center>
        <v-flex lg9 md9 sm12 xs12>
          <v-card class="card-5">
            <v-card-title class="justify-center">
              <h3 color="primary">Reset Password</h3>
            </v-card-title>
            <v-divider class="mx-5 justify-center v-divider-1"></v-divider>

            <notification v-if="notify" :message="notify" :type="status"></notification>
            <v-layout row wrap align-center justify-center>
              <v-flex lg8 md8 sm10 xs10>
                <form>
                  <h4>What's your email?</h4>
                  <v-text-field
                    v-model="User.email"
                    label="Email Address"
                    v-validate="'email'"
                    data-vv-as="email"
                    name="email_field"
                    type="text"
                    :error-messages="errors.collect('email_field')"
                  ></v-text-field>

                  <v-btn dark @click="sendPasswordResetLink" color="#FFAB00">Send Password Reset Link</v-btn>
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
  data() {
    return {
      User: {
        email: ""
      },
      notify: "",
      status: ""
    };
  },

  components: {
    notification
  },
  methods: {
    sendPasswordResetLink() {
      (this.notify = ""), this.$validator.validateAll();

      axios
        .post(this.$baseUrl + "/sendPasswordResetLink/", this.User)

        .then(response => {
          this.notify = response.data.data;
          this.status = 2;
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

