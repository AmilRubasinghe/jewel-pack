<template>
  <div>
    <navDrawer></navDrawer>
    <br>

    <div class="container" v-bind:style="{ background: '#B0BEC5'}" >
      <v-dialog v-model="dialog" width="1200px">
        <v-card >
          <v-card-title>
            <span class="headline">Upload Form</span>
          </v-card-title>
          <v-card-text>
            <v-container >
              <form>
                <v-layout row wrap >
                  <v-flex xs12 sm5 md5>
                      <v-text-field
                      v-model="newProduct.size"
                      v-validate="'required'"
                      :error-messages="errors.collect('size')"
                      label="Size"
                      data-vv-name="Size"
                      required
                    ></v-text-field>
                   
                  </v-flex>
      

                  <v-flex xs12 sm5 md5 offset-xs0 offset-lg2>
                    <v-text-field
                      v-model="newProduct.colour"
                      v-validate="'required'"
                      :error-messages="errors.collect('colour')"
                      label="Colour"
                      data-vv-name="Colour"
                      required
                    ></v-text-field>
                   
                  </v-flex>
                </v-layout>

              
                <v-layout row wrap>
                  <v-flex xs12 sm5 md5>
                    <v-text-field
                      v-model="newProduct.quantity"
                      v-validate="'required'"
                      :error-messages="errors.collect('quantity')"
                      label="Quantity"
                      data-vv-name="Quantity"
                      required
                    ></v-text-field>
                  </v-flex>

                  <v-flex xs12 sm5 md5 offset-xs0 offset-lg2>
                    <v-text-field
                    input-type="number"
                      v-model="newProduct.price"
                      v-validate="'required'"
                      :error-messages="errors.collect('price')"
                      label="Price"
                      data-vv-name="Price"
                      required
                    ></v-text-field>
                  </v-flex>
                </v-layout>

              <v-layout row wrap>
                <v-flex xs12 sm5 md5>
                <v-checkbox
                  v-model="newProduct.border"
                  v-validate="'required'"
                  :error-messages="errors.collect('checkbox')"
                  value="1"
                  label="Is border"
                  data-vv-name="checkbox"
                  type="checkbox"
                  required
                ></v-checkbox>
                  </v-flex>

                  <v-flex xs12 sm5 md5 offset-xs0 offset-lg2>
          <v-text-field
            label="Details"
            v-model="Details"
            v-validate="'required'"
            :error-messages="errors.collect('text box')"
            single-line
            solo
             required
          ></v-text-field>
        </v-flex>

                
               </v-layout>

             <!--  <v-flex xs12 class="text-xs-center text-sm-center text-md-center text-lg-center">
				
          <label class="button" label="Select Image" @click='pickFile'  prepend-icon='attach_file' >
					<input
						type="file"
						style="display: none"
						ref="image"
						accept="image/*"
						@change="onFilePicked"
					>
           <v-icon outline large>cloud_upload</v-icon>
                                    <h4>Upload photo</h4>
                                   
                            </label>
                            	</v-flex>-->
                            <v-flex xs12 class="text-xs-center text-sm-center text-md-center text-lg-center">
					<img :src="imageUrl" height="150" v-if="imageUrl"/>
					<v-text-field label="Upload Image" @click='pickFile' v-model='imageName' prepend-icon='attach_file'></v-text-field>
					<input
						type="file"
						style="display: none"
						ref="image"
						accept="image/*"
						@change="onFilePicked"
					>
				</v-flex>
			
          
              
              
              </form>
            </v-container>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn @click="clear">clear</v-btn>
            <v-btn outline color="blue" @click="dialog = false">Close</v-btn>
            <v-btn outline color="blue" @click="addProduct">Save</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>

      <v-dialog v-model="showModal">
        <v-card>
          <v-card-title>
            <span class="headline">Edit Product</span>
          </v-card-title>

          <v-card-text>
            <v-container grid-list-md>
              <v-layout wrap>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.PID" label="PID" disabled></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4 d-flex>
                  <v-select
                    :items="sizes"
                    label="Size"
                    outline
                    menu-props
                    v-model="editedItem.Size"
                  ></v-select>
                </v-flex>
                
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.Quantity" label="Quantity" disabled></v-text-field>

                </v-flex>
                 

                <v-flex xs12 sm6 md4>
                     <v-select
                    :items="colours"
                    label="Colour"
                    outline
                    menu-props
                    v-model="editedItem.Colour"
                  ></v-select>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.Price" label="Price"></v-text-field>
                </v-flex>
               <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.unitWeight" label="unit Weight"></v-text-field>
                </v-flex>
              </v-layout>



              <v-flex xs12 sm6 offset-sm4>
                  
                  
                      
                         <v-img height="165" width="350"  max-width="260px" :src="editedItem.Image"></v-img>      
                        
                          
                        
                        <v-card flat color=#B0BEC5 @click="$refs.file.click()" ripple hover height="70" width="260"  max-width="600px">
                          
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
                        
                       </v-flex> 
                        
            


                        
                        
                
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
          <v-toolbar-title>{{table_title}}</v-toolbar-title>
          <v-spacer></v-spacer>

          <v-text-field
            v-model="search"
            append-icon="search"
            label="Search"
            single-line
            hide-details
          ></v-text-field>
  
          <v-btn  fab dark  color="blue" @click="openDialogProduct">
            <v-icon  dark>add</v-icon>
          </v-btn>

          <v-btn  fab dark color="blue" @click=" productItems ">
            <v-icon medium dark>refresh</v-icon>
          </v-btn>

        <!--  <v-btn v-if="!deletedItem" >
            <v-icon large color="blue">delete_sweep</v-icon>Deleted item
          </v-btn>

          <v-btn v-if="deletedItem" >
            <v-icon large color="blue">playlist_add_check</v-icon>Active Item
          </v-btn>-->
        </v-toolbar>

        <v-data-table
          v-model="selected"
          :headers="headers"
          :items="products"
          :search="search"
          :pagination.sync="pagination"
          select-all
          item-key="ID"
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
              <td class="text-xs-center">{{ props.item.PID }}</td>
              <td class="text-xs-center">{{ props.item.Size }}</td>
              <td class="text-xs-left">{{ props.item.Image}}</td>
               <td class="text-xs-left"><v-img :src="props.item.Image"></v-img></td>
              <td class="text-xs-center">{{ props.item.Quantity}}</td>
              <td class="text-xs-center">{{ props.item.Colour }}</td>
              <td class="text-xs-center">{{ props.item.Price }}</td>
              <td class="text-xs-center">{{ props.item.unitWeight }}</td>
              

              <td class="justify-center layout px-0">
                <v-icon
                  color="deep-purple darken-1"
                  medium
                  class="mr-2"
                  @click="editItem(props.item)"
                >edit</v-icon>
               <!-- <v-icon
                  v-if="!deletedItem"
                  color="red"
                  medium
                  @click="deleteItem(props.item)"
                >delete</v-icon>
                <v-icon
                  v-if="deletedItem"
                  color="green"
                  medium
                  @click="restoreItem(props.item)"
                >restore_from_trash</v-icon>-->
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
      dialog: false,
      showModal: false,
      editedIndex: -1,
      imageName: '',
		imageUrl: '',
		imageFile: '',
      

        editedItem: {
          imageID: 0,
          size: 0,
          image: "",
          ext: "",
          deleteURL: "",
          title: "Image Upload",
        },

       quantity:'',
       Details:'',
      price:'',
      size:'',
      colour:'',

      newProduct:{
        quantity: '',
       details:'',
      price: '',
      size:'',
      colour:'',
      border:null,

      },

      sizes: ["2x2", "3x3", "4x4", "5x5"],

      colours: ["White", "Black"],

      
      

      defaultItem: {
        imageID: 0,
       // size: 0,
        image: "",
        ext: "",
        deleteURL: ""
      },

      file: "",

      search: "",
      products: [],
      pagination: {
        sortBy: "PID"
      },
      selected: [],
     
      table_title: "Product Items",

      headers: [
        { text: "PID", value: "PID" },
        { text: "Size", value: "Size" },
        { text: "Image", value: "Image" },
        { text: 'Preview', value: 'preview' },
        { text: "Quantity", value: "Quantity" },
        { text: "Colour", value: "Colour" },
        { text: "Price", value: "Price" },
        { text: "unitWeight", value: "unitWeight" },
        { text: "Action", value: "action" }
      ]
    };
  },

  mounted() {
    this.productItems();
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

    addProduct(){


               this.table_title="Active Product",
              this.deletedItem=false;

              let $Token=localStorage.getItem('token');


              
                
                    axios.post('http://localhost:8000/api/addProduct?token='+$Token,this.newProduct)
                    .then(response => {
                        this.dialog=false;
                        this.productItems();
                        console.log("Product Succesfully Added");
                    })
                     .catch(error => {
                      console.log(error.response);
                      console.log("ERROR");
                  })

                 

    },
    


      productItems() {
      axios
        .get("http://localhost:8000/api/product")
        .then(response => {
          this.products = response.data.product;

          console.log(this.products);
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
      this.editedIndex = this.products.indexOf(item);
      this.editedItem = Object.assign({}, item);
      console.log(this.editedItem);
      this.showModal = true;
    },

    /*  deleteItem(item) {
      var result = confirm("Want to delete " + item.firstName + "?");
      if (result) {
        //Logic to delete the item
        let $Token = localStorage.getItem("token");
        axios
          .post(
            "http://localhost:8000/api/deleteUser/" +
              item.ID +
              "?token=" +
              $Token
          )
          .then(response => {
            /*axios.get(item.deleteURL).then(res=>{
                            console.log(res);
                        });
            this.getUsers();
            alert("Succesfully Deleted");
          });
      }
    },*/

    
    
      clear () {
        this.newProduct.size= ''
        this.newProduct.colour =''
        this.newProduct.quantity = ''
         this.newProduct.price= ''
        this.newProduct.border= false
        this.Details=''
      
      },

 pickFile () {
            this.$refs.image.click ()
        },
		
		onFilePicked (e) {
			const files = e.target.files
			if(files[0] !== undefined) {
				this.imageName = files[0].name
				if(this.imageName.lastIndexOf('.') <= 0) {
					return
				}
				const fr = new FileReader ()
				fr.readAsDataURL(files[0])
				fr.addEventListener('load', () => {
					this.imageUrl = fr.result
					this.imageFile = files[0] // this is an image file that can be sent to server...
        })
        

			} else {
				this.imageName = ''
				this.imageFile = ''
				this.imageUrl = ''
			}
    },
    
   openDialogProduct(){
     this.newProduct.size= ''
        this.newProduct.colour =''
        this.newProduct.quantity = ''
         this.newProduct.price= ''
        this.newProduct.border= false
        this.Details=''
        this.dialog= true


   },

    save(){

    },

  /* editItem(item){
      var result = confirm("Want to delete "+item.firstName+"?");
            if (result) {
                //Logic to delete the item
                let $Token=localStorage.getItem('token');
                axios.post('http://localhost:8000/api/deleteUser/'+item.ID+'?token='+$Token)
                    .then(response => {
                        /*axios.get(item.deleteURL).then(res=>{
                            console.log(res);
                        });
                        this.getUsers();
                        alert("Succesfully Deleted");
                    });
            }

   },*/

   deleteItem(item){

   },
   restoreItem(item){

   },

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

  }
};

</script>
<style>
.v-responsive {
   
    margin-bottom: 7px;
}
</style>







