<template>
  <div>
    <v-item-group v-model="selected" multiple max="12" active-class="primary">
      <v-container grid-list-md>
        <v-layout wrap>
          <v-flex v-for="(item,i) in products" :key="item.PID" xs9 md4>
            <v-hover>
              <v-item>
                <v-card
                  slot-scope="{ active, toggle }"
                  :color="active ? '' : ''"
                  class="d-flex align-center"
                  height="200"
                  @click="toggle"
                >
                  <v-img :aspect-ratio="2/1.1" :src="products[i].Image1">
                    <v-scroll-y-transition>
                      <div
                        v-if="active || hover"
                        class="display-2 text-xs-center d-flex transition-fast-in-fast-out orange darken-2 v-card--reveal display-3 white--text"
                        style="height: 100%;"
                      >Selected</div>
                    </v-scroll-y-transition>
                  </v-img>
                </v-card>
              </v-item>
            </v-hover>
          </v-flex>
        </v-layout>
      </v-container>
    </v-item-group>
    <v-layout row wrap justify-center>
      <v-flex md4 xs6 sm4>
        <v-btn
          block 
          color="#FFAB00"
          outline-color="#000000"
          class="ma-2"
          :loading="loading"
          :disabled="loading"
          
          @click="loader = 'loading'"
        >Accept Terms</v-btn>
      </v-flex>
    </v-layout>
  </div>
</template>

<script>
import axios from "axios";
import AOS from "aos";
import "aos/dist/aos.css"; // You can also use <link> for styles
// ..

export default {
  data() {
    return {
      products: [],
      selected: [],
      sss: {},
      item: [],
      hover: null,
      loader: null,
      loading: false
    };
  },
  mounted() {
    this.productItems();
  },
  watch: {
    loader() {
      const l = this.loader;
      this[l] = !this[l];

      setTimeout(() => (this[l] = false), 3000);

      this.loader = null;
      this.loaderNumber();
    }
  },

  methods: {
    productItems() {
      axios
        .get(this.$baseUrl + "/products")
        .then(response => {
          this.products = response.data.product;

          this.checkSelected();
         // console.log(this.products);
        })
        .catch(error => {
          console.log(error.response);
          console.log("ERROR");
        });
    },

    checkSelected() {
      /* this.products.forEach(function(element) {
        console.log('outside if');
        if (element.isSelected) {
          console.log(element);
          this.selected.push(element);
        }
      });*/

      for (var index in this.products) {
          
        if (this.products[index].isSelected) {
          //console.log(parseInt(index, 10));
          this.selected.push(parseInt(index, 10));
          //console.log(this.products[index]);
        }

      }

      

   //  console.log(this.selected);
    },

    loaderNumber() {
      console.log("***************");
      let $Token = localStorage.getItem("token");

      for (var i = 0; i < this.selected.length; i++) {
        this.item[i] = this.products[this.selected[i]].PID;
      }
      console.log(this.item);
      axios
        .post(this.$baseUrl + "/addHomeProduct?token=" + $Token, {
          PIDList: this.item
        })

        .then(response => {
          console.log(response.data);

          this.productItems();
          console.log("Home Product Succesfully Added");
        })
        .catch(error => {
          console.log(error.response);
          console.log("ERROR");
        });
    }
  }
};
</script>