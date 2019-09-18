<template>
  <v-container grid-list-md text-xs-center>
    <notification v-if="notify" :message="notify" :type="status"></notification>

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

    <v-dialog v-model="passwordDialog" max-width="700">
      <v-card>
        <v-card-title>
          <span class="headline">Update Password</span>
        </v-card-title>

        <v-card-text>
          <v-container grid-list-md text-md-center fluid fill-height>
            <v-layout column>
              <v-flex md3 sm3 lg3 xs3 d-flex>
                <v-text-field
                  :type="show1 ? 'text' : 'password'"
                  :append-icon="show1 ? 'visibility' : 'visibility_off'"
                  @click:append="show1 = !show1"
                  v-model="OldPassword"
                  label="Current Password"
                />
              </v-flex>

              <v-flex md3 sm3 lg3 xs3 d-flex>
                <v-text-field
                  ref="password"
                  name="password"
                  :type="show2 ? 'text' : 'password'"
                  :append-icon="show2 ? 'visibility' : 'visibility_off'"
                  @click:append="show2 = !show2"
                  v-model="NewPassword"
                  label="New Password"
                  v-validate="'required|min:6'"
                  :error-messages="errors.collect('password')"
                />
              </v-flex>

              <v-flex md3 sm3 lg3 xs3 d-flex>
                <v-text-field
                  :type="show3 ? 'text' : 'password'"
                  :append-icon="show3 ? 'visibility' : 'visibility_off'"
                  @click:append="show3 = !show3"
                  v-model="ConfirmNewPassword"
                  label="Confirm New Password"
                  name="password_confirmation"
                  v-validate="'required|min:6|confirmed:password'"
                  data-vv-as="Confirm Password"
                  :error-messages="errors.collect('password_confirmation')"
                />
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
                <v-btn color="primary" @click="editPassword">Save</v-btn>
              </v-flex>
            </v-layout>
          </v-container>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <v-layout row wrap>
      <v-flex xs12 md4 sm12>
        <v-avatar slot="offset" class="mx-auto d-block" size="230">
          <img src="https://demos.creative-tim.com/vue-material-dashboard/img/marc.aba54d65.jpg" />
        </v-avatar>

        <v-card-text class="text-xs-center">
          <h4 class="card-title font-weight-dark">{{fullname}}</h4>
        </v-card-text>
      </v-flex>

      <v-flex md8 xs12 sm12>
        <v-card class="card-5 pa-3">
          <form>
            <v-layout align-center justify-center>
              <v-flex md7 xs6 sm10 class="text-xs-left">
                <div>
                  <p class="ma-0 pa-0">
                    <b>{{labelname}}</b>
                  </p>
                </div>
                <v-text-field v-model="fullname" readonly class="ma-0 pa-0"></v-text-field>
              </v-flex>
            </v-layout>

            <v-layout align-center justify-center>
              <v-flex md7 xs6 sm10 class="text-xs-left">
                <div>
                  <p class="ma-0 pa-0">
                    <b>{{labelemail}}</b>
                  </p>
                </div>
                <v-text-field v-model="user.email" readonly class="ma-0 pa-0"></v-text-field>
              </v-flex>
            </v-layout>

            <v-layout align-center justify-center>
              <v-flex md7 xs6 sm10 class="text-xs-left">
                <div>
                  <p class="ma-0 pa-0">
                    <b>{{labelcontact}}</b>
                  </p>
                </div>
                <v-text-field v-model="user.contactNo" readonly class="ma-0 pa-0"></v-text-field>
              </v-flex>
            </v-layout>
          </form>

          <v-btn @click="editItem()" color="secondary">Edit Profile</v-btn>
          <v-btn @click="editPasswordDialog()" color="secondary">Change Password</v-btn>
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>

 


 

<script>
import axios from "axios";
import notification from "./notification.vue";

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

      OldPassword: "",
      NewPassword: "",
      ConfirmNewPassword: "",
      defaultItem: {},
      dialog: false,
      passwordDialog: false,
      show1: false,
      show2: false,
      show3: false,
      notify: "",
      status: ""
    };
  },

  components: {
    notification
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
    editPassword() {
      this.$validator.validateAll().then(result => {
        if (!result) {
          return;
        }
        this.notify = "";

        let $Token = localStorage.getItem("token");
        axios
          .post(this.$baseUrl + "/editPassword/?token=" + $Token, {
            ID: this.user.ID,
            OldPassword: this.OldPassword,
            NewPassword: this.NewPassword
          })
          .then(response => {
            this.close();
            this.notify = response.data.message;
            this.status = 2;
          })

          .catch(error => {
            this.notify = error.response.data.message;
            this.status = 0;
            console.log(error.response);

            console.log("ERROR");
          });
      });
    },
    myOrders() {
      let $Token = localStorage.getItem("token");
      axios
        .post(this.$baseUrl + "/myOrder/?token=" + $Token)
        .then(response => {
          // console.log(response.data);
        })

        .catch(error => {
          console.log(error.response);

          console.log("ERROR");
        });
    },

    editPasswordDialog() {
      this.clear();
      this.passwordDialog = true;
    },

    editItem() {
      this.editedItem = Object.assign({}, this.user);
      // console.log(this.editedItem);
      this.dialog = true;
    },

    close() {
      (this.dialog = false), (this.passwordDialog = false);
    },

    clear() {
      (this.OldPassword = ""),
        (this.NewPassword = ""),
        (this.ConfirmNewPassword = "");
    },

    save() {
      this.notify = "";
      let $Token = localStorage.getItem("token");

      Object.assign(this.user, this.editedItem);

      axios
        .post(this.$baseUrl + "/editProfile/?token=" + $Token, this.editedItem)

        .then(response => {
          this.dialog = false;

          this.notify = response.data.message;
          this.status = 2;
          this.message = response.data.message;
        })
        .catch(error => {
          this.notify = error.response.data.message;
          this.status = 0;
          console.log(error.response);
          console.log("ERROR");
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

 
