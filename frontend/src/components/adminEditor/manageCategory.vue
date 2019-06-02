<template>
    

<div>
</br>
  <div class="container" v-bind:style="{ background: '#B0BEC5'}">
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
        
  

      <v-btn fab dark color="blue" @click="catItems">
      <v-icon dark >refresh</v-icon>
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
      <tr align='left'>
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
      <v-alert :value="true" color="error" icon="warning">
        Sorry, nothing to display here :(
      </v-alert>
    </template>
    <template v-slot:items="props">
      <tr :active="props.selected" @click="props.selected = !props.selected">
        
        <td class="text-xs-left">{{ props.item.CID }}</td>
        <td class="text-xs-left">{{ props.item.CName }}</td>
        <td class="text-xs-left">{{ props.item.icon }}</td>
        <td class="text-xs-left">{{ props.item.Images }}</td>
      </tr>
            
    </template>
  </v-data-table>
       </v-card>
  </div>
</div>           
</template>



<script>
import axios from 'axios'
export default {

    data(){
        return{
            search: '',
            reports: [],
            pagination: {
            sortBy: 'CID',
            },
            selected: [],
         categoryItems: [],

         headers: [
        { text: 'Category ID', value: 'CID' },
        { text: 'Category Name', value: 'CName' },
        { text: 'Icon Code', value: 'icon' },
        { text: 'Image', value: 'Image' },
      ],
        }
     
    },

    

   mounted(){
            this.catItems();
            
   },
    

    methods:{


         changeSort (column) {
              if (this.pagination.sortBy === column) {
                this.pagination.descending = !this.pagination.descending
              } else {
                this.pagination.sortBy = column
                this.pagination.descending = false
              }
          },
        
        catItems(){
              axios.get('http://localhost:8000/api/category')
                  .then(response => {
                    
                    
                      this.categoryItems=response.data.catItems;

                      //console.log(this.categoryItems);
                      
                      
                  })
                  .catch(error => {
                      console.log(error.response);
                      console.log("ERROR");
                  })
          },
    }
}
</script>
