<!--<template>
  <div>
    <navDrawer></navDrawer>
    <br />

    <div class="container" v-bind:style="{ background: '#B0BEC5'}">
         <v-dialog v-model="dialog" max-width=900>
            <v-card>
              <v-card-title>
                <span class="headline">Upload Form</span>
              </v-card-title>

              <v-card-text>
                <v-container grid-list-md text-md-center fluid fill-height>
                  <v-layout column>
                    <v-flex d-flex >
                    <v-layout row wrap>
                
                    <v-flex md6 sm12 lg6 xs12 d-flex>
                      <v-text-field 
                    v-model="newProduct.size"
                    v-validate="'required'"
                    :error-messages="errors.collect('size')"
                    label="Size"
                    data-vv-name="Size"
                    required/>
                    </v-flex>

                    <v-flex md6 sm12 lg6 xs12 d-flex>
                       <v-select
                    label="Category"
                    :items="category"
                    item-text="CName"
                    item-value="CID"
                    v-model="newProduct.cid"
                    outline
                    menu-props
                  ></v-select>
                    </v-flex>
                   </v-layout>
                    </v-flex>  

                    <v-flex d-flex >
                    <v-layout row wrap>
                    <v-flex md6 sm12 lg6 xs12 d-flex>
                      <v-text-field  
                    v-model="newProduct.colour"
                    v-validate="'required'"
                    :error-messages="errors.collect('colour')"
                    label="Colour"
                    data-vv-name="Colour"
                    required/>
                    </v-flex>

                    <v-flex md6 sm12 lg6 xs12 d-flex>
                      <v-text-field
                    input-type="number"
                    v-model="newProduct.price"
                    v-validate="'required'"
                    :error-messages="errors.collect('price')"
                    label="Price"
                    data-vv-name="Price"
                    required
                     type="number"
                     onkeydown="javascript: return event.keyCode == 69 ? false : true" />
                    </v-flex>

                     </v-layout>
                    </v-flex>

                     <v-flex md3 sm3 lg3 xs3 d-flex>
                      <v-text-field  
                    label="Details"
                    v-model="newProduct.details"
                    v-validate="'required'"
                    :error-messages="errors.collect('text box')"
                  single-line
                    solo
                    required />
                    </v-flex>

                    <v-flex d-flex>
                  <v-layout row wrap>
                 <v-flex md3 sm12 lg3 xs12 d-flex>
                  <v-checkbox
                    v-model="newProduct.border"
                    v-validate="'required'"
                    :error-messages="errors.collect('checkbox')"
                    value="1"
                    label="Gold border"
                    data-vv-name="checkbox"
                    type="checkbox"
                    required
                  ></v-checkbox>
                </v-flex>
              <v-flex xs12 sm12 md6 d-flex >
                <v-card
                  flat
                  color="#B0BEC5"
                  @click="$refs.file.click()"
                  ripple
                  hover
                  height="100"
                  width="300"
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
                    </v-flex>
                   
          
        
                  </v-layout>
                </v-container>
              </v-card-text>

              <v-card-actions>
                <v-spacer></v-spacer>
<v-container grid-list-md text-md-center fluid fill-height>
     
      <v-layout row wrap class="button_2">
        <v-flex d-flex >
           <v-btn outline color="primary" @click="clear">clear</v-btn>
        </v-flex>

        <v-flex d-flex >
          <v-btn  color="primary" @click="dialog = false">Close</v-btn>
        </v-flex>

         <v-flex d-flex  >
        <v-btn  color="primary" @click="addProduct">Save</v-btn>
        </v-flex>
        </v-layout>
      
        </v-container>
               
              </v-card-actions>
            </v-card>
          </v-dialog>

     <v-dialog v-model="showModal" max-width=900>
            <v-card>
              <v-card-title>
                <span class="headline">Edit Product</span>
              </v-card-title>

              <v-card-text>
                <v-container grid-list-md text-md-center fluid fill-height>
                  <v-layout column>
                     <v-flex d-flex >
                    <v-layout row wrap>
                    <v-flex md6 sm12 lg6 xs12 d-flex>
                      <v-text-field v-model="ppp" label="PID" disabled />
                    </v-flex>
                    <v-flex  >
                      <v-text-field v-model="editedItem.CID" label="PID" disabled />
                    </v-flex>

                    <v-flex md6 sm12 lg6 xs12 d-flex>
                      <v-select
                    label="Category"
                    :items="category"
                    item-text="CName"
                    item-value="CID"
                    v-model="editedItem.CID"
                    outline
                    menu-props
                  ></v-select>
                    </v-flex>
                     </v-layout>
                    </v-flex>

                    
                   <v-flex d-flex >
                   <v-layout row wrap>
                    <v-flex md6 sm12 lg6 xs12 d-flex>
                       <v-select
                    :items="sizes"
                    label="Size"
                    outline
                    menu-props
                    v-model="editedItem.Size"
                  ></v-select>
                    </v-flex>

                    <v-flex md6 sm12 lg6 xs12 d-flex>
                       <v-select
                    :items="colours"
                    label="Colour"
                    outline
                    menu-props
                    v-model="editedItem.Colour"
                  ></v-select>
                    </v-flex>
                     </v-layout>
                    </v-flex>

                     <v-flex d-flex >
                   <v-layout row wrap>
                    <v-flex md6 sm12 lg6 xs12 d-flex>
                      <v-text-field 
                  v-model="editedItem.Price" 
                  label="Price" 
                   type="number"
                   onkeydown="javascript: return event.keyCode == 69 ? false : true"
                  ></v-text-field>
                    </v-flex>

                    <v-flex md6 sm12 lg6 xs12 d-flex>
                      <v-text-field v-model="editedItem.unitWeight" label="unit Weight" />
                    </v-flex>
                     </v-layout>
                    </v-flex>

                     <v-flex d-flex >
                   <v-layout row wrap>
                    <v-flex md3 sm12 lg3 xs12 d-flex>
                      <v-checkbox
                  
                    v-model="editedItem.border"
                    label="Gold border" 
                  ></v-checkbox>
                    </v-flex>

                    <v-flex md9 sm12 lg9 xs12 d-flex>
                      <v-text-field v-model="editedItem.details" label="Details" />
                    </v-flex>
                     </v-layout>
                    </v-flex>

                    <v-flex xs12 sm6 offset-sm4>
                <v-img height="155" width="350" max-width="260px" :src="editedItem.Image"></v-img>

                <v-card
                  flat
                  color="#B0BEC5"
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
      <v-layout row wrap  class="button_1">
        <v-flex d-flex>
           <v-btn color="primary"  @click="close">Cancel</v-btn>
         
        </v-flex>

        <v-flex d-flex>
          <v-btn color="primary"  @click="editSave">Save</v-btn>
       
        </v-flex>
        </v-layout>
        </v-container>
               
              </v-card-actions>
            </v-card>
          </v-dialog>

     

    

      
       <v-dialog v-model="showQuantity"  max-width=700>
            <v-card>
              <v-card-title>
                <span class="headline">Add Quantity</span>
              </v-card-title>

              <v-card-text>
                <v-container grid-list-md text-md-center fluid fill-height>
                  <v-layout column>
                    
                     <v-flex d-flex >
                   <v-layout row wrap>
                    <v-flex md6 sm12 lg6 xs12 d-flex>
                      
                   <v-select
                    label="Lot"
                    :items="lotItem"
                    item-text="lotquantity"
                    item-value="lid"
                    v-model="newLotQuantity.lot"
                    outline
                    menu-props
                  ></v-select>
                    </v-flex>

                    <v-flex md6 sm12 lg6 xs12 d-flex>
                      <v-text-field
                    v-model="newLotQuantity.quantity"
                    v-validate="'required'"
                    :error-messages="errors.collect('quatity')"
                    label="Quantity"
                    data-vv-name="quantity"
                    required
                     type="number"
                     onkeydown="javascript: return event.keyCode == 69 ? false : true"
                   />
                    </v-flex>
                   
                       </v-layout>
                        </v-flex>
                     <v-layout row wrap>
                    <v-flex md4 sm12 lg4 xs12 d-flex offset-md3 offset-xs1 offset-lg3>
                      <v-text-field v-model="lotQuantity" label="Total Quntity" readonly />
                    </v-flex>
                   </v-layout>
                    

                   
          
        
                  </v-layout>
                </v-container>
              </v-card-text>

              <v-card-actions>
                <v-spacer></v-spacer>
<v-container grid-list-md text-md-center fluid fill-height>
      <v-layout row wrap>
        <v-flex d-flex>
          <v-btn outline color="primary" @click="clearQuntity">clear</v-btn>
        </v-flex>

        <v-flex d-flex>
          <v-btn color="primary"  @click="close">Cancel</v-btn>
        </v-flex>
          <v-flex d-flex>
          <v-btn color="primary"  @click="SaveQuntity">Add to Lot</v-btn>
        </v-flex>
          <v-flex d-flex>
           <v-btn color="blue darken-1"  @click="DeleteQuntity">Delete to Lot</v-btn>
        </v-flex>
        </v-layout>
        </v-container>
               
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

          <v-btn fab dark color="blue" @click="openDialogProduct">
            <v-icon dark>add</v-icon>
          </v-btn>

          <v-btn fab dark color="blue" @click=" productItems ">
            <v-icon medium dark>refresh</v-icon>
          </v-btn>

          <v-btn v-if="!deletedItem" @click="getDeletedProducts">
            <v-icon large color="blue">delete_sweep</v-icon>Deleted products
          </v-btn>

          <v-btn v-if="deletedItem" @click="productItems">
            <v-icon large color="blue">playlist_add_check</v-icon>Active products
          </v-btn>
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
         <!-- <template v-slot:headers="props">
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
              <td class="text-xs-center">{{ props.item.CID }}</td>
              <td class="text-xs-left">{{ props.item.Image}}</td>
              <td class="text-xs-left">
                <v-img :src="props.item.Image"></v-img>
              </td>
              <td class="text-xs-center">{{ props.item.Quantity}}</td>
              <td class="text-xs-center">{{ props.item.Colour }}</td>
              <td class="text-xs-center">{{ props.item.Price }}</td>
              <td class="text-xs-center">{{ props.item.unitWeight }}</td>
              <td class="text-xs-left">{{ props.item.Details }}</td>
              <td class="text-xs-center">{{ props.item.Border }}</td>

              <td class="justify-center layout px-0">
                <v-icon color="blue-grey lighten-1" medium class="mr-2" @click="AddQuantity">add_box</v-icon>

                <v-icon
                  color="deep-purple darken-1"
                  medium
                  class="mr-2"
                  @click="editItem(props.item)"
                >edit</v-icon>
                <v-icon
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
                >restore_from_trash</v-icon>
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
      ppp:"sjkbsa",
      dialog:false,
      showModal: false,
      showQuantity: false,
      editedIndex: -1,
      imageName: "",
      imageUrl: "",
      imageFile: "",

      file: "",

      editedItem: {},

      quantity: "",
      details: "",
      price: "",
      size: "",
      colour: "",
      lot: "",

      newProduct: {
        quantity: "",
        details: "",
        price: "",
        size: "",
        colour: "",
        border: null,
        image: "",
        cid: ""
      },

      newLotQuantity: {
        lot: "",
        quantity: "",
        LotQuantity
      },

      sizes: ["1x1", "2x2", "3x3", "4x4", "5x5"],

      category: [],
      lotItem: [],

      colours: ["White", "Black"],

      defaultItem: {
        imageID: 0,
        // size: 0,
        image: "",
        ext: "",
        deleteURL: ""
      },

      search: "",
      products: [],
      pagination: {
        sortBy: "PID"
      },
      selected: [],
      deletedItem: false,
      table_title: "Product Items",

      headers: [
        { text: "PID", value: "PID" },
        { text: "Size", value: "Size" },
        { text: "Cat. ID", value: "CID" },
        { text: "Image", value: "Image" },
        { text: "Preview", value: "preview" },
        { text: "Quantity", value: "Quantity" },
        { text: "Colour", value: "Colour" },
        { text: "Price", value: "Price" },
        { text: "unitWeight", value: "unitWeight" },
        { text: "Details", value: "details" },
        { text: "Border", value: "border" },
        { text: "Action", value: "action" }
      ]
    };
  },

  mounted() {
    this.productItems();
    this.catItems();
    this.lotItems();
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
    },

    lotQuantity: function() {
      this.editedIndex = this.lotItem.indexOf(this.newLotQuantity.lot)
            this.editedItem = Object.assign({}, this.newLotQuantity.lot)
             console.log("kjasdnk");
     
      return this.newLotQuantity.lot*this.newLotQuantity.quantity;
      
    
  },
  },

  methods: {
    catItems() {
      axios
        .get(this.$baseUrl + "/api/category")
        .then(response => {
          response.data.catItems.forEach(element => {
            this.category.push(element);
          });
        })
        .catch(error => {
          console.log(error.response);
          console.log("ERROR");
        });
    },
    lotItems() {
      axios
        .get("http://localhost:8000/api/getLot")
        .then(response => {
          response.data.lotItems.forEach(element =>{
              this.lotItem.push(element);
          });

          
console.log(this.lotItem);

          //console.log(this.categoryItems);
        })
        .catch(error => {
          console.log(error.response);
          console.log("ERROR");
        });
    },

    selectFile(event) {
      this.file = this.$refs.file.files[0];
      let $Token = localStorage.getItem("token");
    },

    addProduct() {
      const formData = new FormData();
      formData.append("file", this.file, this.file.name);

      formData.append("quantity", this.newProduct.quantity);
      formData.append("details", this.newProduct.details);
      formData.append("price", this.newProduct.price);
      formData.append("size", this.newProduct.size);
      formData.append("border", this.newProduct.border);
      formData.append("colour", this.newProduct.colour);
      formData.append("cid", this.newProduct.cid);

      // this.newProduct.image = formData;

      let $Token = localStorage.getItem("token");

      axios
        .post(this.$baseUrl + "/addProduct?token=" + $Token, formData)
        .then(response => {
          this.dialog = false;
          this.productItems();
          console.log("Product Succesfully Added");
        })
        .catch(error => {
          console.log(error.response);
          console.log("ERROR");
        });
    },

    productItems() {
      (this.table_title = "Active Products"), (this.deletedItem = false);

      axios
        .get(this.$baseUrl + "/products")
        .then(response => {
          this.products = response.data.product;

          console.log(this.products);
        })
        .catch(error => {
          console.log(error.response);
          console.log("ERROR");
        });
        
    },

    getDeletedProducts() {
      (this.table_title = "Deleted Products"), (this.deletedItem = true);
      let $Token = localStorage.getItem("token");
      axios
        .post(this.$baseUrl + "/deletedProducts?token=" + $Token)
        .then(response => {
          this.products = response.data.product;

          //console.log(this.slideshowItems);
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
      this.showQuantity = false;
      setTimeout(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      }, 300);
    },

    clear() {
      this.newProduct.size = "";
      this.newProduct.colour = "";
      this.newProduct.quantity = "";
      this.newProduct.price = "";
      this.newProduct.border = false;
      this.newProduct.details = "";
    },

    clearQuntity() {
      this.newLotQuantity.lot = "";
      this.newLotQuantity.quantity = "";
    },

    openDialogProduct() {
      this.newProduct.size = "";
      this.newProduct.colour = "";
      this.newProduct.quantity = "";
      this.newProduct.price = "";
      this.newProduct.border = false;
      this.newProduct.details = "";
      this.dialog = true;
    },

    editSave() {
      let $Token = localStorage.getItem("token");
      if (this.editedIndex > -1) {
        Object.assign(this.products[this.editedIndex], this.editedItem);

        axios
          .post(
            this.$baseUrl +
              "/editProduct/" +
              this.editedItem.PID +
              "?token=" +
              $Token,
            this.editedItem
          )
          .then(response => {
            this.showModal = false;
            this.productItems();
            console.log("Succesfully Edited");
          });
      } else {
        this.products.push(this.editedItem);
      }
      this.close();
    },

   
    
    editItem(item) {
      this.editedIndex = this.products.indexOf(item);
      this.editedItem = Object.assign({}, item);
       console.log(this.editedIndex);
       console.log("111111111111");
      console.log(this.editedItem);
      this.showModal = true;



          
    },

    deleteItem(item) {
      var result = confirm("Want to delete product" + item.PID + "?");
      if (result) {
        //Logic to delete the item
        let $Token = localStorage.getItem("token");
        axios
          .post(
            this.$baseUrl + "/deleteProduct/" + item.PID + "?token=" + $Token
          )
          .then(response => {
            /*axios.get(item.deleteURL).then(res=>{
                            console.log(res);
                        });*/
            this.productItems();
            alert("Product succesfully Deleted");
          });
      }
    },

    restoreItem(item) {
      var result = confirm("Want to restore " + item.PID + "?");
      if (result) {
        //Logic to delete the item
        let $Token = localStorage.getItem("token");
        axios
          .post(
            this.$baseUrl + "/restoreProduct/" + item.PID + "?token=" + $Token
          )
          .then(response => {
            /*axios.get(item.deleteURL).then(res=>{
                            console.log(res);
                        });*/
            this.productItems();
            alert("Succesfully Restored");
          });
      }
    },

    selectFile(event) {
      this.file = this.$refs.file.files[0];
    },

    AddQuantity() {
      this.clearQuntity();
      this.showQuantity = true;
    },

    sendFile() {
      const formData = new FormData();
      formData.append("file", this.file, this.file.name);

      let $Token = localStorage.getItem("token");

      axios
        .post(
          "https://vgy.me/upload?userkey=Kpx6WS9lOl8dx3rU9pDrOasKbkUOlpGs",
          formData
        )
        .then(response => {
          console.log(response);
          console.log(response.data.image);
          axios
            .post(
              this.$baseUrl + "/storeImage" + "?token=" + $Token,
              response.data
            )
            .then(response => {
              this.dialog = false;
              this.file = "";
              this.getSlideshow();
              alert("Succesfully Saved");
            })
            .catch(error => {
              console.log(error.response);
              console.log("Failed Save img url");
            });
        })
        .catch(error => {
          console.log(error.response);
          console.log("Upload Failed");
        });
    },
    DeleteQuntity(){


    },

    



    SaveQuntity() {}
  }
};
</script>
<style>
.v-responsive {
  margin-bottom: 7px;
}
.container.grid-list-md.text-md-center.fluid.fill-height {
    padding-top: 0px;
    padding-bottom: 0;
}
.layout.button_2.row.wrap {
    
    margin-left: 380px;
    margin-right: 0px;
}
.flex.md6.sm12.lg6.xs12.d-flex {
    padding-right: 30px;
}




</style>-->

<template>
  <div>
    <navDrawer></navDrawer>
    <br />

    <div class="container" v-bind:style="{ background: '#B0BEC5'}">
      <v-dialog v-model="dialog" max-width="900">
        <v-card>
          <v-card-title>
            <span class="headline">Upload Form</span>
          </v-card-title>

          <v-card-text>
            <v-container grid-list-md text-md-center fluid fill-height>
              <v-layout column>
                <v-flex d-flex>
                  <v-layout row wrap>
                    <v-flex md6 sm12 lg6 xs12 d-flex>
                      <v-text-field
                        v-model="newProduct.size"
                        v-validate="'required'"
                        :error-messages="errors.collect('size')"
                        label="Size"
                        data-vv-name="Size"
                        required
                      />
                    </v-flex>

                    <v-flex md6 sm12 lg6 xs12 d-flex>
                      <v-select
                        label="Category"
                        :items="category"
                        item-text="CName"
                        item-value="CID"
                        v-model="newProduct.cid"
                        outline
                        menu-props
                      ></v-select>
                    </v-flex>
                  </v-layout>
                </v-flex>

                <v-flex d-flex>
                  <v-layout row wrap>
                    <v-flex md6 sm12 lg6 xs12 d-flex>
                      <v-text-field
                        v-model="newProduct.colour"
                        v-validate="'required'"
                        :error-messages="errors.collect('colour')"
                        label="Colour"
                        data-vv-name="Colour"
                        required
                      />
                    </v-flex>

                    <v-flex md6 sm12 lg6 xs12 d-flex>
                      <v-text-field
                        input-type="number"
                        v-model="newProduct.price"
                        v-validate="'required'"
                        :error-messages="errors.collect('price')"
                        label="Price"
                        data-vv-name="Price"
                        required
                        type="number"
                        onkeydown="javascript: return event.keyCode == 69 ? false : true"
                      />
                    </v-flex>
                  </v-layout>
                </v-flex>

                <v-flex md3 sm3 lg3 xs3 d-flex>
                  <v-text-field
                    label="Details"
                    v-model="newProduct.details"
                    v-validate="'required'"
                    :error-messages="errors.collect('text box')"
                    single-line
                    solo
                    required
                  />
                </v-flex>

                <v-flex d-flex>
                  <v-layout row wrap>
                    <v-flex md3 sm12 lg3 xs12 d-flex>
                      <v-checkbox
                        v-model="newProduct.border"
                        v-validate="'required'"
                        :error-messages="errors.collect('checkbox')"
                        value="1"
                        label="Gold border"
                        data-vv-name="checkbox"
                        type="checkbox"
                        required
                      ></v-checkbox>
                    </v-flex>
                    <v-flex xs12 sm12 md6 d-flex>
                      <v-card
                        flat
                        color="#B0BEC5"
                        @click="$refs.file.click()"
                        ripple
                        hover
                        height="100"
                        width="300"
                        max-width="600px"
                      >
                        <form enctype="multipart/form-data">
                          <div class="text-xs-center">
                            <label class="button">
                              <input
                                type="file"
                                ref="file"
                                @change="selectFile"
                                style="display:none"
                              />
                              <v-icon outline large>cloud_upload</v-icon>
                              <h4>Upload photo</h4>
                              <span v-if="file" class="file-name">{{file.name}}</span>
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
              <v-layout row wrap class="button_2">
                <v-flex d-flex>
                  <v-btn outline color="primary" @click="clear">clear</v-btn>
                </v-flex>

                <v-flex d-flex>
                  <v-btn color="primary" @click="dialog = false">Close</v-btn>
                </v-flex>

                <v-flex d-flex>
                  <v-btn color="primary" @click="addProduct">Save</v-btn>
                </v-flex>
              </v-layout>
            </v-container>
          </v-card-actions>
        </v-card>
      </v-dialog>

      <v-dialog v-model="showModal" max-width="900">
        <v-card>
          <v-card-title>
            <span class="headline">Edit Product</span>
          </v-card-title>

          <v-card-text>
            <v-container grid-list-md text-md-center fluid fill-height>
              <v-layout column>
                <v-flex d-flex>
                  <v-layout row wrap>
                    <v-flex md6 sm12 lg6 xs12 d-flex>
                      <v-text-field v-model="editedItem.PID" label="PID" disabled />
                    </v-flex>

                    <v-flex md6 sm12 lg6 xs12 d-flex>
                      <v-select
                        label="Category"
                        :items="category"
                        item-text="CName"
                        item-value="CID"
                        v-model="editedItem.CID"
                        outline
                        menu-props
                      ></v-select>
                    </v-flex>
                  </v-layout>
                </v-flex>

                <v-flex d-flex>
                  <v-layout row wrap>
                    <v-flex md6 sm12 lg6 xs12 d-flex>
                      <v-text-field label="Size" v-model="editedItem.Size"></v-text-field>
                    </v-flex>

                    <v-flex md6 sm12 lg6 xs12 d-flex>
                      <v-text-field label="Colour" v-model="editedItem.Colour"></v-text-field>
                    </v-flex>
                  </v-layout>
                </v-flex>

                <v-flex d-flex>
                  <v-layout row wrap>
                    <v-flex md6 sm12 lg6 xs12 d-flex>
                      <v-text-field
                        v-model="editedItem.Price"
                        label="Price"
                        type="number"
                        onkeydown="javascript: return event.keyCode == 69 ? false : true"
                      ></v-text-field>
                    </v-flex>

                    <v-flex md6 sm12 lg6 xs12 d-flex>
                      <v-text-field v-model="editedItem.unitWeight" label="unit Weight" />
                    </v-flex>
                  </v-layout>
                </v-flex>

                <v-flex d-flex>
                  <v-layout row wrap>
                    <v-flex md3 sm12 lg3 xs12 d-flex>
                      <v-checkbox v-model="editedItem.border" label="Gold border"></v-checkbox>
                    </v-flex>

                    <v-flex md9 sm12 lg9 xs12 d-flex>
                      <v-text-field v-model="editedItem.details" label="Details" />
                    </v-flex>
                  </v-layout>
                </v-flex>

                <v-flex xs12 sm6 offset-sm4>
                  <v-img height="155" width="350" max-width="260px" :src="editedItem.Image"></v-img>

                  <v-card
                    flat
                    color="#B0BEC5"
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
              <v-layout row wrap class="button_1">
                <v-flex d-flex>
                  <v-btn color="primary" @click="close">Cancel</v-btn>
                </v-flex>

                <v-flex d-flex>
                  <v-btn color="primary" @click="editSave">Save</v-btn>
                </v-flex>
              </v-layout>
            </v-container>
          </v-card-actions>
        </v-card>
      </v-dialog>

      <!--new quantity view----->

      <v-dialog v-model="showQuantity" max-width="700">
        <v-card>
          <v-card-title>
            <span class="headline">Add Quantity</span>
          </v-card-title>

          <v-card-text>
            <v-container grid-list-md text-md-center fluid fill-height>
              <v-layout column>
                <v-flex d-flex>
                  <v-layout row wrap>
                    <v-flex md6 sm12 lg6 xs12 d-flex>
                      <v-select
                        label="Lot"
                        :items="lotItem"
                        item-text="lotquantity"
                        item-value="lid"
                        v-model="newLotQuantity.lot"
                        type="number"
                        onkeydown="javascript: return event.keyCode == 69 ? false : true"
                        outline
                        menu-props
                      ></v-select>
                    </v-flex>

                    <v-flex md6 sm12 lg6 xs12 d-flex>
                      <v-text-field
                        v-model="newLotQuantity.quantity"
                        v-validate="'required'"
                        :error-messages="errors.collect('quatity')"
                        label="Quantity"
                        data-vv-name="quantity"
                        required
                        type="number"
                        onkeydown="javascript: return event.keyCode == 69 ? false : true"
                      />
                    </v-flex>
                  </v-layout>
                </v-flex>
                <v-layout row wrap>
                  <v-flex md4 sm12 lg4 xs12 d-flex offset-md3 offset-xs1 offset-lg3>
                    <v-text-field v-model="lotQuantity" label="Total Quntity" readonly />
                  </v-flex>
                </v-layout>
              </v-layout>
            </v-container>
          </v-card-text>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-container grid-list-md text-md-center fluid fill-height>
              <v-layout row wrap>
                <v-flex d-flex>
                  <v-btn outline color="primary" @click="clearQuntity">clear</v-btn>
                </v-flex>

                <v-flex d-flex>
                  <v-btn color="primary" @click="close">Cancel</v-btn>
                </v-flex>
                <v-flex d-flex>
                  <v-btn color="primary" @click="SaveQuntity">Add to Lot</v-btn>
                </v-flex>
                <v-flex d-flex>
                  <v-btn color="blue darken-1" @click="DeleteQuntity">Delete to Lot</v-btn>
                </v-flex>
              </v-layout>
            </v-container>
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

          <v-btn fab dark color="blue" @click="openDialogProduct">
            <v-icon dark>add</v-icon>
          </v-btn>

          <v-btn fab dark color="blue" @click=" productItems ">
            <v-icon medium dark>refresh</v-icon>
          </v-btn>

          <v-btn v-if="!deletedItem" @click="getDeletedProducts">
            <v-icon large color="blue">delete_sweep</v-icon>Deleted products
          </v-btn>

          <v-btn v-if="deletedItem" @click="productItems">
            <v-icon large color="blue">playlist_add_check</v-icon>Active products
          </v-btn>
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
              <td class="text-xs-center">{{ props.item.CID }}</td>
              <td class="text-xs-left">{{ props.item.Image}}</td>
              <td class="text-xs-left">
                <v-img :src="props.item.Image"></v-img>
              </td>
              <td class="text-xs-center">{{ props.item.Quantity}}</td>
              <td class="text-xs-center">{{ props.item.Colour }}</td>
              <td class="text-xs-center">{{ props.item.Price }}</td>
              <td class="text-xs-center">{{ props.item.unitWeight }}</td>
              <td class="text-xs-left">{{ props.item.Details }}</td>
              <td class="text-xs-center">{{ props.item.Border }}</td>

              <td class="justify-center layout px-0">
                <v-icon
                  color="blue-grey lighten-1"
                  medium
                  class="mr-2"
                  @click="AddQuantity(props.item)"
                >add_box</v-icon>

                <v-icon
                  color="deep-purple darken-1"
                  medium
                  class="mr-2"
                  @click="editItem(props.item)"
                >edit</v-icon>
                <v-icon
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
                >restore_from_trash</v-icon>
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
      showQuantity: false,
      editedIndex: -1,
      imageName: "",
      imageUrl: "",
      imageFile: "",
       LotQuantity: "",

      file: "",


      editedItem: {
        PID: 0,
        Size: 0,
        CID: "",
        Image: "",
        Quantity: "",
        Colour: "",
        Price: "",
        unitWeight: "",
        details: "",
        border: null
      },

      quantity: "",
      details: "",
      price: "",
      size: "",
      colour: "",
      lot: "",

      newProduct: {
        quantity: "",
        details: "",
        price: "",
        size: "",
        colour: "",
        border: null,
        image: "",
        cid: ""
      },

      newLotQuantity: {
        lot: "",
        quantity: "",
        
        
      },

      sizes: ["1x1", "2x2", "3x3", "4x4", "5x5"],

      category: [],
      lotItem: [],

      colours: ["White", "Black"],

      defaultItem: {
        imageID: 0,
        // size: 0,
        image: "",
        ext: "",
        deleteURL: ""
      },

      search: "",
      products: [],
      pagination: {
        sortBy: "PID"
      },
      selected: [],
      deletedItem: false,
      table_title: "Product Items",

      headers: [
        { text: "PID", value: "PID" },
        { text: "Size", value: "Size" },
        { text: "Cat. ID", value: "CID" },
        { text: "Image", value: "Image" },
        { text: "Preview", value: "preview" },
        { text: "Quantity", value: "Quantity" },
        { text: "Colour", value: "Colour" },
        { text: "Price", value: "Price" },
        { text: "unitWeight", value: "unitWeight" },
        { text: "Details", value: "details" },
        { text: "Border", value: "border" },
        { text: "Action", value: "action" }
      ]
    };
  },

  mounted() {
    this.productItems();
    this.catItems();
    this.lotItems();
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
    },

    lotQuantity: function() {
      if (this.newLotQuantity.lot) {
        let obj = this.lotItem.find(
          item => item.lid === this.newLotQuantity.lot
        );
        if (obj.lotquantity) {
          console.log("+++++++++++++++++++++");
           console.log(obj.lotquantity);
           return obj.lotquantity*this.newLotQuantity.quantity;
        }
      }
    }
  },

  methods: {
    catItems() {
      axios
        .get(this.baseUrl+"/category")
        .then(response => {
          response.data.catItems.forEach(element => {
            this.category.push(element);
          });
        })
        .catch(error => {
          console.log(error.response);
          console.log("ERROR");
        });
    },

    lotItems() {
      axios
        .get(this.baseUrl+"/getLot")
        .then(response => {
          response.data.lotItems.forEach(element => {
            this.lotItem.push(element);
          });

          console.log(this.lotItem);

          //console.log(this.categoryItems);
        })
        .catch(error => {
          console.log(error.response);
          console.log("ERROR");
        });
    },

    selectFile(event) {
      this.file = this.$refs.file.files[0];

      let $Token = localStorage.getItem("token");
      /*
      axios
        .post(
          "https://vgy.me/upload?userkey=2BX3uyR6WMJK6l2CA3frAi12xQcmXrgg",
          formData
        )
        .then(response => {
          this.newProduct.image = response.data.image;
        })
        .catch(error => {
          console.log(error.response);
          console.log("Upload Failed");
        });*/
    },

    addProduct() {
      const formData = new FormData();
      formData.append("file", this.file, this.file.name);

      formData.append("quantity", this.newProduct.quantity);
      formData.append("details", this.newProduct.details);
      formData.append("price", this.newProduct.price);
      formData.append("size", this.newProduct.size);
      formData.append("border", this.newProduct.border);
      formData.append("colour", this.newProduct.colour);
      formData.append("cid", this.newProduct.cid);

      // this.newProduct.image = formData;

      let $Token = localStorage.getItem("token");

      axios
        .post(this.baseUrl+"/addProduct?token=" + $Token, formData)
        .then(response => {
          this.dialog = false;
          this.productItems();
          console.log("Product Succesfully Added");
        })
        .catch(error => {
          console.log(error.response);
          console.log("ERROR");
        });
    },

    productItems() {
      (this.table_title = "Active Products"), (this.deletedItem = false);

      axios
        .get(this.baseUrl+"/products")
        .then(response => {
          this.products = response.data.product;

          console.log(this.products);
        })
        .catch(error => {
          console.log(error.response);
          console.log("ERROR");
        });
    },

    getDeletedProducts() {
      (this.table_title = "Deleted Products"), (this.deletedItem = true);
      let $Token = localStorage.getItem("token");
      axios
        .post(this.baseUrl+"/deletedProducts?token=" + $Token)
        .then(response => {
          this.products = response.data.product;

          //console.log(this.slideshowItems);
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
      this.showQuantity = false;
      setTimeout(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      }, 300);
    },

    clear() {
      this.newProduct.size = "";
      this.newProduct.colour = "";
      this.newProduct.quantity = "";
      this.newProduct.price = "";
      this.newProduct.border = false;
      this.newProduct.details = "";
    },

    clearQuntity() {
      this.newLotQuantity.lot = "";
      this.newLotQuantity.quantity = "";
    },

    openDialogProduct() {
      this.newProduct.size = "";
      this.newProduct.colour = "";
      this.newProduct.quantity = "";
      this.newProduct.price = "";
      this.newProduct.border = false;
      this.newProduct.details = "";
      this.dialog = true;
    },

    editSave() {
      let $Token = localStorage.getItem("token");
      if (this.editedIndex > -1) {
        Object.assign(this.products[this.editedIndex], this.editedItem);

        axios
          .post(
            this.baseUrl+"/editProduct/" +
              this.editedItem.PID +
              "?token=" +
              $Token,
            this.editedItem
          )
          .then(response => {
            this.showModal = false;
            this.productItems();
            console.log("Succesfully Edited");
          });
      } else {
        this.products.push(this.editedItem);
      }
      this.close();
    },

    editItem(item) {
      this.editedIndex = this.products.indexOf(item);
      this.editedItem = Object.assign({}, item);
      console.log(this.editedItem);
      this.showModal = true;
    },

    deleteItem(item) {
      var result = confirm("Want to delete product" + item.PID + "?");
      if (result) {
        //Logic to delete the item
        let $Token = localStorage.getItem("token");
        axios
          .post(
            this.baseUrl+"/deleteProduct/" +
              item.PID +
              "?token=" +
              $Token
          )
          .then(response => {
            /*axios.get(item.deleteURL).then(res=>{
                            console.log(res);
                        });*/
            this.productItems();
            alert("Product succesfully Deleted");
          });
      }
    },

    restoreItem(item) {
      var result = confirm("Want to restore " + item.PID + "?");
      if (result) {
        //Logic to delete the item
        let $Token = localStorage.getItem("token");
        axios
          .post(
            this.baseUrl+"/restoreProduct/" +
              item.PID +
              "?token=" +
              $Token
          )
          .then(response => {
            /*axios.get(item.deleteURL).then(res=>{
                            console.log(res);
                        });*/
            this.productItems();
            alert("Succesfully Restored");
          });
      }
    },

    selectFile(event) {
      this.file = this.$refs.file.files[0];
    },

    AddQuantity(item) {
      this.editedItem = Object.assign({}, item);
      this.clearQuntity();
      this.showQuantity = true;
    },

    sendFile() {
      const formData = new FormData();
      formData.append("file", this.file, this.file.name);

      let $Token = localStorage.getItem("token");

      axios
        .post(
          "https://vgy.me/upload?userkey=Kpx6WS9lOl8dx3rU9pDrOasKbkUOlpGs",
          formData
        )
        .then(response => {
          console.log(response);
          console.log(response.data.image);
          axios
            .post(
              this.baseUrl+"/storeImage" + "?token=" + $Token,
              response.data
            )
            .then(response => {
              this.dialog = false;
              this.file = "";
              this.getSlideshow();
              alert("Succesfully Saved");
            })
            .catch(error => {
              console.log(error.response);
              console.log("Failed Save img url");
            });
        })
        .catch(error => {
          console.log(error.response);
          console.log("Upload Failed");
        });
    },
    DeleteQuntity() {},

    SaveQuntity() {
      const formData = new FormData();

      formData.append("lid", this.newLotQuantity.lot);
      formData.append("pid", this.editedItem.PID);
      formData.append("quantity", this.LotQuantity);
      console.log("**************************");
      console.log(this.newLotQuantity.lot);
      console.log(this.editedItem.PID);
      console.log(this.LotQuantity);

      // this.newProduct.image = formData;

      let $Token = localStorage.getItem("token");

      axios
        .post(
          this.baseUrl+"/addProductLot?token=" + $Token,
          formData
        )
        .then(response => {
          this.showQuantity = false;
          this.productItems();
          console.log("Product Succesfully Added");
        })
        .catch(error => {
          console.log(error.response);
          console.log("ERROR");
        });
    }
  }
};
</script>
<style>
.v-responsive {
  margin-bottom: 7px;
}

.container.grid-list-md.text-md-center.fluid.fill-height {
  padding-top: 0px;
  padding-bottom: 0;
}
.layout.button_2.row.wrap {
  margin-left: 380px;
  margin-right: 0px;
}
.flex.md6.sm12.lg6.xs12.d-flex {
  padding-right: 30px;
}

.layout.button_1.row.wrap {
  margin-left: 480px;
}
</style>



