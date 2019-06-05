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
        <v-dialog v-model="dialog" persistent max-width="1200px">
          <v-card v-if="selectedItem">
           
            <v-card-text>
              <v-container grid-list-md>
                <div class="card">
                  <div class="container-fliud">
                    <div class="wrapper row">
                      <div class="preview col-md-6">
                        <div class="preview-pic tab-content">
                          <div class="tab-pane active" id="pic-1">
                            <img
                              src="https://scontent.fcmb4-1.fna.fbcdn.net/v/t31.0-8/11082394_1621552601423978_714322575191341730_o.jpg?_nc_cat=109&_nc_ht=scontent.fcmb4-1.fna&oh=b486cb956bd83984c231d40ccda45316&oe=5CDD36C4"
                            >
                          </div>
                          <div class="tab-pane" id="pic-2">
                            <img
                              src="https://images.pexels.com/photos/371102/pexels-photo-371102.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                            >
                          </div>
                          <div class="tab-pane" id="pic-3">
                            <img
                              src="https://images.pexels.com/photos/371102/pexels-photo-371102.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                            >
                          </div>
                          <div class="tab-pane" id="pic-4">
                            <img
                              src="https://images.pexels.com/photos/371102/pexels-photo-371102.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                            >
                          </div>
                        </div>
                        <ul class="preview-thumbnail nav nav-tabs">
                          <li class="active">
                            <a data-target="#pic-1" data-toggle="tab">
                              <img
                                src="https://scontent.fcmb4-1.fna.fbcdn.net/v/t31.0-8/11082394_1621552601423978_714322575191341730_o.jpg?_nc_cat=109&_nc_ht=scontent.fcmb4-1.fna&oh=b486cb956bd83984c231d40ccda45316&oe=5CDD36C4"
                              >
                            </a>
                          </li>
                          <li>
                            <a data-target="#pic-2" data-toggle="tab">
                              <img
                                src="https://scontent.fcmb4-1.fna.fbcdn.net/v/t31.0-8/11082394_1621552601423978_714322575191341730_o.jpg?_nc_cat=109&_nc_ht=scontent.fcmb4-1.fna&oh=b486cb956bd83984c231d40ccda45316&oe=5CDD36C4"
                              >
                            </a>
                          </li>
                          <li>
                            <a data-target="#pic-3" data-toggle="tab">
                              <img
                                src="https://scontent.fcmb4-1.fna.fbcdn.net/v/t31.0-8/11082394_1621552601423978_714322575191341730_o.jpg?_nc_cat=109&_nc_ht=scontent.fcmb4-1.fna&oh=b486cb956bd83984c231d40ccda45316&oe=5CDD36C4"
                              >
                            </a>
                          </li>
                          <li>
                            <a data-target="#pic-4" data-toggle="tab">
                              <img
                                src="https://scontent.fcmb4-1.fna.fbcdn.net/v/t31.0-8/11082394_1621552601423978_714322575191341730_o.jpg?_nc_cat=109&_nc_ht=scontent.fcmb4-1.fna&oh=b486cb956bd83984c231d40ccda45316&oe=5CDD36C4"
                              >
                            </a>
                          </li>
                          <li>
                            <a data-target="#pic-5" data-toggle="tab">
                              <img
                                src="https://scontent.fcmb4-1.fna.fbcdn.net/v/t31.0-8/11082394_1621552601423978_714322575191341730_o.jpg?_nc_cat=109&_nc_ht=scontent.fcmb4-1.fna&oh=b486cb956bd83984c231d40ccda45316&oe=5CDD36C4"
                              >
                            </a>
                          </li>
                        </ul>
                      </div>
                      <div class="details col-md-6">
                        <h3 class="product-title">{{selectedItem.Size}} &nbsp; Black Gold Line Box</h3>
                        <div class="rating">
                          <div class="stars">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                          </div>
                          <span class="review-no">41 reviews</span>
                        </div>
                        <p class="product-description">1 x 1 inches (2.5 x 2.5 cm)</p>
                        <h4 class="price">
                          current price:
                          <span>$180</span>
                        </h4>
                        <p class="vote">
                          <strong>91%</strong> of buyers enjoyed this product!
                          <strong>(87 votes)</strong>
                        </p>
                        <h5 class="sizes">
                          sizes:
                          <span class="size" data-toggle="tooltip" title="small">s</span>
                          <span class="size" data-toggle="tooltip" title="medium">m</span>
                          <span class="size" data-toggle="tooltip" title="large">l</span>
                          <span class="size" data-toggle="tooltip" title="xtra large">xl</span>
                        </h5>
                        <h5 class="colors">
                          colors:
                          <span
                            class="color orange not-available"
                            data-toggle="tooltip"
                            title="Not In store"
                          ></span>
                          <span class="color green"></span>
                          <span class="color blue"></span>
                        </h5>
                        <div class="action">
                          <button class="add-to-cart btn btn-default" type="button">add to cart</button>
                          <button class="like btn btn-default" type="button">
                            Add Review
                            <span class="fa fa-heart"></span>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </v-container>
              <small>*indicates required field</small>
            </v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" flat @click="dialog = false">Close</v-btn>
              <v-btn color="blue darken-1" flat @click="dialog = false">Save</v-btn>
            </v-card-actions>
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




