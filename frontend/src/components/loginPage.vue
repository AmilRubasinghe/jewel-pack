<template>
<body class="inventory-body">
  <div class="wrapper">
    <div class="container box">
      <alert v-if="alert" v-bind:message="alert"/>
 <notification v-if="notify"  :message="notify" :type="status"></notification>
      <v-snackbar v-if="snack" v-model="snackActive" bottom center multi-line :timeout="0">
        {{ snack }}
        <v-btn flat color="red" @click="resendEmail">Resend</v-btn>
        <v-btn flat color="red" @click="snackActive=!snackActive">Close</v-btn>
      </v-snackbar>

      <form class="form-signin" @submit.prevent="loginUser">
        <h1 align="center">Sign In</h1>
        <div class="form-group form-group-lg">
          <input
            type="email"
            class="form-control"
            id="inputEmail3"
            placeholder="Email"
            name="email"
            autofocus
            v-validate="'required|email'"
            v-model="login.email"
          >

          <div
            v-show="errors.has('email')"
            class="help block alert alert-danger"
          >{{ errors.first('email') }}</div>
        </div>

        <br>

        <div class="form-group form-group-lg">
          <input
            type="password"
            class="form-control"
            id="inputPassword3"
            placeholder="password"
            name="password"
            v-validate="'required'"
            v-model="login.password"
          >
          <div
            v-show="errors.has('password')"
            class="help block alert alert-danger"
          >{{ errors.first('password') }}</div>
        </div>


        
        <v-btn small to="request-password-reset" outline color="white">Forget Password?</v-btn>
        


        <div class="form-group form-group-lg" v-ripple="{ class: 'white--text' }">
          <v-btn type="submit" round color="blue" outline block>Sign in</v-btn>
        </div>
      </form>
    </div>
  </div>
</body>
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

      notify:'',
        status:2,
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
    if (this.$route.query.notify) {
       (this.notify = this.$route.query.notify);
    }
  },
  methods: {
    route() {
     console.log(this.$baseUrl);
    },
    resendEmail() {
      this.user.email = Store.getters.vEmail;
      axios
        .post(this.$baseUrl+"/resendvEmail", this.user, {})
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
      axios
        .post(this.$baseUrl+"/login", this.login, {})
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
</style>
