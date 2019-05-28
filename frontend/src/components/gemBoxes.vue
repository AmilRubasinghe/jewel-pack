<template>
  <div id="app">
    <v-app id="inspire">
      <v-container grid-list-md text-xs-center>
        <v-layout row wrap justify-space-between>
          <v-flex  v-for="(item, i) in products" :key="i" xs4 class="pr-2">
            <br>
            <v-card light ripple>
              <v-img
                contain
                class="white--text"
                align="center"
                :src=products[i].Image
              >
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
                  <span class="title blue--text">{{products[i].Size}}</span>
                  <br>
                  <v-rating
                    readonly
                    small
                    dense
                    background-color="orange"
                    color="orange"
                    
                  ></v-rating> 
                  <span class="title">
                    <v-btn large color="info">{{products[i].Price}}</v-btn>
                  </span> &nbsp
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
                  color=red
                  outline
                  class="mx-auto"
                  
                >ADD TO CART</v-btn>
              </v-card-actions>
            </v-card>
          </v-flex>
        </v-layout>
      </v-container>
    </v-app>
  </div>
</template>



<script>

import axios from 'axios'

export default {

     data(){
        return{
         products: [],
        }
     
    },

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
    }
  }
};
</script>