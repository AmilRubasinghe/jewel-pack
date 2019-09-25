<template>
  <div>
    <v-flex xs12 style="width:100%;">
      <v-carousel delimiter-icon="stop" interval="3000" hide-controls height="92vh">
        <v-carousel-item
          v-for="(item,i) in slideshowItems"
          :key="i"
          :src="item.path"
          lazy-src="https://jewelpack.tk/storage/loader/CompleteZanyIlsamochadegu-small.gif"
        ></v-carousel-item>
      </v-carousel>
    </v-flex>

    <v-card class="catogoryVeiw" flat max-height="800">
      <v-layout wrap>
        <v-flex d-flex xs12 sm6 md3>
          <v-layout wrap justify-center>
            <v-flex d-flexxs12 sm6 md10>
              <p
                data-aos="fade-up"
                class="display-2 font-weight-bold"
                style="color:#212121; align:center;"
              >Our Best Categories</p>
            </v-flex>
            <v-flex d-flex xs12 sm6 md9>
              <p
                data-aos="fade-up"
                class="title font-weight-medium"
                style="color:#616161; align:center;"
              >Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
            </v-flex>
          </v-layout>
        </v-flex>

        <v-flex v-for="(item, i) in categorys" :key="i" d-flex xs4 sm4 md3 lg3 .d-none .d-sm-flex>
          <v-card
            flat
            class="card category card-5 hidden-sm-and-down"
            color="grey lighten-4"
            max-width="300"
            max-height="500"
          >
            <v-img
              position="center"
              :aspect-ratio="3.2/4"
              :src="item.image"
              lazy-src="https://jewelpack.tk/storage/loader/loader.gif"
            ></v-img>
            <v-card-text>
              <p
                justify-center
                data-aos="fade-up"
                class="headline font-weight-medium"
                style="color:#212121; align:center;"
              >{{item.name}}</p>
            </v-card-text>
          </v-card>
        </v-flex>
      </v-layout>
    </v-card>
    <v-card class="photoAndIdea" flat max-height="800" width="100%">
      <v-layout row wrap align-center justify-center>
        <v-flex d-flex xs6 sm6 md5 lg5>
          <v-card width="100%" height="500" flat style="background-color:#eabf00;">
            <v-flex>
              <p data-aos="fade-up" class="custom-font4 font-weight-medium">
                <br />‘The Art of Gifting’
                <br />
              </p>
              <p
                data-aos="fade-up"
                data-aos-delay="50"
                class="title font-weight-medium"
                style="color:#312121; align:center;"
              >
                Our Group understands that
                <br />you sell jewellery and not packaging
                <br />and our goal is
                <br />to provide you with
                <br />quality packaging and
                <br />excellent service.
              </p>
            </v-flex>
          </v-card>
        </v-flex>

        <v-flex d-flex xs6 sm6 md7 lg7>
          <v-parallax
            height="500"
            :src="img1"
            lazy-src="https://jewelpack.tk/storage/loader/CompleteZanyIlsamochadegu-small.gif"
          ></v-parallax>
        </v-flex>
      </v-layout>
    </v-card>

    <!--<v-layout wrap align-center justify-center justify-space-between>
      <v-flex xs12 sm12 md6 lg7>
        <v-parallax
          height="600"
          src="https://jewelpack.tk/storage/product/1566404772-1.jpeg"
          lazy-src="https://jewelpack.tk/storage/loader/CompleteZanyIlsamochadegu-small.gif"
        >
          <v-layout align-center column justify-center>
            <h1 style="align:center;" class="custom-font3">JewelPack</h1>
          </v-layout>
        </v-parallax>
      </v-flex>
      <v-flex xs12 sm12 md6 lg5>
        <v-card flat height="600">
          <v-layout align-center justify-center>
            <p style="color:#BF360C;" class="custom-font1">
              Great for
              <br />storage or display
              <br />of
              <br />Jewellary & Gems
            </p>
          </v-layout>
        </v-card>
      </v-flex>
    </v-layout>-->

    <!--slide end-->

    <!--...................newest product...................-->

    <v-card flat class="OurBestProducts">
      <v-flex d-flex>
        <p
          data-aos="fade-up"
          class="display-1 font-weight-bold"
          style="color:#212121; align:center;"
        >Our Best Products</p>
        <br />
        <br />
      </v-flex>

      <!--<v-layout wrap>
          <v-flex v-for="(item, i) in selectedProducts" :key="i" d-flex xs12 sm6 md3>
            <v-card class="card product" color="blue-grey lighten-3" max-width="500">
              <div class="image-box">
                <v-img :aspect-ratio="3/3.1" :src="item.Image"></v-img>
                <div class="middle content">
                  <div class="text">{{item.Size}}&nbsp;{{item.Colour}}&nbsp;Colour Box</div>
                </div>
              </div>
            </v-card>
          </v-flex>
      </v-layout>-->
      <v-container>
        <v-layout row wrap align-center justify-center>
          <v-flex v-for="(item, i) in selectedProducts" :key="i" d-flex xs12 sm6 md3>
            <br />

            <v-card class="card product" style="cursor: pointer" align="center" max-width="500">
              <div class="image-box">
                <v-img :aspect-ratio="1/1" :src="item.Image1"></v-img>
              </div>

              <v-card-title>
                <v-layout colum wrap align-center justify-center>
                  <v-flex md11 lg11 xs11 sm11 offset-sm0>
                    <span>
                      <p
                        data-aos="fade-up"
                        class="subtitle-1 font-weight-regular"
                        style="color:#212121;"
                      >{{item.Size}} {{item.Colour}} Colour Box</p>
                    </span>
                  </v-flex>
                  <v-flex md11 lg11 xs11 sm11 offset-sm0>
                    <v-rating
                      data-aos="zoom-in-up"
                      readonly
                      :value="4"
                      dense
                      hover
                      background-color="#eabf00"
                      color="#eabf00"
                    ></v-rating>
                  </v-flex>

                  <v-flex md11 lg11 xs11 sm11 offset-sm0>
                    <v-layout row wrap align-center justify-center>
                      <del class style="color:#616161;">
                        <p
                          v-if="item.slashedPrice"
                          data-aos="fade-up"
                          class="subtitle-1 font-weight-medium"
                          style="color:#616161;"
                        >{{item.slashedPrice}}LKR</p>
                      </del>
                      &nbsp; &nbsp;
                      <p
                        class="headline font-weight-bold"
                        data-aos="fade-up"
                        style="color:#212121;"
                      >{{item.Price}}LKR</p>
                    </v-layout>
                  </v-flex>
                </v-layout>
              </v-card-title>
              <v-card-actions>
                <v-layout row wrap align-center justify-center>
                  <v-flex md11 lg11 xs11 sm11 offset-sm0>
                    <v-btn dark block color="#212121" outline-color="#ffffff">Product View</v-btn>
                  </v-flex>
                </v-layout>
              </v-card-actions>
            </v-card>
          </v-flex>
        </v-layout>
      </v-container>
    </v-card>

    <!-- ..............Jewellery display.............................-->

    <v-parallax
      :src="img2"
      lazy-src="https://jewelpack.tk/storage/loader/CompleteZanyIlsamochadegu-small.gif"
    >
      <v-layout align-center column justify-center color="blue">
        <h1 style="align:center;" class="custom-font3">JewelPack</h1>
      </v-layout>
    </v-parallax>

 <v-card flat class="getInTouch" style="background-color:#FBC02D;">
   <v-container>
   <v-layout row wrap >
     
      <v-flex xs4 sm4 md2 lg2 d-flex>
        
        <p
          data-aos="fade-up"
          class="display-1 font-weight-bold"
          style="color:#212121; align:left;"
        >Get In Touch</p>
        <br /><br />
        
      </v-flex>
      
       <v-flex xs5 sm5 md10 lg10  >
         <v-layout row wrap justify-end >
             <v-flex xs6 sm6 md3 lg3  >
          <v-btn
                 
                   
                    large
                    round
                   block 
                   
                    outline-color="#ffffff"
                    class="subtitle-1 font-weight-medium"
                    
                  >
                   
                    
                  Contact</v-btn>
             </v-flex>
         </v-layout>
       </v-flex>  
   </v-layout>
   </v-container>
 </v-card>

    <br />
  </div>
</template>

<script>
import axios from "axios";
import Store from "../store.js";
import AOS from "aos";
import "aos/dist/aos.css"; // You can also use <link> for styles
// ..

export default {
  data() {
    return {
      slideshowItems: [],
      selectedProducts: [],

      categorys: [
        {
          image: "http://localhost:8000/storage/product/1566405169-1.jpeg",
          name: "Gem boxes"
        },
        {
          image: "https://jewelpack.tk/storage/slideshow/1566380646-1.jpeg",
          name: "Jewellery boxes"
        },
        {
          image: "https://jewelpack.tk/storage/slideshow/1566380646-1.jpeg",
          name: "Gem boxes"
        }
      ]
    };
  },
  methods: {
    getSlideshow() {
      axios
        .get(this.$baseUrl + "/getImages")
        .then(response => {
          this.slideshowItems = response.data.images;
          console.log(this.slideshowItems);
        })
        .catch(error => {
          console.log(error.response);
          console.log("ERROR");
        });
    },
    Jphoto: function() {
      return this.$url + "storage/home/photo.png";
    },
    productSelectedItems() {
      axios
        .get(this.$baseUrl + "/selectedProducts")
        .then(response => {
          this.selectedProducts = response.data.selectedProducts;

          console.log(this.selectedProducts);
        })
        .catch(error => {
          console.log(error.response);
          console.log("ERROR");
        });
    }
  },

  mounted() {
    this.getSlideshow();
    this.productSelectedItems();
    AOS.init({
      duration: 1000,
      once: true
    });
  },

  computed: {
    img1: function() {
    
      return this.$url + 'storage/home/photo.jpeg'

    },

    img2: function() {
    
      return this.$url + 'storage/home/home.jpeg'

    },

    
  },
};
</script>

<style>
.getInTouch.v-card.v-card--flat.v-sheet.theme--light {
  margin-bottom: -90px;
  padding: 20px;
}
.search {
  padding: 40px;
  color: #d1c0e1;
  /*padding color:#8e85c0;*/
  /*border:1px solid;*/
  background-color: #e2e1ed;
}

h3 {
  font-family: cursive;
  font-size: xx-large;
  text-align: center;
}

span {
  color: #8383b6;
}
p {
  margin-bottom: 8px;
  margin: 0 0 10px;
  text-align: center;
  font-size: initial;
  margin-top: 5px;
}

.gallery_product {
  padding: 10px 10px;
  width: 30%;
}

img.img-responsive {
  padding: 10px;
  width: 33%;
  height: 25%;
  display: block;
  border: none;
  float: left;
}

h3.newest {
  padding: 25px;
}

.fa-cc-visa {
  color: #bd081c;
}

.card-5 {
  box-shadow: 0 19px 38px rgba(0, 0, 0, 0.3), 0 15px 12px rgba(0, 0, 0, 0.22);
}

.v-card v-card--flat v-sheet theme--light transparent.style {
  height: 0px;
}

.row-full {
  width: 100vw;
  position: relative;
  margin-left: -50vw;
  height: 100px;
  margin-top: 100px;
}

h4.ab.subtitle-2.headline.mb-1 {
  text-align: center;
}
.flex.d-flex {
  margin-bottom: auto;
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
.catogoryVeiw.v-card.v-card--flat.v-sheet.theme--light {
  padding-left: 50px;
  padding-right: 50px;
  padding-top: 70px;
  padding-bottom: 70px;
}
 .card.product.v-card.v-sheet.theme--light:hover{
   text-decoration: none;
  box-shadow: 0 1px 3px rgba(0,0,0,.3);
  box-shadow: 0 19px 38px rgba(0, 0, 0, 0.3), 0 18px 15px rgba(0, 0, 0, 0.22);
  border: 0.7px solid; 
        

} 
.card.product.v-card.v-sheet.theme--light:hover .v-btn__content{

background-color: #eabf00;


}

.OurBestProducts.v-card.v-card--flat.v-sheet.theme--light {
  padding-left: 50px;
  padding-right: 50px;
  padding-top: 70px;
  padding-bottom: 50px;
}

.custom-font1 {
  font-family: "Dancing Script", cursive;
}

.custom-font3 {
  font-family: "Fredericka the Great", cursive;
  color: #ffdf00;
  
}

.custom-font4 {
  font-family: "Abril Fatface", cursive;
}
.custom-font5 {
  font-family: "Eagle Lake", cursive;
  font-size: 6vw;
}

.v-responsive.v-image {
  margin-bottom: 0px;
}

@media screen and (min-width: 601px) {
  .custom-font1 {
    font-size: 70px;
  }
  .custom-font3 {
    font-size: 100px;
  }
  .custom-font4 {
    font-size: 40px;
  }
  .title {
    font-size: 30px;
  }
  .custom-font5 {
    font-family: "Eagle Lake", cursive;
    font-size: 45px;
  }
}

@media screen and (max-width: 600px) {
  .custom-font1 {
    font-size: 53px;
  }
  .title {
    font-size: 10px;
  }

  .custom-font3 {
    font-size: 70px;
  }

  .custom-font4 {
    font-size: 21px;
  }
  .custom-font5 {
    font-family: "Eagle Lake", cursive;
    font-size: 23px;
  }
}
.image {
  opacity: 1;
  display: block;
  width: 100%;
  height: auto;
  transition: 0.5s ease;
  backface-visibility: hidden;
}

.image-box:hover .image {
  opacity: 0.8;
}

.image-box:hover .middle {
  opacity: 1;
}

.text {
  color: white;
  font-size: 17px;
  padding: 16px 32px;
  text-align: center;
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
</style>
