<template>
  <div>
    <navDrawer v-model="drawer"></navDrawer>
    <br />

    <div class="container" v-bind:style="{ background: '#B0BEC5'}">
      <v-dialog v-model="dialog" max-width="600px">
        <v-card max-width="600px">
          <v-card-title>
            <span class="headline">Upload File</span>
          </v-card-title>
          <v-card-text>
            <v-layout align-center justify-center>
              <v-flex d-flex>
                <v-layout align-center justify-center>
                  <v-flex xs6 sm6 md6 lg6 d-flex>
                    <v-card flat ripple hover max-height="300" max-width="250">
                      <form enctype="multipart/form-data">
                        <div class="text-xs-center">
                          <label class="button">
                            <input
                              id="photoA"
                              type="file"
                              ref="file"
                              accept="image/*"
                              @change="addFile('photoA', $event)"
                              style="display:none"
                            />
                            <v-icon outline large>cloud_upload</v-icon>
                            <p
                              class="subtitle-1 font-weight-medium"
                              style="color:#616161;"
                            >Upload photo</p>
                            <span v-if="photoA" class="file-name">
                              <p
                                class="subtitle-1 font-weight-medium"
                                style="color:#eabf00; align:center;"
                              >{{photoA.name}}</p>
                            </span>
                          </label>
                        </div>
                      </form>
                    </v-card>
                  </v-flex>
                </v-layout>
              </v-flex>
            </v-layout>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn outline color="blue" @click="dialog = false">Close</v-btn>
            <v-btn outline color="blue" @click="sendFile">Upload</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>

      <v-dialog v-model="showModal">
        <v-card>
          <v-card-title>
            <span class="headline">Edit Item</span>
          </v-card-title>

          <v-card-text>
            <v-container grid-list-md>
              <v-layout wrap>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.imageID" label="Image ID" disabled></v-text-field>
                </v-flex>
                <v-flex xs12 sm12 md12>
                  <v-text-field v-model="editedItem.path" label="Image URL"></v-text-field>
                </v-flex>
                <v-flex xs12 sm12 md12>
                  <v-text-field v-model="editedItem.name" label="File Name"></v-text-field>
                </v-flex>
              </v-layout>
            </v-container>
          </v-card-text>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" flat @click="close">Cancel</v-btn>
            <v-btn color="blue darken-1" flat @click="editSave">Save</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>

      <div>
        <v-toolbar flat color="white">
          <v-toolbar-title>Slideshow Images</v-toolbar-title>
          <v-spacer></v-spacer>

          <v-text-field
            v-model="search"
            append-icon="search"
            label="Search"
            single-line
            hide-details
          ></v-text-field>
          <v-btn fab dark color="blue" @click="dialog = true">
            <v-icon dark>add</v-icon>
          </v-btn>

          <v-btn fab dark color="blue" @click="getSlideshow">
            <v-icon dark>refresh</v-icon>
          </v-btn>
        </v-toolbar>
        <v-data-table
          v-model="selected"
          :headers="headers"
          :items="slideshowItems"
          :search="search"
          :pagination.sync="pagination"
          select-all
          item-key="imageID"
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
              <td class="text-xs-left">{{ props.item.imageID }}</td>
              <td class="text-xs-left">{{ props.item.name }}</td>
              <td class="text-xs-left">{{ props.item.path }}</td>
              <td class="text-xs-left">
                <v-img :src="props.item.path"></v-img>
              </td>
              <td class="justify-center layout px-0">
                <v-icon
                  color="deep-purple darken-1"
                  medium
                  class="mr-2"
                  @click="editItem(props.item)"
                >edit</v-icon>
                <v-icon color="red" medium @click="deleteItem(props.item)">delete</v-icon>
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
      drawer: false,
      dialog: false,
      showModal: false,
      editedIndex: -1,
      editedItem: {
        imageID: 0,
        path: "",
        name: ""
      },
      defaultItem: {
        imageID: 0,

        path: "",

        name: ""
      },

      file: "",
      photoA: undefined,

      search: "",
      slideshowItems: [],
      pagination: {
        sortBy: "imageID"
      },
      selected: [],

      headers: [
        { text: "Image ID", value: "imageID" },
        { text: "File Name", value: "name" },
        { text: "Image URL", value: "path" },
        { text: "Preview", value: "preview" },
        { text: "Actions", value: "name", sortable: false }
      ]
    };
  },

  mounted() {
    this.getSlideshow();
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
    /*
    selectFile(event) {
      this.file = this.$refs.file.files[0];
      console.log(this.file.name);
    },*/

    addFile(fileKey, event) {
      this[fileKey] = event.target.files[0];
      console.log("File added", fileKey, event.target.files[0]);
    },
    upload() {
      let formData = new FormData();

      /*
                Add the form data we need to submit
            */
      formData.append("file", this.file);

      /*
          Make the request to the POST /single-file URL
        */
      axios
        .post(this.$baseUrl + "/upload/slideshow", formData, {
          headers: {
            "Content-Type": "multipart/form-data"
          }
        })
        .then(function() {
          console.log("UPLOAD SUCCESS!!");
        })
        .catch(function() {
          console.log("UPLOAD FAILURE!!");
        });
    },

    sendFile() {
      const formData = new FormData();
      //formData.append("file", this.file, this.file.name);
      formData.append("file", this.photoA, this.photoA.name);

      console.log("****");

      let $Token = localStorage.getItem("token");
      axios
        .post(
          this.$baseUrl + "/storeImage" + "?token=" + $Token,
          // axios.post('http://localhost:8000/api/storeImage'+'?token='+$Token,response.data)
          // axios.post('https://vgy.me/upload?userkey=Kpx6WS9lOl8dx3rU9pDrOasKbkUOlpGs',
          formData
        )
        .then(response => {
          this.dialog = false;
          this.file = "";
          this.getSlideshow();
          // alert("Succesfully Saved");

          this.$dialog
            .alert("Succesfully Saved!", {
              okText: "Dismiss!"
            })
            .then(function(dialog) {
              console.log("Closed");
            });
        })
        .catch(error => {
          console.log(error.response);
          console.log("Failed Save img url");
        });
    },

    getSlideshow() {
      axios
        .get(this.$baseUrl + "/getImages")
        .then(response => {
          this.slideshowItems = response.data.images;

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
      this.editedIndex = this.slideshowItems.indexOf(item);
      this.editedItem = Object.assign({}, item);
      console.log(this.editedItem);
      this.showModal = true;
    },

    deleteItem(item) {
      // var result = confirm("Want to delete?");

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
          let $Token = localStorage.getItem("token");
          axios
            .post(this.$baseUrl + "/deleteSlideshow/?token=" + $Token, item)
            .then(response => {
              this.getSlideshow();
              // alert("Succesfully Deleted");
              dialog.close();

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

      /*
      if (result) {
        let $Token = localStorage.getItem("token");
        //console.log(item.imageID)

        axios
          .post(this.$baseUrl + "/deleteSlideshow/?token=" + $Token, item)
          .then(response => {
            
            this.getSlideshow();
            alert("Succesfully Deleted");
          });
      }
      */
    },

    editSave() {
      let $Token = localStorage.getItem("token");
      if (this.editedIndex > -1) {
        Object.assign(this.slideshowItems[this.editedIndex], this.editedItem);
        console.log("*******************");
        console.log(this.editedItem);

        axios
          .post(
            this.$baseUrl +
              "/edititems/" +
              this.editedItem.imageID +
              "?token=" +
              $Token,
            this.editedItem
          )
          .then(response => {
            this.showModal = false;
            this.getSlideshow();
            console.log("Succesfully Edited");
          });
      } else {
        this.slideshowItems.push(this.editedItem);
      }
      this.close();
    }
  }
};
</script>