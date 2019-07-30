<template>
  <div>
    <br>
    <div class="container 1" v-bind:style="{ background: '#B0BEC5'}">
      <v-dialog width="1187px" v-model="dialog" >
        <v-card>
          <v-card-title>
            <span class="headline">Upload LotQuantity</span>
          </v-card-title>
          <v-card-text>
            <v-container 2>
              <form>
               
                  <v-flex xs8 sm3 md4>
                    <v-text-field
                      v-model="newItem.LotValue"
                      v-validate="'required'"
                      :error-messages="errors.collect('LotValue')"
                      label="Lot Value"
                      data-vv-name="LotValue"
                      required
                      
                    ></v-text-field>
                  </v-flex>

                  
               
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

         
        </v-card-title>
        <v-data-table
          v-model="selected"
          :headers="headers"
          :items="LotQuantityItems"
          :search="search"
          :pagination.sync="pagination"
          select-all
          item-key="lid"
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
              <td class="text-xs-left">{{ props.item.lid }}</td>
              <td class="text-xs-left">{{ props.item.lotquantity }}</td>
            
              
              <td class="justify-center layout px-0">
               
                <v-icon
                 
                  color="red"
                  medium
                  @click="deleteLotItem(props.item)"
                >delete</v-icon>
                
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
      editedItem: {
        LID:0,
        LotValue: "",
        

        
      },
      search: "",

      newItem:{
        LotValue: "",
        LID: 0,
      },
     
      LotCode: "",

    
      pagination: {
        sortBy: "lid"
      },
      selected: [],
      LotQuantityItems: [],

      headers: [
        { text: "Lot ID", value: "lid" },
        { text: "Lot value", value: "lotquantity" },
       
      
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
        .get("http://localhost:8000/api/getLot")
        .then(response => {
          this.LotQuantityItems = response.data.lotItems;
          


          //console.log(this.categoryItems);
        })
        .catch(error => {
          console.log(error.response);
          console.log("ERROR");
        });
    },

   

    

    deleteLotItem(item){
      var result = confirm("Want to delete Lot" + item.lid + "?");
      if (result) {
        //Logic to delete the item
        let $Token = localStorage.getItem("token");
        axios
          .post(
            "http://localhost:8000/api/deleteLot/" +
              item.lid +
              "?token=" +
              $Token
          )
          .then(response => {
            /*axios.get(item.deleteURL).then(res=>{
                            console.log(res);
                        });*/
             this.lotItems();
            alert("Lot succesfully Deleted");
          });
      }


    },

   
    Save(){
      
      

      // this.newProduct.image = formData;

       let $Token = localStorage.getItem("token");

      axios
        .post("http://localhost:8000/api/addlot?token=" + $Token, this.newItem)
        //console.log("not save")
        .then(response => {
          
          this.dialog = false;
          this.lotItems();
          
          console.log("lotQuantity Succesfully Added");
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
    dialogOpen(){
       this.clear();
        this.dialog = true;
    },
     clear() {
      this.newItem.LotValue = "";
     

      this.$validator.reset();
    },
  }
};
</script>



