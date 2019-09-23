<template>
  <div>
    <v-btn @click="test" dark>Mas</v-btn>

    <v-hover v-slot:default="{ hover }">
      <v-avatar slot="offset" class="mx-auto d-block" size="230">
        <v-img src="https://demos.creative-tim.com/vue-material-dashboard/img/marc.aba54d65.jpg">
          <v-expand-transition>
            <div
              v-if="hover"
              class="d-flex transition-fast-in-fast-out black darken-2 v-card--reveal display-1 white--text"
              style="height: 40%;"
            >Update</div>
          </v-expand-transition>
        </v-img>
      </v-avatar>
    </v-hover>
  </div>
</template>

<script>
export default {
  methods: {
    test() {
      this.$dialog
        .confirm("Delete the selected file?", {
          html: false, // set to true if your message contains HTML tags. eg: "Delete <b>Foo</b> ?"
          loader: true, // set to true if you want the dailog to show a loader after click on "proceed"
          reverse: false, // switch the button positions (left to right, and vise versa)
          okText: "Yes, Delete!",
          cancelText: "Cancel",
          animation: "bounce", // Available: "zoom", "bounce", "fade"
          backdropClose: true // set to true to close the dialog when clicking outside of the dialog window, i.e. click landing on the mask
        })
        .then(dialog => {
          setTimeout(() => {
            console.log("Delete action completed ");
            dialog.close();
          }, 2500);
        })
        .catch(() => {
          // Triggered when cancel button is clicked
          console.log("Delete aborted");
        });
    }
  }
};
</script>


<style>
.v-card--reveal {
  align-items: center;
  bottom: 0;
  justify-content: center;
  opacity: 0.5;
  position: absolute;
  width: 100%;
}
</style>