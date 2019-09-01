<template>
  <v-app id="inspire">
    <v-container grid-list-md ma-0>
      <h1>Contact us</h1>
      <v-layout wrap align-top justify-center>
        <v-flex xs12 lg9>
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
            <br>
            Mob: +94 777 374777, + 94 714 167 943
            <br>
            Tel: +94 11 2509089, +94 11 2517441
          </h5>
        </v-flex>
      </v-layout>
      <br />
      <v-card  >
            <v-card-title>
              <h3>
                For More Information
              </h3>
              </v-card-title>

        <v-card-text>
          <v-form>
            <v-text-field label="Full Name" name="Full Name" prepend-icon="person" type="text"></v-text-field>
            <v-text-field label="Email" name="Email" prepend-icon="email" type="email"></v-text-field>
            <v-text-field label="Phone" name="Phone" prepend-icon="phone" type="text"></v-text-field>

            <v-textarea class="purple-input" label="Message" prepend-icon="message" type="text" />
          </v-form>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn>Send Message</v-btn>
        </v-card-actions>
      </v-card>
    </v-container>
  </v-app>
</template>


<script>
import axios from "axios";

export default {
  data() {
    return {};
  },

  methods: {}
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

