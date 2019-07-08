<template>
    

<div>
<br>
  <div class="container" v-bind:style="{ background: '#B0BEC5'}">
  
  
      <v-dialog v-model="dialog" width="1200px">
        <v-card >
          <v-card-title>
            <span class="headline">Upload Category</span>
          </v-card-title>
          <v-card-text>
            <v-container >
              <form>
               

              
                <v-layout row wrap>
                  <v-flex xs12 sm5 md5>
                    <v-text-field
                      v-model="CategoryName"
                      v-validate="'required'"
                      :error-messages="errors.collect('CategoryName')"
                      label="CategoryName"
                      data-vv-name="CategoryName"
                      required
                    ></v-text-field>
                  </v-flex>

                  <v-flex xs12 sm5 md5 offset-xs0 offset-lg2>
                    <v-text-field
                    
                      v-model="IconCode"
                      v-validate="'required'"
                      :error-messages="errors.collect('IconCode')"
                      label="IconCode"
                      data-vv-name="IconCode"
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
            <v-btn outline color="blue">Save</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>

      <v-dialog v-model="showModal">
        <v-card>
          <v-card-title>
            <span class="headline">Edit Category</span>
          </v-card-title>

          <v-card-text>
            <v-container grid-list-md>
              <v-layout wrap>
                <v-flex xs12 sm6 md6>
                  <v-text-field v-model="editedItem.CID" label="CID" disabled></v-text-field>
                </v-flex>
                
                <v-flex xs12 sm6 md6>
                  <v-text-field v-model="editedItem.CName" label="Category Name"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md6>
                  <v-text-field v-model="editedItem.icon" label="Icon" ></v-text-field>

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
      <h3>Category</h3>
      
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

      <v-btn fab dark color="blue" @click="catItems">
      <v-icon dark >refresh</v-icon>
    </v-btn>
    
          <v-btn v-if="!deletedUsers" @click="getDeletedUsers">
            <v-icon large color="blue">delete_sweep</v-icon>Deleted Category
          </v-btn>

          <v-btn v-if="deletedUsers" @click="getUsers">
            <v-icon large color="blue">playlist_add_check</v-icon>Active Item
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
       </v-card>
  </div>
</div>           
</template>



<script>
import axios from 'axios'
export default {

    data(){
        return{
           dialog: false,
            showModal: false,
      editedIndex: -1,
      editedItem: {
       
        icon: "",
        CName: "",
        deleteURL: ""
      },
            search: '',
              CategoryName: '',
              IconCode: '',

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
        { text: 'Action', value: 'action' },
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

           clear () {
        
        this.CategoryName = ''
         this.IconCode = ''
       
        this.$validator.reset()
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




    }
}
</script>
