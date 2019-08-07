<template>
  <div>
    <br />
    <div class="container 1" v-bind:style="{ background: '#B0BEC5'}">
      <v-dialog v-model="dialog" max-width="700">
        <v-card>
          <v-card-title>
            <span class="headline">Upload Shipping Methods</span>
          </v-card-title>

          <v-card-text>
            <v-container grid-list-md text-md-center fluid fill-height>
              <v-layout column>
                <v-flex md3 sm8 lg3 xs8 d-flex>
                  <v-text-field
                    v-model="newItem.method"
                    v-validate="'required'"
                    :error-messages="errors.collect('method')"
                    label="Methods"
                    data-vv-name="method"
                    required
                  />
                </v-flex>

                <v-flex md3 sm8 lg3 xs8 d-flex>
                  <v-text-field
                    v-model="newItem.flatRate"
                    v-validate="'required'"
                    :error-messages="errors.collect('flat Rate')"
                    label="Flat Rate"
                    data-vv-name="flatRate"
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
                  <v-btn color="primary" @click="clear">clear</v-btn>
                </v-flex>

                <v-flex d-flex>
                  <v-btn outline color="primary" @click="dialog = false">Close</v-btn>
                </v-flex>
                <v-flex d-flex>
                  <v-btn outline color="blue" @click="Save">Save</v-btn>
                </v-flex>
              </v-layout>
            </v-container>
          </v-card-actions>
        </v-card>
      </v-dialog>

      <v-dialog v-model="showModal" max-width="700">
        <v-card>
          <v-card-title>
            <span class="headline">Edit Shopping Method</span>
          </v-card-title>

          <v-card-text>
            <v-container grid-list-md text-md-center fluid fill-height>
              <v-layout column>
                <v-flex md3 sm12 lg3 xs12 d-flex>
                  <v-text-field v-model="editedItem.shipId" label="Ship Id" disabled />
                </v-flex>

                <v-flex md3 sm12 lg3 xs12 d-flex>
                  <v-select
                    label="Shipping Method"
                    :items="ShippingMethodItems"
                    item-text="shipMethod"
                    item-value="ShipId"
                    v-model="editedItem.shipMethod"
                    outline
                    menu-props
                  ></v-select>
                </v-flex>

                <v-flex md3 sm12 lg3 xs12 d-flex>
                  <v-text-field
                    v-model="editedItem.flatRate"
                    label="Flat rate"
                    type="number"
                    onkeydown="javascript: return event.keyCode == 69 ? false : true"
                  ></v-text-field>
                </v-flex>
              </v-layout>
            </v-container>
          </v-card-text>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-container grid-list-md text-md-center fluid fill-height>
              <v-layout row wrap justify-end>
                <v-flex md6 sm4 lg6 xs4 d-flex>
                  <v-btn color="primary" @click="close">Cancel</v-btn>
                </v-flex>

                <v-flex md6 sm4 lg6 xs4 d-flex>
                  <v-btn color="primary" @click="editSave">Save</v-btn>
                </v-flex>
              </v-layout>
            </v-container>
          </v-card-actions>
        </v-card>
      </v-dialog>

      <v-card>
        <v-card-title>
          <h3>Shipping Method</h3>

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

          <v-btn fab dark color="blue" @click=" methodItems">
            <v-icon dark>refresh</v-icon>
          </v-btn>
        </v-card-title>
        <v-data-table
          v-model="selected"
          :headers="headers"
          :items=" ShippingMethodItems"
          :search="search"
          :pagination.sync="pagination"
          select-all
          item-key="shipId"
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
              <td class="text-xs-center">{{ props.item.shipId }}</td>
              <td class="text-xs-center">{{ props.item.shipMethod }}</td>
              <td class="text-xs-center">{{ props.item.flatRate }}</td>
              <td class="justify-center layout px-0">
                <v-icon
                  color="deep-purple darken-1"
                  medium
                  class="mr-2"
                  @click="editItem(props.item)"
                >edit</v-icon>
                <v-icon color="red" medium @click="deleteShippingMethod(props.item)">delete</v-icon>
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
       editedIndex: -1,

      search: "",

      newItem: {
        method: "",
        shipId: 0,
        flatRate: ""
      },
      editedItem: {
        shipMethod: "",
        shipId: 0,
        flatRate: ""
      },

      pagination: {
        sortBy: "shipId"
      },
      selected: [],
      ShippingMethodItems: [],

      headers: [
        { text: "Ship ID", value: "shipId" },
        { text: "Ship Method", value: "shipMethod" },
        { text: "Flat rate", value: "flatRate" },

        { text: "Action", value: "action" }
      ]
    };
  },

  mounted() {
    this.methodItems();
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

    methodItems() {
      axios
        .get("http://localhost:8000/api/getMethod")
        .then(response => {
          this.ShippingMethodItems = response.data.methodItems;

          //console.log(this.categoryItems);
        })
        .catch(error => {
          console.log(error.response);
          console.log("ERROR");
        });
    },

    editItem(item) {
       this.editedIndex = this.ShippingMethodItems.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.showModal = true;
    },

    deleteShippingMethod(item) {
      var result = confirm(
        "Want to delete Shipping Method " + item.shipId + "?"
      );
      if (result) {
        //Logic to delete the item
        let $Token = localStorage.getItem("token");
        axios
          .post(
            "http://localhost:8000/api/deleteShipping/" +
              item.shipId +
              "?token=" +
              $Token
          )
          .then(response => {
            this.methodItems();
            alert("Shipping Method succesfully Deleted");
          });
      }
    },

    Save() {
      let $Token = localStorage.getItem("token");

      axios
        .post(
          "http://localhost:8000/api/addMethod?token=" + $Token,
          this.newItem
        )

        .then(response => {
          this.dialog = false;
          this.methodItems();

          console.log("Shipping Method Succesfully Added");
        })
        .catch(error => {
          console.log(error.response);
          console.log("ERROR");
        });
    },

    close() {
      this.showModal = false;
      setTimeout(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      }, 300);
    },
    dialogOpen() {
      this.clear();
      this.dialog = true;
    },
    clear() {
      this.newItem.method = "";
      this.newItem.flatRate = "";
    },

     editSave() {
      let $Token = localStorage.getItem("token");
      if (this.editedIndex > -1) {
        Object.assign(this.ShippingMethodItems[this.editedIndex], this.editedItem);

        axios
          .post(
            "http://localhost:8000/api/editShippingMethod/" +
              this.editedItem.shipId +
              "?token=" +
              $Token,
            this.editedItem
          )
          .then(response => {
            this.showModal = false;
            this.methodItems();
            console.log("Succesfully Edited");
          });
      } else {
        this.ShippingMethodItems.push(this.editedItem);
      }
      this.close();
    },
  }
};
</script>