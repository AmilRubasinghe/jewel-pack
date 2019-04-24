<template>
<div>
<navDrawer></navDrawer>
</br>


<div class="container">
<v-dialog v-model="dialog" max-width="600px">
      
      <v-card  max-width="600px">
        <v-card-title>
          <span class="headline">Upload File</span>
        </v-card-title>
        <v-card-text>
          

         <v-layout align-center justify-center>
                        <v-card color="blue" ripple hover height="100" width="300"  max-width="600px">
                            
                    <p>Add User</p>
                        </v-card>
            </v-layout>
            
            
            



          
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn outline color="blue"  @click="dialog = false">Close</v-btn>
           <v-btn outline color="blue" >Save</v-btn>
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
                  <v-text-field v-model="editedItem.ID" label="ID" disabled></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.role" label="Role" ></v-text-field>
                </v-flex>
                   <v-flex xs12 sm6 md4 d-flex>
                    <v-select
                    
                      :items="roles"
                      label="Roles"
                      outline
                      menu-props
                       v-model="editedItem.role"
                    ></v-select>
                  </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.firstName" label="First Name" ></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.lastName" label="Last Name" ></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.contactNo" label="Contact No" ></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.email" label="Email" ></v-text-field>
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
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" flat @click="close">Cancel</v-btn>
            <v-btn color="blue darken-1" flat @click="save">Save</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>


















<div>
    
    <v-toolbar flat color="white">
      <v-toolbar-title>Users</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-btn   @click="dialog = true">
          <v-icon large color="blue">add_box</v-icon>
          Add User
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
          >
            edit
          </v-icon>
          <v-icon
          color="red"
            medium
            @click="deleteItem(props.item)"
          >
            delete
          </v-icon>
        </td>
      </tr>
            
    </template>
  </v-data-table>
</div>           
</div>
</div>
</template>

<script>
import axios from 'axios'
import navDrawer from '../admin/navDrawer.vue';
  export default {      
    data(){
        return{
            dialog: false,
            showModal:false,
             editedIndex: -1,
            editedItem: {
                imageID: 0,
                size: 0,
                image: '',
                ext: '',
                deleteURL: '',
            },
            
            roles:['user','admin','editor'],
            emailVerifyItems:[1,0],

            defaultItem: {
                imageID: 0,
                size: 0,
                image: '',
                ext: '',
                deleteURL: ''
            },

            
            file: "",

             search: '',
             users:[],
            pagination: {
            sortBy: 'ID',
            },
            selected: [],

         headers: [
        { text: 'ID', value: 'ID' },
        { text: 'Role', value: 'role' },
        { text: 'First Name', value: 'firstName' },
        { text: 'Last Name', value: 'lastName' },
        { text: 'Contact No', value: 'contactNo' },
        { text: 'Email', value: 'email' },
        { text: 'Email Verified', value: 'emailVerified' },
        { text: 'Action', value: 'action' },
      ],
        }
        
    },

    
    mounted(){
      this.getUsers();
    },

    components:{
        navDrawer
    },

    computed: {
      pages () {
        if (this.pagination.rowsPerPage == null ||
          this.pagination.totalItems == null
        ) return 0

        return Math.ceil(this.pagination.totalItems / this.pagination.rowsPerPage)
      }
    },

    methods:{

            getUsers(){
              axios.post('http://localhost:8000/api/users')
                  .then(response => {
                    
                    
                      this.users=response.data.users;

                      //console.log(this.slideshowItems);

                      
                      
                  })
                  .catch(error => {
                      console.log(error.response);
                      console.log("ERROR");
                  })
          },

          changeSort (column) {
                if (this.pagination.sortBy === column) {
                this.pagination.descending = !this.pagination.descending
                } else {
                this.pagination.sortBy = column
                this.pagination.descending = false
                }
          },


          close () {
            this.showModal = false
            setTimeout(() => {
            this.editedItem = Object.assign({}, this.defaultItem)
            this.editedIndex = -1
            }, 300)
        },

        editItem (item) {
            this.editedIndex = this.users.indexOf(item)
            this.editedItem = Object.assign({}, item)
            console.log(this.editedItem);
            this.showModal = true
        },

        deleteItem (item) {
            
            var result = confirm("Want to delete?");
            if (result) {
                //Logic to delete the item
                console.log(item.imageID)
                axios.post('http://localhost:8000/api/deleteSlideshow/'+item.imageID)
                    .then(response => {
                        /*axios.get(item.deleteURL).then(res=>{
                            console.log(res);
                        });*/
                        this.getSlideshow();
                        alert("Succesfully Deleted");
                    });
            }
        },
          save(){


                if (this.editedIndex > -1) {
                    Object.assign(this.slideshowItems[this.editedIndex], this.editedItem)
                    console.log("*******************");
                    console.log(this.editedItem);

                    axios.post('http://localhost:8000/api/edititems/'+this.editedItem.imageID,this.editedItem)
                    .then(response => {
                        this.showModal=false
                        this.getSlideshow();
                        console.log("Succesfully Edited");
                    });

                 } else {
                    this.slideshowItems.push(this.editedItem)
                 }
                    this.close()
            
            },


          
          },
  

  
  }
</script>