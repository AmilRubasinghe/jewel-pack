<template>
  <div>
    <navDrawer></navDrawer>
    <br />

    <div class="container" v-bind:style="{ background: '#B0BEC5'}">
      <v-dialog v-model="showModal" max-width="1200">
        <v-card>
          <v-card-title style="background-color:#eabf00;  ">
            <span class="headline">
              <p class="headline font-weight-bold" style="color:#212121; ">Edit User</p>
            </span>
          </v-card-title>
         

          <v-card-text>
            <v-container grid-list-md>
              <v-layout wrap>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.ID" label="ID" disabled></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4 d-flex>
                  <v-select
                    :items="roles"
                    label="Role"
                    outline
                    menu-props
                    v-model="editedItem.role"
                  ></v-select>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.firstName" label="First Name"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.lastName" label="Last Name"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.contactNo" label="Contact No"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.email" label="Email"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4 d-flex>
                  <v-select
                    :items="emailVerifyItems"
                    label="Email Verified"
                    outline
                    menu-props
                    v-model="editedItem.emailStatus"
                  ></v-select>
                </v-flex>
              </v-layout>
            </v-container>
          </v-card-text>

          <v-card-actions>
            <v-spacer></v-spacer> <v-container grid-list-md text-md-center fluid fill-height>
              <v-layout justify-end row wrap>
                <v-flex md2 sm4 lg2 xs4 d-flex>
                  <v-btn dark
                              block
                              color="#212121"
                              outline-color="#ffffff" @click="close">Cancel</v-btn>
                </v-flex>

                <v-flex md2 sm4 lg2 xs4 d-flex>
                  <v-btn  dark
                              block
                              color="#212121"
                              outline-color="#ffffff" @click="save">Save</v-btn>
                </v-flex>
              </v-layout>
            </v-container>

           
          </v-card-actions>
        </v-card>
      </v-dialog>

      <v-snackbar v-model="snackbar" multi-line timeout:6000 top auto-height>
        {{message}}
        <v-icon color="red" @click="snackbar = false">close</v-icon>
      </v-snackbar>

      <div>
        <v-toolbar flat color="white">
          <v-toolbar-title>{{table_title}}</v-toolbar-title>
          <v-spacer></v-spacer>

          <v-text-field
            v-model="search"
            append-icon="search"
            label="Search"
            single-line
            hide-details
          ></v-text-field>

          <v-btn v-if="!deletedUsers" @click="getDeletedUsers">
            <v-icon large color="blue">delete_sweep</v-icon>Deleted Users
          </v-btn>

          <v-btn v-if="deletedUsers" @click="getUsers">
            <v-icon large color="blue">playlist_add_check</v-icon>Active Users
          </v-btn>
        </v-toolbar>

        <v-data-table
          v-model="selected"
          :headers="headers"
          :items="users"
          :search="search"
          :pagination.sync="pagination"
          select-all
          item-key="ID"
          class="elevation-1"
        >
          <template v-slot:headers="props">
            <tr align="left">
              <th
                v-for="header in props.headers"
                :key="header.text"
                :class="['column sortable', pagination.descending ? 'desc' : 'asc', header.value === pagination.sortBy ? 'active' : '']"
                @click="changeSort(header.value)"
              >
                <v-icon small>arrow_upward</v-icon>
                {{ header.text }}
              </th>
            </tr>
          </template>
          <template v-slot:no-data>
            <v-alert :value="true" color="error" icon="warning">Sorry, nothing to display here :(</v-alert>
          </template>
          <template v-slot:items="props">
            <tr :active="props.selected" @click="props.selected = !props.selected">
              <td class="text-xs-left">{{ props.item.ID }}</td>
              <td class="text-xs-left">{{ props.item.role }}</td>
              <td class="text-xs-left">{{ props.item.firstName }}</td>
              <td class="text-xs-left">{{ props.item.lastName }}</td>
              <td class="text-xs-left">{{ props.item.contactNo }}</td>
              <td class="text-xs-left">{{ props.item.email }}</td>
              <td class="text-xs-center">{{ props.item.emailStatus }}</td>

              <td class="justify-center layout px-0">
                <v-icon
                  color="deep-purple darken-1"
                  medium
                  class="mr-2"
                  @click="editItem(props.item)"
                >edit</v-icon>
                <v-icon
                  v-if="!deletedUsers"
                  color="red"
                  medium
                  @click="deleteItem(props.item)"
                >delete</v-icon>
                <v-icon
                  v-if="deletedUsers"
                  color="green"
                  medium
                  @click="restoreItem(props.item)"
                >restore_from_trash</v-icon>
              </td>
            </tr>
          </template>
        </v-data-table>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import navDrawer from "../admin/navDrawer.vue";
export default {
  data() {
    return {
      photoA: undefined,
      snackbar: false,
      message: "",

      showModal: false,
      editedIndex: -1,
      editedItem: {},

      roles: ["user", "admin", "editor"],
      emailVerifyItems: [1, 0],

      defaultItem: {
        ID: 0,
        role: "",
        firstName: "",
        lastName: "",
        contactNo: "",
        email: "",
        emailVerified: ""
      },

      file: "",

      search: "",
      users: [],
      pagination: {
        sortBy: "ID"
      },
      selected: [],
      deletedUsers: false,
      table_title: "Users",

      headers: [
        { text: "ID", value: "ID" },
        { text: "Role", value: "role" },
        { text: "First Name", value: "firstName" },
        { text: "Last Name", value: "lastName" },
        { text: "Contact No", value: "contactNo" },
        { text: "Email", value: "email" },
        { text: "Email Verified", value: "emailVerified" },
        { text: "Action", value: "action" }
      ]
    };
  },

  mounted() {
    this.getUsers();
  },

  components: {
    navDrawer
  },

  computed: {
    pages() {
      if (
        this.pagination.rowsPerPage == null ||
        this.pagination.totalItems == null
      )
        return 0;

      return Math.ceil(
        this.pagination.totalItems / this.pagination.rowsPerPage
      );
    }
  },

  methods: {
    getUsers() {
      (this.table_title = "Active Users"), (this.deletedUsers = false);
      let $Token = localStorage.getItem("token");
      axios
        .get(this.$baseUrl + "/users?token=" + $Token)
        .then(response => {
          this.users = response.data.users;
        })
        .catch(error => {
          console.log(error.response);
          console.log("ERROR");
        });
    },

    getDeletedUsers() {
      (this.table_title = "Deleted Users"), (this.deletedUsers = true);
      let $Token = localStorage.getItem("token");
      axios
        .post(this.$baseUrl + "/deletedUsers?token=" + $Token)
        .then(response => {
          this.users = response.data.users;

          //console.log(this.slideshowItems);
        })
        .catch(error => {
          console.log(error.response);
          console.log("ERROR");
        });
    },

    changeSort(column) {
      if (this.pagination.sortBy === column) {
        this.pagination.descending = !this.pagination.descending;
      } else {
        this.pagination.sortBy = column;
        this.pagination.descending = false;
      }
    },

    close() {
      this.showModal = false;
      setTimeout(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      }, 300);
    },

    editItem(item) {
      this.editedIndex = this.users.indexOf(item);
      this.editedItem = Object.assign({}, item);
      //console.log(this.editedItem);
      this.showModal = true;
    },

    deleteItem(item) {
      this.$dialog
        .confirm("Want to delete user " + item.firstName + "?", {
          html: false, // set to true if your message contains HTML tags. eg: "Delete <b>Foo</b> ?"
          loader: true, // set to true if you want the dailog to show a loader after click on "proceed"
          reverse: false, // switch the button positions (left to right, and vise versa)
          okText: "Yes, Delete!",
          cancelText: "Cancel",
          animation: "bounce", // Available: "zoom", "bounce", "fade"
          backdropClose: true // set to true to close the dialog when clicking outside of the dialog window, i.e. click landing on the mask
        })
        .then(dialog => {
          let $Token = localStorage.getItem("token");
          axios
            .post(this.$baseUrl + "/deleteUser/" + item.ID + "?token=" + $Token)
            .then(response => {
              /*axios.get(item.deleteURL).then(res=>{
                            console.log(res);
                        });*/
              this.getUsers();
              // alert("Succesfully Deleted");

              this.$dialog
                .alert("Succesfully Deleted!", {
                  okText: "Dismiss!"
                })
                .then(function(dialog) {
                  console.log("Closed");
                });
            });

          setTimeout(() => {
            console.log("Delete action completed ");
            dialog.close();
          }, 2500);
        })
        .catch(() => {
          // Triggered when cancel button is clicked
          console.log("Delete aborted");
        });
    },

    restoreItem(item) {
      this.$dialog
        .confirm("Want to restore user " + item.firstName + "?", {
          html: false, // set to true if your message contains HTML tags. eg: "Delete <b>Foo</b> ?"
          loader: true, // set to true if you want the dailog to show a loader after click on "proceed"
          reverse: false, // switch the button positions (left to right, and vise versa)
          okText: "Yes, Restore!",
          cancelText: "Cancel",
          animation: "bounce", // Available: "zoom", "bounce", "fade"
          backdropClose: true // set to true to close the dialog when clicking outside of the dialog window, i.e. click landing on the mask
        })
        .then(dialog => {
          let $Token = localStorage.getItem("token");
          axios
            .post(
              this.$baseUrl + "/restoreUser/" + item.ID + "?token=" + $Token
            )
            .then(response => {
              /*axios.get(item.deleteURL).then(res=>{
                            console.log(res);
                        });*/
              this.getDeletedUsers();
              //  alert("Succesfully Restored");

              this.$dialog
                .alert("Succesfully Restored!", {
                  okText: "Dismiss!"
                })
                .then(function(dialog) {
                  console.log("Closed");
                });
            });

          setTimeout(() => {
            console.log("Delete action completed ");
            dialog.close();
          }, 2500);
        })
        .catch(() => {
          // Triggered when cancel button is clicked
          console.log("Delete aborted");
        });
    },
    save() {
      let $Token = localStorage.getItem("token");
      if (this.editedIndex > -1) {
        Object.assign(this.users[this.editedIndex].email, this.editedItem);
        console.log("*******************");
        console.log(this.editedItem);

        axios
          .post(this.$baseUrl + "/editUser/?token=" + $Token, this.editedItem)

          .then(response => {
            this.showModal = false;
            this.snackbar = true;
            this.message = response.data.message;

            this.getUsers();
            //console.log("Succesfully Edited");
          });
      } else {
        this.users.push(this.editedItem);
      }
      this.close();
    }
  }
};
</script>