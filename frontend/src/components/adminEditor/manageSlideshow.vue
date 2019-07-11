<template>
<div >
<navDrawer v-model="drawer"></navDrawer>
</br>

<div class="container" v-bind:style="{ background: '#B0BEC5'}">
<v-dialog v-model="dialog" max-width="600px">
      
      <v-card  max-width="600px">
        <v-card-title>
          <span class="headline">Upload File</span>
        </v-card-title>
        <v-card-text>
          

         <v-layout align-center justify-center>
                        <v-card flat color=#B0BEC5 @click="$refs.file.click()" ripple hover height="100" width="300"  max-width="600px">
                            
                        <form enctype="multipart/form-data">
                        <div class="text-xs-center">
                            
                        

                            <label class="button"  >
                                    <input 
                                    type="file"
                                    ref="file"
                                    @change="selectFile"
                                    style="display:none"
                                    >
                                    <v-icon outline large>cloud_upload</v-icon>
                                    <h4>Upload photo</h4>
                                    <span v-if="file" class="file-name">{{file.name}}</span>
                            </label>
                        </div>
                        
                        </form>
                        </v-card>
            </v-layout>

            
            
            
            



          
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn outline color="blue"  @click="dialog = false">Close</v-btn>
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
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.size" label="Image Size (Bytes)" ></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.image" label="Image URL"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.ext" label="Extention"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.deleteURL" label="Delete URL"></v-text-field>
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
      <v-btn fab dark color="blue"  @click="dialog = true">
      <v-icon dark >add</v-icon>
      </v-btn>

      <v-btn fab dark color="blue" @click="getSlideshow">
      <v-icon dark >refresh</v-icon>
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
        <td class="text-xs-left">{{ props.item.imageID }}</td>
        <td class="text-xs-left">{{ props.item.size }}</td>
        <td class="text-xs-left">{{ props.item.image }}</td>
        <td class="text-xs-left"><v-img :src="props.item.image"></v-img></td>
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
          drawer:false,
            dialog: false,
            showModal:false,
             editedIndex: -1,
            editedItem: {
                imageID: 0,
                size: 0,
                image: '',
                ext: '',
                deleteURL: ''
            },
            defaultItem: {
                imageID: 0,
                size: 0,
                image: '',
                ext: '',
                deleteURL: ''
            },

            
            file: "",

             search: '',
             slideshowItems:[],
            pagination: {
            sortBy: 'imageID',
            },
            selected: [],

         headers: [
        { text: 'Image ID', value: 'imageID' },
        { text: 'Image Size (Bytes)', value: 'size' },
        { text: 'Image URL', value: 'image' },
        { text: 'Preview', value: 'preview' },
        { text: 'Actions', value: 'name', sortable: false }
      ],
        }
        
    },

    
    mounted(){
      this.getSlideshow();
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
        selectFile(event){
            this.file= this.$refs.file.files[0];
        },

        sendFile(){
            const formData = new FormData();
            formData.append('file',this.file,this.file.name);

                let $Token=localStorage.getItem('token');

                  axios.post('https://vgy.me/upload?userkey=Kpx6WS9lOl8dx3rU9pDrOasKbkUOlpGs', formData)
                  .then(response => {
                      console.log(response)
                    console.log(response.data.image) 
                                axios.post('http://localhost:8000/api/storeImage'+'?token='+$Token,response.data)
                                .then(response => {
                                    this.dialog = false;
                                    this.file="";
                                    this.getSlideshow();
                                    alert("Succesfully Saved");
                                        
                                        
                                    })
                                .catch(error => {
                                        console.log(error.response);
                                        console.log("Failed Save img url");
                                })                 
                    })
                    .catch(error => {
                        console.log(error.response);
                        console.log("Upload Failed");
                    })
                            
                    },
                  

            getSlideshow(){
              axios.get('http://localhost:8000/api/getImages')
                  .then(response => {
                    
                    
                      this.slideshowItems=response.data.images;

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
            this.editedIndex = this.slideshowItems.indexOf(item)
            this.editedItem = Object.assign({}, item)
            console.log(this.editedItem);
            this.showModal = true
        },

        deleteItem (item) {
            
            var result = confirm("Want to delete?");
            if (result) {
              let $Token=localStorage.getItem('token');
                //console.log(item.imageID)
                axios.post('http://localhost:8000/api/deleteSlideshow/'+item.imageID+'?token='+$Token)
                    .then(response => {
                        /*axios.get(item.deleteURL).then(res=>{
                            console.log(res);
                        });*/
                        this.getSlideshow();
                        alert("Succesfully Deleted");
                    });
            }
        },

        editSave(){

              let $Token=localStorage.getItem('token');
                if (this.editedIndex > -1) {
                    Object.assign(this.slideshowItems[this.editedIndex], this.editedItem)
                    console.log("*******************");
                    console.log(this.editedItem);

                    axios.post('http://localhost:8000/api/edititems/'+this.editedItem.imageID+'?token='+$Token,this.editedItem)
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