<template>
  <v-container>
    <h1>My Orders</h1>
    <br />

    <v-data-table
      v-model="selected"
      :headers="headers"
      :items="orders"
      :search="search"
      :pagination.sync="pagination"
      select-all
      item-key="OID"
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
          <td class="text-xs-left">{{ props.item.OID }}</td>
          <td class="text-xs-left">{{ props.item.role }}</td>
          <td class="text-xs-left">{{ props.item.contactNo }}</td>
          <td class="text-xs-left">{{ props.item.orderDate }}</td>
          

          <td class="justify-center layout px-0">
            <v-icon
              color="deep-purple darken-1"
              medium
              class="mr-2"
              @click="editItem(props.item)"
            >edit</v-icon>
            
            
          </td>
        </tr>
      </template>
    </v-data-table>
  </v-container>
</template>
<script>
import axios from "axios";

export default {
  data() {
    return {
      search: "",
      selected: [],
      orders: [],
      
      pagination: {
        descending: "true",
        sortBy: "orderDate"
      },

      headers: [
        { text: "Order ID", value: "OID" },
        { text: "Status", value: "status" },
        { text: "Contact No", value: "contactNo" },
        { text: "Order Date/Time", value: "orderDate" },
        { text: "Action", value: "action" },
      ]
    };
  },

  mounted() {
    this.myOrders();
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



    myOrders() {
      let $Token = localStorage.getItem("token");
      axios
        .post(this.$baseUrl + "/myOrder/" + $Token)
        .then(response => {
            this.orders=response.data.orders;
          console.log(response.data);
        })

        .catch(error => {
          console.log(error.response);

          console.log("ERROR");
        });
    }
  }
};
</script>

