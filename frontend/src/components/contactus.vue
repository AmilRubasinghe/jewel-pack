<template>
  <v-app id="inspire">
    <v-container grid-list-md pa-3>
      <notification v-if="notify" :message="notify" :type="status"></notification>
      <h1>Contact us</h1>
      <v-layout wrap align-top justify-center>
        <v-flex xs12 lg9>
          <!--
            used
            https://www.embedgooglemap.net/
          -->
          <div class="resp-container">
            <div class="gmap_canvas">
              <iframe
                class="resp-iframe"
                src="https://maps.google.com/maps?q=119%20Gangarama%20Rd%20Boralesgamuwa&t=&z=13&ie=UTF8&iwloc=&output=embed"
                frameborder="0"
                scrolling="no"
                marginheight="0"
                marginwidth="0"
              ></iframe>
              <a href="https://www.embedgooglemap.net/blog/best-wordpress-themes/"></a>
            </div>
          </div>
        </v-flex>

        <v-flex xs12 lg3>
          <h3>Address</h3>
          <h5>
            119/2, Gangarama Road, Werahera, Boralesgamuwa.
            <br />Mob: +94 777 374777, + 94 714 167 943
            <br />Tel: +94 11 2509089, +94 11 2517441
          </h5>
        </v-flex>
      </v-layout>
      <br />
      <v-card>
        <v-card-title>
          <h3>For More Information</h3>
        </v-card-title>

        <v-card-text>
          <v-form>
            <v-text-field
              label="Full Name"
              prepend-icon="person"
              type="text"
              name="Full_Name"
              v-validate="'required'"
              data-vv-as="First Name"
              :error-messages="errors.collect('Full_Name')"
              v-model="name"
            ></v-text-field>
            <v-text-field
              label="Email"
              name="Email"
              prepend-icon="email"
              type="email"
              v-validate="'email|required'"
              data-vv-as="Email"
              :error-messages="errors.collect('Email')"
              v-model="email"
            ></v-text-field>
            <v-text-field
              label="Phone"
              name="Phone"
              prepend-icon="phone"
              type="text"
              v-model="phone"
            ></v-text-field>

            <v-textarea
              v-validate="'required'"
              name="Message"
              data-vv-as="Message"
              :error-messages="errors.collect('Message')"
              class="purple-input"
              label="Message"
              prepend-icon="message"
              type="text"
              v-model="msg"
            />
          </v-form>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="secondary" large @click="save">Send Message</v-btn>
        </v-card-actions>
      </v-card>
    </v-container>
  </v-app>
</template>


<script>
import axios from "axios";
import notification from "./notification.vue";

export default {
  data() {
    return {
      name: "",
      msg: "",
      phone: "",
      email: "",

      notify: "",
      status: ""
    };
  },

  components: {
    notification
  },

  methods: {
    save() {


      this.$validator
        .validateAll()
        .then(result => {
          if (!result) {
            return;
          }

          this.notify = "";
          let $Token = localStorage.getItem("token");
          axios
            .post(this.$baseUrl + "/saveMsg/?token=" + $Token, {
              name: this.name,
              msg: this.msg,
              phone: this.phone,
              email: this.email
            })
            .then(response => {
              console.log(response.data);
              this.notify = response.data.data;
              this.status = 2;
              //  this.clear();
            })

            .catch(error => {
              this.notify = "Something Went Wrong. Please try again!";
              this.status = 0;

              console.log(error.response);

              console.log("ERROR");
            });
        })
        
    },

    clear() {
      (this.name = " "), (this.phone = ""), (this.email = ""), (this.msg = "");
      this.errors.clear();
    }
  }
};
</script>




<style>
.mapouter {
  position: relative;
  text-align: right;
  height: 400px;
  width: 1024px;
}
.gmap_canvas {
  overflow: hidden;
  background: none !important;
}

.resp-container {
  position: relative;
  overflow: hidden;
  padding-top: 56.25%;
}

.resp-iframe {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  border: 0;
}
</style>

