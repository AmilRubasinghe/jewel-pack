<template>
  <div id="app">
    <v-app id="inspire">
      <div>
        <v-parallax
          height="110"
          src="http://localhost:8000/storage/home/product4.png"
          lazy-src="https://jewelpack.tk/storage/loader/CompleteZanyIlsamochadegu-small.gif"
        >
          <h1 class="header" style=" border: 1px solid #eabf00; ">
            <p
              data-aos="fade-up"
              class="display-1 font-weight-bold"
              style="color:#eabf00; align:left;"
            >{{pageTitle}}</p>
          </h1>
        </v-parallax>

        <v-container v-if="searchMode">
          <v-card flat style="background-color:#FBC02D; border: 1px solid #212121; ">
            <v-layout row wrap align-center justify-center>
              <v-flex xs10 sm10 md9 lg8 xl8>
                <v-text-field
                  label="Search"
                  outline
                  v-model="keywords"
                  color="#E65100"
                  placeholder="Find your box using color,size"
                  autofocus
                  onblur="this.focus()"
                ></v-text-field>
              </v-flex>
              <v-btn icon @click="search" large>
                <v-icon large color="#E65100">search</v-icon>
              </v-btn>
            </v-layout>
          </v-card>
        </v-container>

        <v-card flat height="110" style="background-color:#FBC02D;">
          <v-card flat class="toolbarSearch" style="background-color:#FBC02D;">
            <v-layout align-center justify-center>
              <v-toolbar flat style="background-color:#FBC02D;">
                <v-toolbar-title>Sorting</v-toolbar-title>
                <v-spacer></v-spacer>
                <v-toolbar-items>
                  <v-flex xs12 sm6 md5 d-flex>
                    <v-select
                      :items="sortCategories"
                      label="Sort by"
                      outline
                      menu-props
                      v-model="sortCat"
                    ></v-select>
                  </v-flex>

                  <v-flex xs12 sm6 md5 d-flex offset-sm1>
                    <v-select
                      label="Order"
                      :items="sortAscOrDesc"
                      item-text="text"
                      item-value="value"
                      v-model="sortOrder"
                      outline
                      menu-props
                    ></v-select>
                  </v-flex>
                </v-toolbar-items>
              </v-toolbar>
            </v-layout>
          </v-card>
        </v-card>
        <v-container>
          <v-layout
            row
            wrap
            align-center
            :class="{'justify-center': $vuetify.breakpoint.smAndDown, 'justify-left': $vuetify.breakpoint.mdAndUp}"
          >
            <v-flex v-for="(item, i) in products" :key="i" lg3 md3 xs10 sm4 class="pr">
              <transition-group name="staggered-fade" tag="v-card">
                <v-card
                  class="card-5 Product"
                  style="cursor: pointer"
                  light
                  ripple
                  align="center"
                  @click="productPreview(products[i])"
                  :key="item.PID"
                >
                  <div class="image-box">
                    <v-img
                      :aspect-ratio="4/3"
                      contain
                      align="right"
                      :src="products[i].Image1"
                      lazy-src="https://jewelpack.tk/storage/loader/CompleteZanyIlsamochadegu-small.gif"
                      transition="scale-transition"
                    ></v-img>
                  </div>

                  <v-card-title>
                    <v-layout colum wrap align-center justify-center>
                      <v-flex md11 lg11 xs11 sm11 offset-sm0>
                        <span>
                          <p
                            data-aos="fade-up"
                            class="subtitle-1 font-weight-medium"
                            style="color:#212121;"
                          >{{products[i].Size}} {{products[i].Colour}} Box</p>
                        </span>
                      </v-flex>
                      <v-flex md11 lg11 xs11 sm11 offset-sm0>
                        <v-rating
                          data-aos="zoom-in-up"
                          readonly
                          :value="4"
                          dense
                          hover
                          background-color="amber accent-4"
                          color="amber accent-3"
                        ></v-rating>
                      </v-flex>
                      <v-flex md11 lg11 xs11 sm11 offset-sm0>
                        <p
                          v-if="products[i].Quantity"
                          class="subtitle-2 font-weight-medium"
                          style="color:#1B5E20;"
                        >In Stock</p>

                        <p
                          v-if="!products[i].Quantity"
                          class="subtitle-2 font-weight-medium"
                          style="color:#D50000;"
                        >Out of Stock</p>
                      </v-flex>
                      <v-flex md11 lg11 xs11 sm11 offset-sm0>
                        <v-layout row wrap align-center justify-center>
                          <del class style="color:#616161;">
                            <p
                              v-if="products[i].slashedPrice"
                              data-aos="fade-up"
                              class="subtitle-1 font-weight-medium"
                              style="color:#616161;"
                            >{{products[i].slashedPrice}}LKR</p>
                          </del>
                          &nbsp; &nbsp;
                          <p
                            class="headline font-weight-bold"
                            data-aos="fade-up"
                            style="color:#212121;"
                          >{{products[i].Price}}LKR</p>
                        </v-layout>
                      </v-flex>
                    </v-layout>
                  </v-card-title>

                  <v-card-actions>
                    <v-layout row wrap align-center justify-center>
                      <v-flex md11 lg11 xs11 sm11 offset-sm0>
                        <div class="text-center">
                          <v-btn
                            dark
                            block
                            color="#212121"
                            outline-color="#ffffff"
                            @click="productPreview(products[i])"
                          >Product View</v-btn>
                        </div>
                      </v-flex>
                    </v-layout>
                  </v-card-actions>
                </v-card>
              </transition-group>
            </v-flex>
          </v-layout>
        </v-container>
      </div>

    
        <v-dialog v-model="dialog" max-width="1250px" >
          <v-card class="card-5" v-if="selectedItem">
            <v-card-text>
              <button type="button" class="close" aria-label="Close" flat @click="dialog = false">
                <span aria-hidden="true">×</span>
              </button>
              <v-container grid-list-md>
                <!--................................-->
                <v-layout row>
                  <v-flex xs12 md6 lg6 sm12>
                    <!--<v-hover>
                      <v-card
                        
                        class="mx-auto"
                        color="grey lighten-4"
                        max-width="600"
                      >
                      <v-img :aspect-ratio="4/3.6" :src="selectedItem.Image">
                          <v-expand-transition>
                            <div
                              v-if="hover"
                              class="d-flex transition-fast-in-fast-out orange darken-2 v-card--reveal display-3 white--text"
                              style="height: 75%;"
                            >$ {{selectedItem.Price}}</div>
                          </v-expand-transition>
                        </v-img>
                      </v-card>
                    </v-hover>-->

                    <section class="gallery">
                      <div class="carousel">
                        <input type="radio" id="image1" name="gallery-control" checked />
                        <input type="radio" id="image2" name="gallery-control" />
                        <input type="radio" id="image3" name="gallery-control" />
                        <input type="radio" id="image4" name="gallery-control" />

                        <div class="wrap">
                          <figure>
                            <label for="fullscreen">
                              <img
                                contain
                                :src="selectedItem.Image1"
                                lazy-src="https://jewelpack.tk/storage/loader/CompleteZanyIlsamochadegu-small.gif"
                                transition="scale-transition"
                              />
                            </label>
                          </figure>

                          <figure>
                            <label for="fullscreen">
                              <img
                              v-if="selectedItem.Image2"
                                contain
                                :src="selectedItem.Image2"
                                lazy-src="https://jewelpack.tk/storage/loader/CompleteZanyIlsamochadegu-small.gif"
                                transition="scale-transition"
                              />
                            </label>
                          </figure>

                          <figure>
                            <label for="fullscreen">
                              <img
                               v-if="selectedItem.Image3"
                                contain
                                :src="selectedItem.Image3"
                                lazy-src="https://jewelpack.tk/storage/loader/CompleteZanyIlsamochadegu-small.gif"
                                transition="scale-transition"
                              />
                            </label>
                          </figure>
                          <figure>
                            <label for="fullscreen">
                              <img
                               v-if="selectedItem.Image4"
                                contain
                                :src="selectedItem.Image4"
                                lazy-src="https://jewelpack.tk/storage/loader/CompleteZanyIlsamochadegu-small.gif"
                                transition="scale-transition"
                              />
                            </label>
                          </figure>
                        </div>

                        <div class="thumbnails">
                          <v-flex xs6 md6 lg6 sm6>
                            <div class="slider">
                              <div class="indicator"></div>
                            </div>

                            <label for="image1" class="thumb">
                              <img
                                contain
                                :src="selectedItem.Image1"
                                lazy-src="https://jewelpack.tk/storage/loader/CompleteZanyIlsamochadegu-small.gif"
                                transition="scale-transition"
                              />
                            </label>

                            <label for="image2" class="thumb">
                              <img
                               v-if="selectedItem.Image2"
                                contain
                                :src="selectedItem.Image2"
                                lazy-src="https://jewelpack.tk/storage/loader/CompleteZanyIlsamochadegu-small.gif"
                                transition="scale-transition"
                              />
                            </label>

                            <label for="image3" class="thumb">
                              <img
                               v-if="selectedItem.Image3"
                                contain
                                :src="selectedItem.Image3"
                                lazy-src="https://jewelpack.tk/storage/loader/CompleteZanyIlsamochadegu-small.gif"
                                transition="scale-transition"
                              />
                            </label>

                            <label for="image4" class="thumb">
                              <img
                               v-if="selectedItem.Image4"
                                contain
                                :src="selectedItem.Image4"
                                lazy-src="https://jewelpack.tk/storage/loader/CompleteZanyIlsamochadegu-small.gif"
                                transition="scale-transition"
                              />
                            </label>
                          </v-flex>
                        </div>
                      </div>
                    </section>
                  </v-flex>

                  <v-flex class="details" xs12 md5 lg5 sm12>
                    <v-layout column>
                      <v-flex d-flex>
                      <p
                        class="headline font-weight-medium "
                        style="color:#eabf00;"
                      >{{selectedItem.Size}}&nbsp;{{selectedItem.Colour}}&nbsp;Box</p>
                      </v-flex>
                      <v-flex d-flex>
                      <p
                        class="subtitle-1 font-weight-medium"
                        style="color:#616161;"
                      >{{selectedItem.description}}</p>
                      </v-flex>
                      <v-divider></v-divider>

                      <!-- <table class="a-lineitem">
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
                            >$ {{selectedItem.slashedPrice}}</span>
                            <span id="dealprice_shippingmessage" class="a-size-medium">
                              <span id="price-shipping-message" class="a-size-base a-color-base"></span>
                            </span>
                          </td>
                        </tr>
                        <tr id="priceblock_dealquantity_row">
                          <td
                            id="priceblock_dealquantity_lbl"
                            class="a-color-secondary a-size-base a-text-right a-nowrap"
                          >Lot Size:</td>
                          <td class="a-span12">
                            <v-flex xs12 sm12 md11 d-flex offset-xs0 offset-lg1>
                              <v-select label="Sizes" :items="sizes" v-model.number="size"></v-select>
                            </v-flex>
                          </td>
                        </tr>

                        <tr id="quantity_row">
                          <td
                            id="quantity_lbl"
                            class="a-color-secondary a-size-base a-text-right a-nowrap"
                          >
                           <p  class="subtitle-2 font-weight-regular"
                          style="color:#616161;">
                          Quantity:</p></td>
                          <td class="a-span12">
                            <span id="quantity" class="a-size-medium a-color-quantity">
                              <div class="minusplusnumber">
                                <div class="mpbtn minus" v-on:click="decrement()">-</div>
                                <div id="field_container">
                                  <input
                                    @change="valid()"
                                    type="number"
                                    v-model.number="value"
                                    onkeydown="javascript: return event.keyCode == 69 ? false : true"
                                  />
                                </div>
                                <div class="mpbtn plus" v-on:click="increment()">+</div>
                              </div>
                            </span>
                          </td>
                        </tr>
                      </tbody>
                      </table>-->
                     
                       
                              <v-flex d-flex>
                                <p
                                  class="display-1 font-weight-bold"
                                  style="color:#212121;"
                                >{{selectedItem.Price}}.00 LKR</p>
                              </v-flex>


                              <v-flex d-flex>
                                <v-layout row wrap>
                                  <v-flex md5 lg5 xs7 sm7 offset-sm0>
                                    <del class style="color:#616161;">
                                      <p
                                        v-if="selectedItem.slashedPrice"
                                        class="subtitle-1 font-weight-medium"
                                        style="color:#616161;"
                                      >&nbsp; &nbsp; {{selectedItem.slashedPrice}}.00 LKR &nbsp; &nbsp;</p>
                                    </del>
                                  </v-flex>
                                  <v-flex md1 lg1 xs2 sm2>
                                    <p
                                      v-if="selectedItem.slashedPrice && (selectedItem.slashedPrice>selectedItem.Price)"
                                      class="subtitle-1 font-weight-medium"
                                      style="color:#C62828;"
                                    >{{(((selectedItem.slashedPrice-selectedItem.Price)*100)/selectedItem.slashedPrice).toFixed()}}%Discount</p>
                                  </v-flex>
                                 
                                </v-layout>
                              </v-flex>

                           

                        <v-flex d-flex>
                          <v-layout row wrap>
                            <v-flex md2 sm4 lg2 xs4 d-flex>
                              <p
                                class="subtitle-2 font-weight-regular lotsize"
                                style="color:#616161;"
                              >Lot Size:</p>
                            </v-flex>

                            <v-flex md5 sm7 lg5 xs d-flex>
                              <v-select
                               v-model="select"
                                
                                label="Select"
                                :items="sizes"
                                item-text="lotquantity"
                                item-value="lid"
                                v-model.number="size"
                              ></v-select>
                            </v-flex>
                          </v-layout>
                        </v-flex>

                        <v-flex d-flex>
                          <v-layout row wrap>
                            <v-flex md2 sm4 lg2 xs4 d-flex>
                              <p
                                class="subtitle-2 font-weight-regular"
                                style="color:#616161;"
                              >Quantity:</p>
                            </v-flex>

                            <v-flex md6 sm8 lg6 xs8 d-flex>
                              <span id="quantity" class="a-size-medium a-color-quantity">
                                <div class="minusplusnumber">
                                  <div class="mpbtn minus" v-on:click="decrement()">-</div>
                                  <div id="field_container">
                                    <input
                                      style="color:#212121;"
                                      @change="valid()"
                                      type="number"
                                      v-model.number="value"
                                      onkeydown="javascript: return event.keyCode == 69 ? false : true"
                                    />
                                  </div>
                                  <div class="mpbtn plus" v-on:click="increment()">+</div>
                                </div>
                              </span>
                            </v-flex>
                          </v-layout>
                        </v-flex>

                        <v-flex md6 sm12 lg6 xs12 d-flex>
                          <div class="text-xs- mt-5">
                            <v-rating
                              color="yellow darken-3"
                              background-color="grey darken-1"
                              empty-icon="$vuetify.icons.ratingFull"
                              half-increments
                              hover
                            ></v-rating>
                          </div>
                        </v-flex>

                      
                      <v-divider></v-divider>

                      <v-card-actions>
                        <v-layout row wrap>
                          <v-flex d-flex>
                            <v-btn
                              dark
                              block
                              color="#212121"
                              outline-color="#ffffff"
                              @click="addToCart(selectedItem,value)"
                            >Add to cart</v-btn>
                          </v-flex>
                          
                         
                          <v-flex d-flex>
                            <v-btn block color="#eabf00" outline-color="#ffffff">Buy Now</v-btn>
                          </v-flex>

                        </v-layout>
                      </v-card-actions>
                      

                    </v-layout>
                  </v-flex>
                </v-layout>

                <!--..............................-->
              </v-container>
            </v-card-text>
          </v-card>
        </v-dialog>
      
    </v-app>
  </div>
</template>



<script>
import axios from "axios";
import Vue from "vue";
import _ from "lodash";
import AOS from "aos";
import "aos/dist/aos.css";

export default {
  props: ["pageTitle", "products", "searchMode"],

  data() {
    return {
      displayInfo: false,
      items: [1, 2, 3, 4, 5, 6, 7, 8, 9],
      page: 1,
      dialog: false,
      products: [],
      selectedItem: null,
      value: 0,
      max: 500,
      min: 0,
      newValue: 0,
      size: 0,
      keywords: "",

      sizes: [],
      sortCategories: ["Size", "Price"],
      sortCat: "Size",
      sortAscOrDesc: [
        { text: "Ascending", value: "asc" },
        { text: "Descending", value: "desc" }
      ],
      sortOrder: "asc",
      debounceKey: ""
    };
  },

  watch: {
    // whenever keywords changes, this function will run
    keywords: function() {
      this.getResult();
    },
    sortCat: function() {
      this.sortProducts();
    },
    sortOrder: function() {
      this.sortProducts();
    }
  },

  mounted() {
    this.productItems(this.$route.path);
    AOS.init({
      duration: 1000,
      once: true
    });
  },

  methods: {
    sel() {
      console.log(this.size);
    },

    sortProducts() {
      this.products = _.orderBy(this.products, this.sortCat, this.sortOrder);
    },

    getResult: _.debounce(
      function() {
        //console.log(this.keywords);
        this.search();
      },
      // This is the number of milliseconds we wait for the
      // user to stop typing.
      1500
    ),

    search() {
      const formData = new FormData();
      formData.append("keywords", this.keywords);

      axios
        .post(this.$baseUrl + "/search", formData)
        .then(response => {
          this.products = response.data.products;
          this.sortProducts();
        })
        .catch(error => {
          console.log(error.response);
          console.log("ERROR");
        });
    },

    productItems($path) {
      axios
        .get(this.$baseUrl + $path)
        .then(response => {
          this.products = response.data.product;
          this.sortProducts();
          this.pageTitle = this.$store.getters.getCategory.find(
            element => element.CID === this.products[0].CID
          ).CName;
        })
        .catch(error => {
          console.log(error.response);
          console.log("ERROR");
        });
    },

    productPreview(item) {
      this.selectedItem = item;
      this.size = 0;
      this.value = 0;

      console.log("*****************");
      console.log(this.selectedItem);
      const formData = new FormData();
      formData.append("PID", this.selectedItem.PID);
      console.log(this.selectedItem.PID);
      axios
        .post(this.$baseUrl + "/Lotquantity", formData)

        .then(response => {
          console.log(response.data.lotValue);
          this.sizes = response.data.lotValue;
          this.size=response.data.lotValue[0];
          this.dialog = true;

          console.log("Product lots Added");
        })
        .catch(error => {
          console.log(error.response);
          console.log("ERROR");
        });

      /* axios
    
        .get(this.$baseUrl + "/size/"+ item.PID)
        .then(response => {
          response.data.catItems.forEach(element => {
            this.category.push(element);
          });
        })
        .catch(error => {
          console.log(error.response);
          console.log("ERROR");
        });*/

      //this.dialog = true;
    },

    increment() {
      if (this.value >= this.selectedItem.Quantity) {
        alert("Available only " + this.selectedItem.Quantity + " units");
        this.value = this.selectedItem.Quantity;
      } else {
        this.value = this.value + this.size;
      }
    },
    decrement() {
      if (this.value <= this.min) {
        alert("Negative quantity not allowed");
        this.value = this.min;
      } else {
        this.value = this.value - this.size;
      }
    },

    addToCart(selectedItem) {
      this.$store.commit("addToCart", selectedItem);
    },

    getShippingMethod(selectedItem) {
      console.log("*****************");
      console.log(selectedItem);
      const formData = new FormData();
      formData.append("PID", this.selectedItem.PID);

      axios
        .post(this.$baseUrl + "/shippingMethod", formData)

        .then(response => {
          console.log(response.data.shipmethod);
          this.dialog = false;

          console.log("Product Succesfully Added");
        })
        .catch(error => {
          console.log(error.response);
          console.log("ERROR");
        });
    },

    valid() {
      if (this.value >= this.selectedItem.Quantity) {
         alert("Available only " + this.selectedItem.Quantity + " units");
        this.value = this.selectedItem.Quantity;
      } else if (this.value <= this.min) {
        alert("Negative quantity not allowed");
        this.value = this.min;
      }
    },

    addToCart(selectedItem, value) {
      // console.log(selectedItem);
      Vue.set(selectedItem, "qty", value);

      this.$store.commit("addToCart", selectedItem);
      this.dialog = false;
      this.value = 1;

      // console.log(value);

      //console.log(window.localStorage.getItem('cart'));
      //console.log(window.localStorage.getItem('cartCount'));
    }
  }
};
</script>


<style>
.lotsize {
  padding-top: 21px;
}
.discount {
  margin-left: 4px;
}

.card-5.Product.v-card.v-sheet.theme--light:hover {
  text-decoration: none;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
  box-shadow: 0 19px 38px rgba(0, 0, 0, 0.3), 0 18px 15px rgba(0, 0, 0, 0.22);
  border: 0.7px solid ;
 
}
.card-5.Product.v-card.v-sheet.theme--light:hover .v-btn__content {
  background-color: #eabf00;
}
.v-card__actions {
  align-items: center;
  /* display: flex; */
  /* padding: 8px; */
  padding-bottom: 8px;
}
.v-card__title {
  align-items: center;
  display: flex;
  flex-wrap: wrap;
  padding-top: 10px;
  padding-bottom: 0px;
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

  margin: 0;
}

.mt-5 {
  margin-top: 20px !important;
}

.cardmargin.v-card.v-sheet.theme--light {
  margin: 90px;
}

.card-5 {
  box-shadow: 0 19px 38px rgba(0, 0, 0, 0.3), 0 15px 12px rgba(0, 0, 0, 0.22);
}

h1.header {
  box-shadow: 0 19px 38px rgba(0, 0, 0, 0.3), 0 15px 12px rgba(0, 0, 0, 0.22);
}

.custom-font1 {
  font-family: "Dancing Script", cursive;
  font-size: 6em;
  color: #ffa000;
}

.custom-font3 {
  font-family: "Dancing Script", cursive;
  font-size: 2.5em;
  color: rgba(129, 91, 24, 0.788);
}


.product-description {
  font-family: "Rye", cursive;
  font-size: 2em;
  color: rgba(129, 91, 24, 0.788);
}

/*product preveiw*/
.gallery input[name$="control"] {
  display: none;
}

/*big photo size*/
.gallery .carousel {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: horizontal;
  -webkit-box-direction: normal;
  -ms-flex-direction: column;
  flex-direction: column;
  position: relative;
  height: 79vh;
  width: 100%;
}
/*both  display*/
.gallery .wrap {
  width: 100%;
  height: 100%;

  margin: 0 auto;
  overflow: hidden;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: horizontal;
  -webkit-box-direction: normal;
  -ms-flex-direction: row;
  flex-direction: row;
  -webkit-box-align: center;
  -ms-flex-align: center;
  align-items: center;
  -ms-flex-wrap: nowrap;
  flex-wrap: nowrap;
  margin-right: 20px;
}
/*big photo center*/
.gallery .wrap figure {
  padding-left: 0px;
  padding-right: 0px;
  margin-bottom: 0px;
  padding-bottom: 0px;
  height: 100%;
  min-width: 100%;
  -webkit-transition: opacity 0.25s ease-in-out 0.05s;
  transition: opacity 0.25s ease-in-out 0.05s;

  left: 0;
  -webkit-transform: translateX(0%);
  transform: translateX(0%);
  box-sizing: border-box;
  text-align: center;
  margin: 0;
  display: block;
  -webkit-box-align: center;
  -ms-flex-align: center;
  align-items: center;
  -webkit-box-pack: center;
  -ms-flex-pack: center;
  justify-content: center;
  opacity: 1;
}
/*big 4to ratio*/
.gallery .wrap figure label {
  cursor: zoom-in;
  height: auto;
  width: 100%;
  height: 100%;
  position: relative;
  display: block;
}
/*big photo ratio*/
.gallery .wrap figure img {
  cursor: inherit;
  height: auto;
  max-width: 100%;
  max-height: 100%;
  border-radius: 10px;
  margin: 0 auto;
  position: relative;
  top: 50%;
  -webkit-transform: translateY(-50%);
  transform: translateY(-50%);
}
/*small photo*/
.gallery .thumbnails {
  -webkit-box-flex: 1;
  -ms-flex: 1;
  flex: 1;
  min-width: 80px;
  max-height: 100%;
  height: auto;
  -webkit-box-flex: 0;
  -ms-flex-positive: 0;
  flex-grow: 0;
  -ms-flex-item-align: center;
  align-self: center;
  -ms-flex-preferred-size: auto;
  flex-basis: auto;
  position: relative;
  white-space: nowrap;
  overflow: hidden;
  overflow-y: hidden;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
  -ms-flex-direction: row;
  flex-direction: row;
  padding: 0 10px;
}
.gallery .thumbnails .thumb img {
  min-width: 110px;
  height: 90px;
  background-position: center center;
  background-size: cover;

  opacity: 0.7;
  margin: 0;
  -ms-flex-negative: 0;
  flex-shrink: 0;
  left: 0;

  cursor: pointer;
  -webkit-transition: all 0.3s ease-in-out;
  transition: all 0.3s ease-in-out;
  background-repeat: no-repeat;
}

/*large product*/
.gallery input#fullscreen:checked ~ .wrap figure {
  position: fixed;
  z-index: 10;
  height: 100vh;
  width: 100vw;
  padding: 0;
  top: 50%;
  left: 50%;
  -webkit-transform: translate(-50%, -50%) !important;
  transform: translate(-50%, -50%) !important;
  -webkit-animation-timing-function: ease-in-out;
  animation-timing-function: ease-in-out;
  -webkit-animation-fill-mode: backwards;
  animation-fill-mode: backwards;
}

/*zoom in smmoth chech out opasity*/
.gallery input#image1:checked ~ .wrap figure {
  -webkit-transform: translateX(0);
  transform: translateX(0);
}

.gallery input#image1:checked ~ .wrap figure:not(:nth-of-type(1)) {
  opacity: 0;
}
.gallery input#image1:checked ~ .thumbnails .slider {
  -webkit-transform: translateY(0);
  transform: translateY(0);
}
.gallery input#image1:checked ~ .thumbnails .thumb img:nth-of-type(1) {
  opacity: 1;
  cursor: default;
}
/*other product*/
.gallery input#image2:checked ~ .wrap figure {
  -webkit-transform: translateX(-100%);
  transform: translateX(-100%);
}
.gallery input#image2:checked ~ .wrap figure:not(:nth-of-type(2)) {
  opacity: 0;
}
.gallery input#image2:checked ~ .thumbnails .slider {
  -webkit-transform: translateY(100%);
  transform: translateY(100%);
}
.gallery input#image2:checked ~ .thumbnails .thumb:nth-of-type(2) {
  opacity: 1;
  cursor: default;
}
.gallery input#image3:checked ~ .wrap figure {
  -webkit-transform: translateX(-200%);
  transform: translateX(-200%);
}
.gallery input#image3:checked ~ .wrap figure:not(:nth-of-type(3)) {
  opacity: 0;
}
.gallery input#image3:checked ~ .thumbnails .slider {
  -webkit-transform: translateY(200%);
  transform: translateY(200%);
}
.gallery input#image3:checked ~ .thumbnails .thumb:nth-of-type(3) {
  opacity: 1;
  cursor: default;
}
.gallery input#image4:checked ~ .wrap figure {
  -webkit-transform: translateX(-300%);
  transform: translateX(-300%);
}
.gallery input#image4:checked ~ .wrap figure:not(:nth-of-type(4)) {
  opacity: 0;
}
.gallery input#image4:checked ~ .thumbnails .slider {
  -webkit-transform: translateY(300%);
  transform: translateY(300%);
}
.gallery input#image4:checked ~ .thumbnails .thumb:nth-of-type(4) {
  opacity: 1;
  cursor: default;
}

/************/

@-webkit-keyframes full {
  from {
    -webkit-transform: translate(-50%, -50%) scale(0.8);
    transform: translate(-50%, -50%) scale(0.8);
  }
  to {
    -webkit-transform: translate(-50%, -50%) scale(1);
    transform: translate(-50%, -50%) scale(1);
  }
}

@keyframes full {
  from {
    -webkit-transform: translate(-50%, -50%) scale(0.8);
    transform: translate(-50%, -50%) scale(0.8);
  }
  to {
    -webkit-transform: translate(-50%, -50%) scale(1);
    transform: translate(-50%, -50%) scale(1);
  }
}
@-webkit-keyframes shadow {
  from {
    box-shadow: 0 0 0 100vmin rgba(24, 33, 45, 0),
      0 0 10vmin rgba(13, 21, 31, 0);
  }
  to {
    box-shadow: 0 0 0 100vmin rgba(24, 33, 45, 0.6),
      0 0 10vmin rgba(13, 21, 31, 0.6);
  }
}
@keyframes shadow {
  from {
    box-shadow: 0 0 0 100vmin rgba(24, 33, 45, 0),
      0 0 10vmin rgba(13, 21, 31, 0);
  }
  to {
    box-shadow: 0 0 0 100vmin rgba(24, 33, 45, 0.6),
      0 0 10vmin rgba(13, 21, 31, 0.6);
  }
}

.theme--light.v-sheet {
  color: rgba(0, 0, 0, 0.87);
  padding: 1px;
}

.image-box .v-image {
  max-width: 100%;
  transition: all 0.3s;
  display: block;
  width: 100%;
  height: auto;
  transform: scale(1);
}

.image-box:hover .v-image {
  transform: scale(1.1);
}
.image-box {
  position: relative;
  margin: auto;
  overflow: hidden;
}
.image-box .content {
  position: absolute; /* Position the background text */
  bottom: 0; /* At the bottom. Use top:0 to append it to the top */
  background: rgb(0, 0, 0); /* Fallback color */
  background: rgba(0, 0, 0, 0.5); /* Black background with 0.5 opacity */
  color: #f1f1f1; /* Grey text */
  width: 100%; /* Full width */
  padding: 20px; /* Some padding */
  transition: 0.3s ease;
  opacity: 0;
  position: absolute;

  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
}

p.display-1.font-weight-bold.aos-init.aos-animate {
  padding-top: 10px;
  padding-bottom: 10px;
  padding-left: 77px;
}
.v-card.v-card--flat.v-sheet.theme--light {
  padding-top: 12px;
}
.details {
  margin: 35px;
}
</style>
