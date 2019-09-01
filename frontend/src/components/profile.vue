<template>
  <v-container grid-list-md text-xs-center>
    <v-layout row wrap>
      <v-flex xs12 md4>
        <v-avatar slot="offset" class="mx-auto d-block" size="250">
          <img src="https://demos.creative-tim.com/vue-material-dashboard/img/marc.aba54d65.jpg" />
        </v-avatar>

        <v-card-text class="text-xs-center">
          <h4 class="card-title font-weight-light">{{fullname}}</h4>
        </v-card-text>
      </v-flex>

      <v-dialog v-model="dialog" max-width="700">
        <v-card>
          <v-card-title>
            <span class="headline">Update Details</span>
          </v-card-title>

          <v-card-text>
            <v-container grid-list-md text-md-center fluid fill-height>
              <v-layout column>
                <v-flex md3 sm3 lg3 xs3 d-flex>
                  <v-text-field v-model="editedItem.firstName" label="First Name" />
                </v-flex>

                <v-flex md3 sm3 lg3 xs3 d-flex>
                  <v-text-field v-model="editedItem.lastName" label="Last Name" />
                </v-flex>

                <v-flex md3 sm3 lg3 xs3 d-flex>
                  <v-text-field v-model="editedItem.contactNo" label="Contact No" />
                </v-flex>

                <v-flex md3 sm3 lg3 xs3 d-flex>
                  <v-text-field v-model="editedItem.email" label="Email" />
                </v-flex>
              </v-layout>
            </v-container>
          </v-card-text>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-container grid-list-md text-md-center fluid fill-height>
              <v-layout row wrap>
                <v-flex d-flex>
                  <v-btn color="primary" @click="close">Cancel</v-btn>
                </v-flex>

                <v-flex d-flex>
                  <v-btn color="primary" @click="save">Save</v-btn>
                </v-flex>
              </v-layout>
            </v-container>
          </v-card-actions>
        </v-card>
      </v-dialog>

      <v-flex md4 xs6 sm6>
        <form>
          <v-flex md7 xs6 sm6>
            <v-text-field v-model="labelname" readonly></v-text-field>
          </v-flex>

          <v-flex md7 xs6 sm6>
            <v-text-field v-model="labelemail" readonly></v-text-field>
          </v-flex>

          <v-flex md7 xs6 sm6>
            <v-text-field v-model="labelcontact" readonly></v-text-field>
          </v-flex>

          <v-btn @click="editItem()">Update</v-btn>
          <v-btn @click="myOrders">My Orders</v-btn>
        </form>
      </v-flex>

      <v-flex xs6 sm6 md4>
        <form>
          <v-flex>
            <v-text-field v-model="fullname" readonly></v-text-field>
          </v-flex>

          <v-flex>
            <v-text-field v-model="user.email" readonly></v-text-field>
          </v-flex>

          <v-flex>
            <v-text-field v-model="user.contactNo" readonly></v-text-field>
          </v-flex>
        </form>
      </v-flex>
    </v-layout>
  </v-container>
</template>

 


 

<script>
import axios from "axios";

import Store from "../store.js";

export default {
  data() {
    return {
      user: [],
      labelname: "Full Name",
      labelemail: "Email",
      labelcontact: "Contact No",

      editedItem: {
        labelname: "",
        labelemail: "",
        labelcontact: ""
      },

      defaultItem: {},
      dialog: false
    };
  },

  computed: {
    fullname: function() {
      return this.user.firstName + " " + this.user.lastName;
    }
  },

  created: function() {
    this.me();

    // this.user=response.data.user;

    if (Store.getters.user) {
      this.user = Store.getters.user;
    } else {
      this.logout();
    }

    
  },

  methods: {
    myOrders() {
      let $Token = localStorage.getItem("token");
      axios
        .post(this.$baseUrl + "/myOrder/" + $Token)
        .then(response => {
          console.log(response.data);
        })

        .catch(error => {
          console.log(error.response);

          console.log("ERROR");
        });
    },

    editItem() {
      this.editedItem = Object.assign({}, this.user);
      console.log(this.editedItem);
      this.dialog = true;
    },

    close() {
      this.dialog = false;
    },

    save() {
      let $Token = localStorage.getItem("token");

      Object.assign(this.user, this.editedItem);
      console.log("*******************");
      console.log(this.editedItem);

      axios
        .post(
          this.$baseUrl+"/editUser/?token=" + $Token,
          this.editedItem
        )

        .then(response => {
          this.dialog = false;
          //this.snackbar = true;
          this.message = response.data.message;
        });

      //this.users.push(this.editedItem);

      this.close();
    },

    logout() {
      let $Token = localStorage.getItem("token");

      /* console.log(Token);*/

      // this.$http.post('http://localhost:8000/api/logout?token='+$Token)

      axios

        .post(this.$baseUrl + "/logout?token=" + $Token)

        .then(response => {
          localStorage.removeItem("token");

          let $Token = localStorage.getItem("token");

          if (!$Token) {
            this.$store.commit("setUser", null);

            this.$router.push("/loginPage");
          }
        })

        .catch(error => {
          console.log(error.response);

          console.log("ERROR");
        });
    },

    me() {
      let $Token = localStorage.getItem("token");

      axios

        .post(this.$baseUrl + "/me?token=" + $Token, {})

        .then(response => {
          if (!$Token) {
            this.$router.push("/loginPage");
          } else {
            this.user = response.data.user;

            Store.dispatch("setUser", this.user);
          }
        })

        .catch(error => {
          console.log(error.response);

          console.log("ERROR");

          this.$store.commit("setUser", null);

          this.$router.push("/loginPage");

          this.logout();
        });
    }
  }
};
</script>


<style>
.card-5 {
  box-shadow: 0 19px 38px rgba(0, 0, 0, 0.3), 0 15px 12px rgba(0, 0, 0, 0.22);
}
</style>

 
