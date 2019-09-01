<template>
  <div>
    <h1>Find Us</h1>
    <div class="mapouter">
      <div class="gmap_canvas">
        <iframe
          width="400"
          height="400"
          id="gmap_canvas"
          src="https://maps.google.com/maps?q=119%20Gangarama%20Rd%2C%20Boralesgamuwa%2C%20Western%20Province&t=&z=11&ie=UTF8&iwloc=&output=embed"
          frameborder="0"
          scrolling="no"
          marginheight="0"
          marginwidth="0"
        ></iframe>
        <a href="https://www.pureblack.de">Pureblack.de - Website erstellen lassen</a>
      </div>
    </div>
  </div>
</template>


<script>
import axios from "axios";
export default {
  data() {
    return {
      colours: ["White", "Black", "Grey"],
      border: "border String"
    };
  },

  methods: {
    send() {
      console.log("sending");

      axios
        .post(this.$baseUrl + "/test", {
          c: this.colours,
          b: this.border
        })
        .then(response => {
          console.log(response.data);

          //console.log(this.slideshowItems);
        })
        .catch(error => {
          console.log(error.response);
          console.log("ERROR");
        });
    }
  }
};
</script>

<style>
.mapouter {
  position: relative;
  text-align: right;
  height: 400px;
  width: 400px;
}
.gmap_canvas {
  overflow: hidden;
  background: none !important;
  height: 400px;
  width: 400px;
}
</style>
