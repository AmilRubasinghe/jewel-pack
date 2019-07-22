<template>
  <div id="app">
    <v-app id="inspire"> 
       
      <v-container grid-list-sm text-xs-center>
        
        <v-layout row wrap justify-space-between>
          <v-flex v-for="(item, i) in products" :key="i" lg4 md6 xs12 class="pr-2">
            <br>
            <v-card class="card-5" light ripple align="center" @click="productPreview(products[i])">
              <v-img contain class="white--text" align="center" :src="products[i].Image">
                <v-container fill-height fluid>
                  <v-layout fill-height>
                    <v-flex xs12 align-end flexbox>
                      <!--                   <span class="headline"></span> -->
                    </v-flex>
                  </v-layout>
                </v-container>
              </v-img>


              


              <v-card-title>
              
                  <v-flex xs9 sm12 offset-sm0>
                  <span
                    class="title --text"
                  ><h2>{{products[i].Size}}&nbsp;{{products[i].Colour}}White&nbsp; Colour Box</h2></span>
                 
                   <v-chip label color="brown lighten-3" text-color="brown darken-3" outline>
                          <h4>SALE!</h4>
                       </v-chip>
                  

                  <v-rating readonly small dense background-color="brown" color="brown"></v-rating>
                  
                  <del class>
                   <v-chip label color="white" text-color="brown lighten-3">
                          <h5>$ 50</h5>
                       </v-chip>
                  </del>&nbsp;
                  <span class="title">
                      <v-chip label color="white" text-color="brown darken-3">
                          <h4>$ {{products[i].Price}}</h4>
                       </v-chip>
                   
                  </span> 
               </v-flex>
              </v-card-title>
              <v-card-actions>&nbsp;

                <v-btn
                  large
                  round
                  depressed
                  color="brown lighten-4"
                  outline-color="dark"
                  class="mx-auto"
                  @click="productPreview(products[i])"
                >Product View</v-btn>
              </v-card-actions>
            </v-card>
          </v-flex>
        </v-layout>
      
      </v-container>
        

      <v-layout row justify-center>
        <v-dialog v-model="dialog" max-width="1200px">
          <v-card class="card-5" v-if="selectedItem">
            <v-card-text>
              <button type="button" class="close" aria-label="Close" flat @click="dialog = false">
                <span aria-hidden="true">×</span>
              </button>
              <v-container grid-list-md>
                <!--................................-->
                <v-layout row wrap>
                  <v-flex xs12 md6>
                    <v-hover>
                      <v-card
                        slot-scope="{ hover }"
                        class="mx-auto"
                        color="grey lighten-4"
                        max-width="600"
                      >
                        <v-img :aspect-ratio="4/3" :src="selectedItem.Image">
                          <v-expand-transition>
                            <div
                              v-if="hover"
                              class="d-flex transition-fast-in-fast-out orange darken-2 v-card--reveal display-3 white--text"
                              style="height: 75%;"
                            >$ {{selectedItem.Price}}</div>
                          </v-expand-transition>
                        </v-img>
                      </v-card>
                    </v-hover>
                  </v-flex>

                  <v-flex xs12 md6>
                    <h3
                      class="display-1 font-weight-light orange--text mb-1"
                    >{{selectedItem.Size}}&nbsp;{{selectedItem.Colour}}&nbsp; Colour Box</h3>
                    <p
                      class="card-description font-weight-light"
                    >Don't be scared of the truth because we need to restart the human foundation in truth And I love you like Kanye loves Kanye I love Rick Owens’ bed design but the back is...</p>
                    <v-divider></v-divider>
                    <v-hover></v-hover>

                    <table class="a-lineitem">
                      <tbody>
                        <tr>
                          <td
                            class="a-color-secondary a-size-base a-text-right a-nowrap padding:10px"
                          >List Price:</td>
                          <td class="a-span12 a-color-secondary a-size-base">
                            <span
                              class="priceBlockStrikePriceString a-text-strike"
                            >$ {{selectedItem.Price}}</span>
                            <span id="listPriceLegalMessage"></span>
                          </td>
                        </tr>
                        <tr id="priceblock_dealprice_row">
                          <td
                            id="priceblock_dealprice_lbl"
                            class="a-color-secondary a-size-base a-text-right a-nowrap"
                          >With Deal:</td>
                          <td class="a-span12">
                            <span
                              id="priceblock_dealprice"
                              class="a-size-medium a-color-price priceBlockDealPriceString"
                            >$56.99</span>
                            <span id="dealprice_shippingmessage" class="a-size-medium">
                              <span id="price-shipping-message" class="a-size-base a-color-base"></span>
                            </span>
                          </td>
                        </tr>

                        <tr id="quantity_row">
                          <td
                            id="quantity_lbl"
                            class="a-color-secondary a-size-base a-text-right a-nowrap"
                          >Quantity:</td>
                          <td class="a-span12">
                            <span id="quantity" class="a-size-medium a-color-quantity">
                              <div class="minusplusnumber">
                                <div class="mpbtn minus" v-on:click="decrement()">-</div>
                                <div id="field_container">
                                  <input
                                    @change="valid()"
                                    type="number"
                                    v-model="value"
                                    onkeydown="javascript: return event.keyCode == 69 ? false : true"
                                  >
                                </div>
                                <div class="mpbtn plus" v-on:click="increment()">+</div>
                              </div>
                            </span>
                          </td>
                        </tr>
                      </tbody>
                    </table>

                    <div class="text-xs- mt-5">
                      <v-rating
                      
                        color="yellow darken-3"
                        background-color="grey darken-1"
                        empty-icon="$vuetify.icons.ratingFull"
                        half-increments
                        hover
                      ></v-rating>
                    </div>

                    <v-divider></v-divider>

                    <v-card-actions>
                      <v-btn color="warning" dark outline round @click="addToCart(selectedItem,value)">Add to cart</v-btn>
                      <v-btn color="warning" dark outline round @click="dialog=false">Close</v-btn>
                    </v-card-actions>
                  </v-flex>
                </v-layout>

                <!--..............................-->
              </v-container>
            </v-card-text>
          </v-card>
        </v-dialog>
      </v-layout>
    </v-app>
  </div>
</template>



<script>
import axios from "axios";
import Vue from 'vue'

export default {
  data() {
    return {
      page: 1,
      dialog: false,
      products: [],
      selectedItem: null,
      value: 100,
      max: 500,
      newValue: 0
    };
  },

  //data: () => ({
  // dialog: false,
  // }),

  mounted() {
    this.productItems();
  },

  methods: {
    productItems() {
      axios
        .get("http://localhost:8000/api/product/1")
        .then(response => {
          this.products = response.data.product;

          console.log(this.products);
        })
        .catch(error => {
          console.log(error.response);
          console.log("ERROR");
        });
    },

    productPreview(item) {
      this.selectedItem = item;
      this.dialog = true;
    },

    increment() {
      if (this.value >= this.max) {
        alert("Available only " + this.max + " units");
      } else {
        this.value=this.value+100;
      }
    },
    decrement() {
      if (this.value === 0) {
        alert("Negative quantity not allowed");
      } else {
        this.value=this.value-100;
      }
    },

    addToCart(selectedItem){
       this.$store.commit('addToCart', selectedItem);
    },

    valid() {
      if (this.value >= this.max) {
        this.value = this.max;
      }
    },



    addToCart(selectedItem,value){
       // console.log(selectedItem);
      Vue.set(selectedItem, 'qty', value);
      
        this.$store.commit('addToCart', selectedItem);
        this.dialog=false;
        this.value=1;

   // console.log(value);
    
        //console.log(window.localStorage.getItem('cart'));
        //console.log(window.localStorage.getItem('cartCount'));
    }

  }
};
</script>


<style>
.v-card--reveal {
  align-items: center;
  bottom: 0;
  justify-content: center;
  opacity: 0.5;
  position: absolute;
  width: 100%;
}


.layout.row.wrap.justify-space-between {
  margin-left: -60px;
  margin-right: -60px;
}

.container.grid-list-md .layout .flex {
  padding: 10px;
}

.minusplusnumber {
  border: 1px solid silver;
  border-radius: 5px;
  background-color: #fff;
  margin: 0 5px 0 5px;
  display: inline-block;
  user-select: none;
}
.minusplusnumber div {
  display: inline-block;
}
.minusplusnumber #field_container input {
  width: 50px;
  text-align: center;
  font-size: 15px;
  padding: 3px;
  border: none;
}
.minusplusnumber .mpbtn {
  padding: 3px 10px 3px 10px;
  cursor: pointer;
  border-radius: 5px;
}
.minusplusnumber .mpbtn:hover {
  background-color: #ddd;
}
.minusplusnumber .mpbtn:active {
  background-color: #c5c5c5;
}

input[type="number"]::-webkit-inner-spin-button,
input[type="number"]::-webkit-outer-spin-button {
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  margin: 0;
}

.mt-5 {
  margin-top: 20px !important;
 
}

.v-rating.v-rating--readonly.v-rating--dense {
    padding-bottom: 10px;
     margin-top: 20px !important;
}





  td { 
    width:130px; 
    height:40px; 
    text-align:center; 
    padding:5px
  
}
.cardmargin.v-card.v-sheet.theme--light {
    margin: 90px;
}

.card-5 {
  box-shadow: 0 19px 38px rgba(0,0,0,0.30), 0 15px 12px rgba(0,0,0,0.22);
}
h2 {
    margin-bottom: 20px;
}
</style>
