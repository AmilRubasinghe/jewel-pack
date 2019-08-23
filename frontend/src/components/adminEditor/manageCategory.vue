<template>
  <div>
    <br />
    
  
   <div class="container" v-bind:style="{ background: '#B0BEC5'}">
     <v-dialog v-model="dialog" max-width=700>
            <v-card>
              <v-card-title>
                <span class="headline">Add category</span>
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
                      required />
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
                    </v-layout>
                </v-container>
              </v-card-text>

              <v-card-actions>
                <v-spacer></v-spacer>
<v-container grid-list-md text-md-center fluid fill-height>
      <v-layout row wrap>
        <v-flex d-flex>
          <v-btn outline color="primary" @click="clear">clear</v-btn>
        
        </v-flex>

        <v-flex d-flex>
         <v-btn  dark color="blue" @click="dialog = false">Close</v-btn>
        </v-flex>
         <v-flex d-flex>
          <v-btn  dark color="blue" @click="addCat">Save</v-btn>
        </v-flex>
        </v-layout>
        </v-container>
               
              </v-card-actions>
            </v-card>
          </v-dialog>

   
      
      <v-dialog v-model="showModal" max-width=700>
            <v-card>
              <v-card-title>
                <span class="headline">Edit Category</span>
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

                  
                     </v-layout>
                </v-container>
              </v-card-text>

              <v-card-actions>
                <v-spacer></v-spacer>
<v-container grid-list-md text-md-center fluid fill-height>
     
      <v-layout row wrap>
        <v-flex d-flex >
         <v-btn dark color="blue"  @click="close">Cancel</v-btn>
        </v-flex>

        <v-flex d-flex >
           <v-btn  dark color="blue"  @click="editSave">Save</v-btn>
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
              <td class="text-xs-center">{{ props.item.Images }}</td>
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

      headers: [
        { text: "Category ID", value: "CID" },
        { text: "Category Name", value: "CName" },
        { text: "Icon Code", value: "icon" },
        { text: "Image", value: "Image" },
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
      this.deleted=false;
      axios
        .get(this.$baseUrl+"/category")
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
      let $Token = localStorage.getItem("token");
      axios
        .post(
          this.$baseUrl+"/addCat?token=" + $Token,
          this.newCategory
        )
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
      this.deleted=true;
      let $Token = localStorage.getItem("token");
      axios
        .get(this.$baseUrl+"/deletedCategory?token="+$Token)
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
      let $Token = localStorage.getItem("token");
      if (this.editedIndex > -1) {
        Object.assign(this.categoryItems[this.editedIndex], this.editedItem);

        axios
          .post(
            this.$baseUrl+"/editCat/" +
              this.editedItem.CID +
              "?token=" +
              $Token,
            this.editedItem
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
      var result = confirm("Want to restore " + item.CID + "?");
      if (result) {
        //Logic to delete the item
        let $Token = localStorage.getItem("token");
        axios
          .post(
            this.$baseUrl+"/restoreCategory/" +
              item.CID +
              "?token=" +
              $Token
          )
          .then(response => {
            /*axios.get(item.deleteURL).then(res=>{
                            console.log(res);
                        });*/
            this.catItems();
            alert("Succesfully Restored");
          });
      }
    },

    deleteItem(item) {
      var result = confirm("Want to delete Category" + item.CID + "?");
      if (result) {
        //Logic to delete the item
        let $Token = localStorage.getItem("token");
        axios
          .post(
            this.$baseUrl+"/deleteCategory/" +
              item.CID +
              "?token=" +
              $Token
          )
          .then(response => {
            /*axios.get(item.deleteURL).then(res=>{
                            console.log(res);
                        });*/
            this.catItems();
            alert("Category succesfully Deleted");
          });
      }
    },
    dialogOpen(){
      this.clear();
    this.dialog = true;
    },
  }
};
</script>



