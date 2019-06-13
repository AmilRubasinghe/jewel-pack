<template>
  <div id="app">
    <v-app id="inspire">
      <v-container grid-list-md text-xs-center>
        <v-layout row wrap justify-space-between>
          <v-flex v-for="(item, i) in products" :key="i" xs4 class="pr-2">
            <br>
            <v-card light ripple>
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
                <div class="mx-5">
                  <span
                    class="title blue--text"
                  >{{products[i].Size}}&nbsp;{{products[i].Colour}}&nbsp; Colour Box</span>
                  <br>
                  <v-rating readonly small dense background-color="orange" color="orange"></v-rating>
                  <span class="title">
                    <v-btn large color="info">{{products[i].Price}}</v-btn>
                  </span> &nbsp;
                  <del class>
                    <v-btn disabled>$50</v-btn>
                  </del>
                </div>
              </v-card-title>
              <v-card-actions>
                <v-btn
                  large
                  round
                  depressed
                  color="#29B6F6"
                  outline
                  class="mx-auto"
                  @click="productPreview(products[i])"
                >View</v-btn>
              </v-card-actions>
            </v-card>
          </v-flex>
        </v-layout>
      </v-container>

      <v-layout row justify-center>
        <v-dialog v-model="dialog" max-width="1200px">
          <v-card v-if="selectedItem">
            <v-card-text>
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
      <v-img
        :aspect-ratio="4/3"
        :src="selectedItem.Image"
      >
        <v-expand-transition>
          <div
            v-if="hover"
            class="d-flex transition-fast-in-fast-out orange darken-2 v-card--reveal display-3 white--text"
            style="height: 50%;"
          >
            $14.99
          </div>
        </v-expand-transition>
      </v-img>
       </v-card>
  </v-hover>

                    <!--<v-card-text class="text-xs-center">
          <h6 class="category text-gray font-weight-thin mb-3">CEO / CO-FOUNDER</h6>

          <h4 class="card-title font-weight-light">Alec Thompson</h4>

          <p
            class="card-description font-weight-light"
          >Don't be scared of the truth because we need to restart the human foundation in truth And I love you like Kanye loves Kanye I love Rick Owens’ bed design but the back is...</p>

          <v-btn color="success" round class="font-weight-light">Follow</v-btn>
                    </v-card-text>-->
                  </v-flex>

                  <v-flex xs12 md6>
                    <h3
                      class="card-title font-weight-light"
                      
                    >{{selectedItem.Size}}&nbsp;{{selectedItem.Colour}}&nbsp; Colour Box</h3>
                    <p
                      class="card-description font-weight-light"
                    >Don't be scared of the truth because we need to restart the human foundation in truth And I love you like Kanye loves Kanye I love Rick Owens’ bed design but the back is...</p>

     <v-hover>
    <v-card>
   <!--   slot-scope="{ hover }"
      class="mx-auto"
      color="grey lighten-4"
      max-width="600"
    >
       <v-img
        :aspect-ratio="16/9"
        src="https://cdn.vuetifyjs.com/images/cards/kitchen.png"
      >
        <v-expand-transition>
          <div
            v-if="hover"
            class="d-flex transition-fast-in-fast-out orange darken-2 v-card--reveal display-3 white--text"
            style="height: 100%;"
          >
            $14.99
          </div>
        </v-expand-transition>
      </v-img>--->
      <v-card-text
        class="pt-4"
        style="position: relative;"
      >
        <v-btn
          absolute
          color="orange"
          class="white--text"
          fab
          large
          right
          top
        >
          <v-icon>shopping_cart</v-icon>
        </v-btn>
        <div class="font-weight-light grey--text title mb-2">For the perfect meal</div>
        <h3 class="display-1 font-weight-light orange--text mb-2">QW cooking utensils</h3>
        <div class="font-weight-light title mb-2">
          Our Vintage kitchen utensils delight any chef.<br>
          Made of bamboo by hand
        </div>
      </v-card-text>
    </v-card>
  </v-hover>
                    <!-- <form>
          <v-text-field
            v-validate="'required|max:10'"
            :counter="10"
            :error-messages="errors.collect('name')"
            label="Name"
            data-vv-name="name"
            required
          ></v-text-field>

          <v-text-field
            v-validate="'required|email'"
            :error-messages="errors.collect('email')"
            label="E-mail"
            data-vv-name="email"
            required
          ></v-text-field>

          <v-select
            v-validate="'required'"
            :error-messages="errors.collect('select')"
            label="Select"
            data-vv-name="select"
            required
          ></v-select>

           <v-card-actions>
             
              <v-btn color="blue darken-1" flat @click="dialog = false">Close</v-btn>
              <v-btn color="blue darken-1" flat @click="dialog = false">Save</v-btn>
            </v-card-actions>
                    </form>-->
                    <v-card-actions>
                      <v-btn color="blue darken-1" flat @click="dialog = false">Close</v-btn>
                      <v-btn color="blue darken-1" flat @click="dialog = false">Save</v-btn>
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

export default {
  data() {
    return {
      dialog: false,
      products: [],
      selectedItem: null
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

    productPreview(item) {
      this.selectedItem = item;
      this.dialog = true;
    }
  }
};
</script>



<style>
.v-card--reveal {
  align-items: center;
  bottom: 0;
  justify-content: center;
  opacity: .5;
  position: absolute;
  width: 100%;
}
</style>
=======
>>>>>>> 4157615e19a397edde3b01e5cf199850502cebe0


