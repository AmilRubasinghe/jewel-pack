<template>
  <div>
    <br />

    <div class="container" v-bind:style="{ background: '#B0BEC5'}">
      <v-dialog v-model="dialog" max-width="700">
        <v-card>
           <v-card-title style="background-color:#eabf00;  ">
            <span class="headline">
              <p class="headline font-weight-bold" style="color:#212121; ">Add category</p>
            </span>
          </v-card-title>
         

          <v-card-text>
            <v-container grid-list-md text-md-center fluid fill-height>
              <v-layout column>
                <v-flex md3 sm3 lg3 xs3 d-flex>
                  <v-text-field
                    v-model="newCategory.CName"
                    v-validate="'required'"
                    :error-messages="errors.collect('CategoryName')"
                    label="Category Name"
                    data-vv-name="CategoryName"
                    required
                  />
                </v-flex>

                <v-flex md3 sm3 lg3 xs3 d-flex>
                  <v-text-field
                    v-model="newCategory.icon"
                    v-validate="'required'"
                    :error-messages="errors.collect('IconCode')"
                    label="IconCode"
                    placeholder="Leave blank for default icon"
                    data-vv-name="IconCode"
                    required
                  />
                </v-flex>
                <v-flex d-flex>
                  <v-layout row wrap justify-center>
                    <!-- <v-flex xs6 sm6 md3 lg3 d-flex>
                      <v-card flat ripple hover max-height="300" max-width="250">
                        <v-img max-height="150" max-width="250" :src="editedItem.Image2"></v-img>
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
                    </v-flex>-->

                    <v-flex xs9 sm9 md4 lg4 d-flex>
                      <v-card
                      flat ripple hover max-height="300" max-width="250"
                        
                      >
                        <form enctype="multipart/form-data">
                          <div class="text-xs-center">
                            <label class="button">
                              <input
                               id="photoA"
                              type="file"
                              ref="file"
                              accept="image/*"
                            
                              style="display:none"
                                
                                @change="selectFile"
                              
                              />
                              
                              <v-icon outline large>cloud_upload</v-icon>
                               <p
                                class="subtitle-1 font-weight-medium"
                                style="color:#616161;"
                              >Upload photo</p>
                              <span v-if="file" class="file-name"> <p
                                  class="subtitle-1 font-weight-medium"
                                  style="color:#eabf00; align:center;"
                                >{{file.name}}</p></span>
                            </label>
                          </div>
                        </form>
                      </v-card>
                    </v-flex>
                  </v-layout>
                </v-flex>
              </v-layout>
            </v-container>
          </v-card-text>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-container grid-list-md text-md-center fluid fill-height>
              <v-layout row wrap>
                <v-flex d-flex>
                  <v-btn outline block color="#eabf00" outline-color="#ffffff" @click="clear">clear</v-btn>
                </v-flex>

                <v-flex d-flex>
                  <v-btn dark
                    block
                    color="#212121"
                    outline-color="#ffffff" @click="dialog = false">Close</v-btn>
                </v-flex>
                <v-flex d-flex>
                  <v-btn dark block color="#212121" outline-color="#ffffff" @click="addCat">Save</v-btn>
                </v-flex>
              </v-layout>
            </v-container>
          </v-card-actions>
        </v-card>
      </v-dialog>

      <v-dialog v-model="showModal" max-width="700">
        <v-card>
          <v-card-title style="background-color:#eabf00;  ">
            <span class="headline">
              <p class="headline font-weight-bold" style="color:#212121; ">Edit Category</p>
            </span>
          </v-card-title>
         

          <v-card-text>
            <v-container grid-list-md text-md-center fluid fill-height>
              <v-layout column>
                <v-flex md3 sm3 lg3 xs3 d-flex>
                  <v-text-field v-model="editedItem.CID" label="CID" disabled />
                </v-flex>

                <v-flex md3 sm3 lg3 xs3 d-flex>
                  <v-text-field v-model="editedItem.CName" label="Category Name" />
                </v-flex>

                <v-flex md3 sm3 lg3 xs3 d-flex>
                  <v-text-field v-model="editedItem.icon" label="Icon" />
                </v-flex>

                <v-flex xs12 sm6 offset-sm4>
                  <v-img height="155" width="350" max-width="260px" :src="editedItem.Image"></v-img>

                  <v-card
                    flat
                   
                    @click="$refs.file.click()"
                    ripple
                    hover
                    height="70"
                    width="260"
                    max-width="600px"
                  >
                    <form enctype="multipart/form-data">
                      <div class="text-xs-center">
                        <label class="button">
                          <input type="file" ref="file" @change="selectFile" style="display:none" />
                          <v-icon outline large>cloud_upload</v-icon>
                          <h4>Upload photo</h4>
                          <span v-if="file" class="file-name">{{file.name}}</span>
                        </label>
                      </div>
                    </form>
                  </v-card>
                </v-flex>
              </v-layout>
            </v-container>
          </v-card-text>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-container grid-list-md text-md-center fluid fill-height>
              <v-layout row wrap>
                <v-flex d-flex>
                  <v-btn dark block color="#212121" outline-color="#ffffff" @click="close">Cancel</v-btn>
                </v-flex>

                <v-flex d-flex>
                  <v-btn dark block color="#212121" outline-color="#ffffff" @click="editSave">Save</v-btn>
                </v-flex>
              </v-layout>
            </v-container>
          </v-card-actions>
        </v-card>
      </v-dialog>

      <v-card>
        <v-card-title>
          <h3>Category</h3>

          <v-spacer></v-spacer>
          <v-text-field
            v-model="search"
            append-icon="search"
            label="Search"
            single-line
            hide-details
          ></v-text-field>

          <v-btn fab dark color="blue" @click="dialogOpen">
            <v-icon dark>add</v-icon>
          </v-btn>

          <v-btn fab dark color="blue" @click="catItems">
            <v-icon dark>refresh</v-icon>
          </v-btn>

          <v-btn v-if="!deleted" @click="getDeletedCat">
            <v-icon large color="blue">delete_sweep</v-icon>Deleted Category
          </v-btn>

          <v-btn v-if="deleted" @click="catItems">
            <v-icon large color="blue">playlist_add_check</v-icon>Available Category
          </v-btn>
        </v-card-title>
        <v-data-table
          v-model="selected"
          :headers="headers"
          :items="categoryItems"
          :search="search"
          :pagination.sync="pagination"
          select-all
          item-key="CID"
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
              <td class="text-xs-center">{{ props.item.CID }}</td>
              <td class="text-xs-center">{{ props.item.CName }}</td>
              <td class="text-xs-center">{{ props.item.icon }}</td>
              <td class="text-xs-center">{{ props.item.Image }}</td>
              <td class="text-xs-center">{{ props.item.file }}</td>
                <td class="text-xs-left">
                <v-img :src="props.item.Image"></v-img>
              </td>
              <td class="justify-center layout px-0">
                <v-icon
                  color="deep-purple darken-1"
                  medium
                  class="mr-2"
                  @click="editItem(props.item)"
                >edit</v-icon>
                <v-icon v-if="!deleted" color="red" medium @click="deleteItem(props.item)">delete</v-icon>
                <v-icon
                  v-if="deleted"
                  color="green"
                  medium
                  @click="restoreItem(props.item)"
                >restore_from_trash</v-icon>
              </td>
            </tr>
          </template>
        </v-data-table>
      </v-card>
    </div>
  </div>
</template>



<script>
import axios from "axios";
export default {
  data() {
    return {
      
      dialog: false,
      showModal: false,
      deleted: false,
      editedIndex: -1,
      editedItem: {},

      newCategory: {
        icon: "",
        CName: ""
      },
      search: "",

      reports: [],
      pagination: {
        sortBy: "CID"
      },
      selected: [],
      categoryItems: [],
      file: "",
      headers: [
        { text: "Category ID", value: "CID" },
        { text: "Category Name", value: "CName" },
        { text: "Icon Code", value: "icon" },
        { text: "Image", value: "Image" },
        { text: "Preview", value: "preview" },
        { text: "Action", value: "action" }
      ]
    };
  },

  mounted() {
    this.catItems();
  },

  methods: {
    changeSort(column) {
      if (this.pagination.sortBy === column) {
        this.pagination.descending = !this.pagination.descending;
      } else {
        this.pagination.sortBy = column;
        this.pagination.descending = false;
      }
    },

    catItems() {
      this.deleted = false;
      axios
        .get(this.$baseUrl + "/category")
        .then(response => {
          this.categoryItems = response.data.catItems;

          //console.log(this.categoryItems);
        })
        .catch(error => {
          console.log(error.response);
          console.log("ERROR");
        });
    },

    addCat() {
      const formData = new FormData();
      formData.append("file", this.file, this.file.name);

      formData.append("CName", this.newCategory.CName);
      formData.append("icon", this.newCategory.icon);
      console.log("this.newCategory.icon");

      let $Token = localStorage.getItem("token");
      axios
        .post(this.$baseUrl + "/addCat?token=" + $Token, formData)
        .then(response => {
          this.dialog = false;
          this.catItems();
        })
        .catch(error => {
          console.log(error.response);
          console.log("ERROR");
        });
    },
    getDeletedCat() {
      this.deleted = true;
      let $Token = localStorage.getItem("token");
      axios
        .get(this.$baseUrl + "/deletedCategory?token=" + $Token)
        .then(response => {
          this.categoryItems = response.data.catItems;

          //console.log(this.categoryItems);
        })
        .catch(error => {
          console.log(error.response);
          console.log("ERROR");
        });
    },

    clear() {
      this.newCategory.CName = "";
      this.newCategory.icon = "";

      this.$validator.reset();
    },

    editItem(item) {
      this.editedIndex = this.categoryItems.indexOf(item);
      this.editedItem = Object.assign({}, item);
      console.log(this.editedItem);
      this.showModal = true;
    },

    close() {
      this.showModal = false;
      setTimeout(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      }, 300);
    },

    editSave() {
       const formData = new FormData();
      formData.append("file", this.file, this.file.name);

      formData.append("CName", this.editedItem.CName);
      formData.append("icon", this.editedItem.icon);
      console.log( this.editedItem.icon);

      let $Token = localStorage.getItem("token");
   
      if (this.editedIndex > -1) {
        Object.assign(this.categoryItems[this.editedIndex], this.editedItem);

        axios
          .post(
            this.$baseUrl +
              "/editCat/" +
              this.editedItem.CID +
              "?token=" +
              $Token,
            formData
          )
          .then(response => {
            this.showModal = false;
            this.catItems();
            console.log("Succesfully Edited");
          });
      } else {
        this.categoryItems.push(this.editedItem);
      }
      this.close();
    },

    restoreItem(item) {
      this.$dialog
        .confirm("Want to restore category " + item.CID + "?", {
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
              this.$baseUrl +
                "/restoreCategory/" +
                item.CID +
                "?token=" +
                $Token
            )
            .then(response => {
              /*axios.get(item.deleteURL).then(res=>{
                            console.log(res);
                        });*/
              this.catItems();

              this.$dialog
                .alert("Succesfully Restored!", {
                  okText: "Dismiss!"
                })
                .then(function(dialog) {
                  console.log("Closed");
                });
            });

          setTimeout(() => {
            console.log("Restore action completed ");
            dialog.close();
          }, 2500);
        })
        .catch(() => {
          // Triggered when cancel button is clicked
          console.log("Delete aborted");
        });
    },
    

    selectFile(event) {
      this.file = this.$refs.file.files[0];
      console.log(this.file.name);
    },

    deleteItem(item) {
      this.$dialog
        .confirm("Delete Category " + item.CID + "?", {
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
            .post(
              this.$baseUrl + "/deleteCategory/" + item.CID + "?token=" + $Token
            )
            .then(response => {
              /*axios.get(item.deleteURL).then(res=>{
                            console.log(res);
                        });*/
              this.catItems();
              //  alert("Category succesfully Deleted");

              this.$dialog
                .alert("Category Succesfully Deleted!", {
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
    dialogOpen() {
      this.clear();
      this.dialog = true;
    }
  }
};
</script>
<style>
.v-card.v-card--flat.v-card--hover.v-sheet.theme--light {
  border: dashed;
  background: content-box;
  overflow: hidden;
  /* background-color: rgb(176, 190, 197);*/
  border-color: rgb(176, 190, 197);
  position: static;
  display: block;
  z-index: 10;
}
</style>



