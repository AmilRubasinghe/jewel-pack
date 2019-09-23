<template>
  <vue-snotify></vue-snotify>
</template>
<script>
export default {
  props: ["message", "type"],
  data() {
    return {};
  },

  mounted() {
    this.show();
  },

  methods: {
    show() {
      if (this.type == 0) {
        this.$snotify.error(this.message, "Error", {
          timeout: 10000,
          showProgressBar: true,
          closeOnClick: false,
          pauseOnHover: true
        });
      } else if (this.type == 2) {
        this.$snotify.success(this.message, "Success", {
          timeout: 10000,
          showProgressBar: true,
          closeOnClick: false,
          pauseOnHover: true
        });
      }
    }
  }
};
</script>

