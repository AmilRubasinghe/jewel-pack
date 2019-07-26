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

      <v-flex xs12 md3>
        <form>
          <v-flex md7 xs6 sm2>
            <v-text-field v-model="labelname" readonly></v-text-field>
          </v-flex>

          <v-flex md7 xs6 sm2>
            <v-text-field v-model="labelemail" readonly></v-text-field>
          </v-flex>

          <v-flex md7 xs6 sm2>
            <v-text-field v-model="labelcontact" readonly></v-text-field>
          </v-flex>

          <v-flex md7 xs6 sm2>
            <v-text-field v-model="labelrole" readonly></v-text-field>
          </v-flex>

          <v-dialog v-model="dialog">
            <v-card>
              <v-card-title>
                <span class="headline">Edit Userr</span>
              </v-card-title>

              <v-card-text>
                <v-container grid-list-md>
                  <v-layout wrap>
                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="editedItem.firstName" label="First Name" />
                    </v-flex>

                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="editedItem.lastName" label="Last Name" />
                    </v-flex>

                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="editedItem.contactNo" label="Contact No" />
                    </v-flex>

                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="editedItem.email" label="Email" />
                    </v-flex>
                  </v-layout>
                </v-container>
              </v-card-text>

              <v-card-actions>
                <v-spacer></v-spacer>

                <v-btn color="blue darken-1" flat @click="close">Cancel</v-btn>
                <v-btn color="blue darken-1" flat @click="save">Save</v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>

          <v-btn @click="editItem()">Update</v-btn>
        </form>
      </v-flex>

      <v-flex xs12 md5>
        <form>
          <v-flex md10>
            <v-text-field v-model="fullname" readonly></v-text-field>
          </v-flex>

          <v-flex md10>
            <v-text-field v-model="user.email" readonly></v-text-field>
          </v-flex>

          <v-flex md10>
            <v-text-field v-model="user.contactNo" readonly></v-text-field>
          </v-flex>

          <v-flex md10>
            <v-text-field v-model="user.role" readonly></v-text-field>
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
      labelrole: "Role",

      editedItem: {
        labelname: "",
        labelemail: "",
        labelcontact: "",
        labelrole: ""
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
    
        Object.assign(this.user , this.editedItem);
        console.log("*******************");
        console.log(this.editedItem);

        axios
          .post(
            "http://localhost:8000/api/editUser/?token=" + $Token,
            this.editedItem
          )

          .then(response => {
            this.dialog = false;
            //this.snackbar = true;
            this.message = response.data.message;

           // this.getUsers();
            //console.log("Succesfully Edited");
          });
      
        //this.users.push(this.editedItem);
      
      this.close();
    },

    logout() {
      let $Token = localStorage.getItem("token");

      /* console.log(Token);*/

      // this.$http.post('http://localhost:8000/api/logout?token='+$Token)

      axios

        .post("http://localhost:8000/api/logout?token=" + $Token)

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

        .post("http://localhost:8000/api/me?token=" + $Token, {})

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

 
