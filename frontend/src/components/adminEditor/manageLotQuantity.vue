<template>
  <div>
    <br>
    <div class="container" v-bind:style="{ background: '#B0BEC5'}">
      <v-dialog v-model="dialog" width="1200px">
        <v-card>
          <v-card-title>
            <span class="headline">Upload LotQuantity</span>
          </v-card-title>
          <v-card-text>
            <v-container>
              <form>
                <v-layout row wrap>
                  <v-flex xs12 sm5 md5>
                    <v-text-field
                      v-model="LotValue"
                      v-validate="'required'"
                      :error-messages="errors.collect('LotValue')"
                      label="Lot Value"
                      data-vv-name="LotValue"
                      required
                    ></v-text-field>
                  </v-flex>

                  <v-flex xs12 sm5 md5 offset-xs0 offset-lg1>
                    <v-text-field
                      v-model="LotCode"
                      v-validate="'required'"
                      :error-messages="errors.collect('LotCode')"
                      label="LotCode"
                      data-vv-name="LotCode"
                      required
                    ></v-text-field>
                  </v-flex>
                </v-layout>
              </form>
            </v-container>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn @click="clear">clear</v-btn>
            <v-btn outline color="blue" @click="dialog = false">Close</v-btn>
            <v-btn outline color="blue" @click="Save">Save</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>

      <v-dialog v-model="showModal">
        <v-card>
          <v-card-title>
            <span class="headline">Edit LotQuantity</span>
          </v-card-title>

          <v-card-text>
            <v-container grid-list-md>
              <v-layout wrap>
                <v-flex xs12 sm6 md6>
                  <v-text-field v-model="editedItem.LID" label="LID" disabled></v-text-field>
                </v-flex>

                <v-flex xs12 sm6 md6>
                  <v-text-field v-model="editedItem.LotValue" label="Lot Value"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md6>
                  <v-text-field v-model="editedItem.LotCode" label="LotCode"></v-text-field>
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

      <v-card>
        <v-card-title>
          <h3>Lot Quantity</h3>

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

          <v-btn fab dark color="blue" @click="lotItems">
            <v-icon dark>refresh</v-icon>
          </v-btn>

          <v-btn v-if="!deletedUsers" @click="getDeletedUsers">
            <v-icon large color="blue">delete_sweep</v-icon>Deleted Lot Item
          </v-btn>

          <v-btn v-if="deletedUsers" @click="getUsers">
            <v-icon large color="blue">playlist_add_check</v-icon>Active Lot Item
          </v-btn>
        </v-card-title>
        <v-data-table
          v-model="selected"
          :headers="headers"
          :items="LotItems"
          :search="search"
          :pagination.sync="pagination"
          select-all
          item-key="LID"
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
              <td class="text-xs-left">{{ props.item.LID }}</td>
              <td class="text-xs-left">{{ props.item.LotValue }}</td>
              <td class="text-xs-left">{{ props.item.icon }}</td>
              
              <td class="justify-center layout px-0">
                <v-icon
                  color="deep-purple darken-1"
                  medium
                  class="mr-2"
                  @click="editLotItem(props.item)"
                >edit</v-icon>
                <v-icon
                  v-if="!deletedUsers"
                  color="red"
                  medium
                  @click="deleteLotItem(props.item)"
                >delete</v-icon>
                <v-icon
                  v-if="deletedUsers"
                  color="green"
                  medium
                  @click="restoreLotItem(props.item)"
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
      editedIndex: -1,
      editedItem: {
        LotValue: "",
        LotCode: "",

        
      },
      search: "",
     LotValue: "",
      LotCode: "",

    
      pagination: {
        sortBy: "LID"
      },
      selected: [],
      LotItems: [],

      headers: [
        { text: "Lot ID", value: "LID" },
        { text: "Lot value", value: "LotValue" },
        { text: "Lot Code", value: "LotCode" },
      
        { text: "Action", value: "action" }
      ]
    };
  },

  mounted() {
    this.lotItems();
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




    lotItems() {
      axios
        .get("http://localhost:8000/api/category")
        .then(response => {
          this.categoryItems = response.data.catItems;

          //console.log(this.categoryItems);
        })
        .catch(error => {
          console.log(error.response);
          console.log("ERROR");
        });
    },

   

    editLotItem(item) {
      this.editedIndex = this.categoryItems.indexOf(item);
      this.editedItem = Object.assign({}, item);
      console.log(this.editedItem);
      this.showModal = true;
    },

    deleteLotItem(item){


    },

    restoreLotItem(){



    },
    Save(){

        
    },

    close() {
      this.showModal = false;
      setTimeout(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      }, 300);
    },
    dialogOpen(){
       this.clear();
        this.dialog = true;
    },
     clear() {
      this.LotValue = "";
      this.LotCode = "";

      this.$validator.reset();
    },
  }
};
</script>



