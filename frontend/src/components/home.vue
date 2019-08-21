<template>
    <div>
  
  <v-flex xs12 style="width:100%;">
  <v-carousel
    delimiter-icon="stop"
    interval="3000"
    height="860px"
    hide-controls
        >
          <v-carousel-item v-for="(item,i) in slideshowItems" :key="i" :src="item.path"></v-carousel-item>
        </v-carousel>
        </v-flex>
        

<v-layout align-center justify-center>
  <v-card width=100% flat>
        <v-flex>
          <p data-aos="fade-up" class="custom-font4"><br>‘The Art of Gifting’<br></p>
          <p data-aos="fade-up" data-aos-delay="250" class="custom-font5">Our Group understands that<br> you sell jewellery and not packaging <br>and our goal is <br>to provide you with <br>quality packaging and <br>excellent service.</p>

                <v-layout align-center justify-center >
                  <v-card color="transparent" flat>
                  <div class="display-3 mb-5">
                   <i data-aos="zoom-in-up" data-aos-delay="500" class="far fa-gem" style="color:#212121;"></i>
                  </div>
                  <br>
                  </v-card>
                </v-layout>
              
        </v-flex>
        </v-card>
        </v-layout>

        
        <v-layout row wrap align-center justify-center justify-space-between>
          <v-flex xs12 sm12 md6 lg7>
            <v-parallax height=600 src="http://jewelpack.tk/storage/slideshow/1563280479-10519703_1621551864757385_30034616773715997_o.jpg">
              <v-layout align-center column justify-center>
                
                <h1
                  style="align:center;"
                  class="custom-font3 "
                >JewelPack</h1>
              </v-layout>
            </v-parallax>
          </v-flex>
          <v-flex xs12 sm12 md6 lg5>
            <v-card flat height=600>
            <v-layout align-center justify-center>
              <p style="color:#BF360C;" class="custom-font1 ">Great for<br> storage or display <br> of <br>Jewellary & Gems</p>
              
              
            </v-layout>
            </v-card>
          </v-flex>
        </v-layout>

        <!--slide end-->
       

       

        <!--...................newest product...................-->

        <div class="container">
          <div>
            <h3 class="newest">F E A T U R E D B O X</h3>
          </div>
        </div>
        <v-card flat
    max-heigt="1200"
    
  >
  <v-layout wrap>
         <v-flex v-for="(item, i) in items" :key="i" d-flex xs12 sm6 md3   >
       
         <v-card
                        
                         class="card product "
                        color="blue-grey lighten-3"
                        max-width="500"
                      >
                      <div class="image-box">
                        <v-img :aspect-ratio="3/3.1" :src="item.image">
                         
                        </v-img>
                      </div>  
                      </v-card>
                     
      </v-flex>
      


      
    </v-layout>
  </v-card>

  

  

      
           

        <!-- ..............Jewellery display.............................-->
        <div class="container"></div>

       
            <v-parallax src="http://jewelpack.tk/storage/slideshow/1563280490-11071592_1621554201423818_8781376146243943971_o.jpg">
              <v-layout align-center column justify-center color="blue">
                <h1
                  style="align:center;"
                  class="custom-font3 "
                >JewelPack</h1>
              </v-layout>
            </v-parallax>
          

        <v-card flat
    max-heigt="1000"
    color="brown lighten-5"
  >
  
<v-layout wrap>
      <v-flex d-flex xs12 sm6 md3>
         <v-layout wrap>
          <v-flex d-flex>
           <h2
                  style="color:#5D4037; align:center;"
                  class="display-3 font-weight-regular mb-3"
                >Shop By Category</h2> 
               
                
          </v-flex>
          <v-flex d-flex>
            
             
                <h4
                style="color:#A1887F; align:center;"
                  class="subtitle-2 font-weight-light mb-1"
                  
                >Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s
                  
                  </h4> 
               </v-flex>
              
        </v-layout>
       
    </v-flex>

       <v-flex  v-for="(item, i) in categorys" :key="i" d-flex xs12 sm6 md3>
       
         <v-card
                       
                         class="card category card-5"
                        color="grey lighten-4"
                        max-width="300"
                       max-height="430"
                        
                      >
                        <v-img :aspect-ratio="3.9/4.5" :src="item.image">
                         
                        </v-img>
                         <v-card-text> 
                            <h4
                style="color:#8D6E63"
                  class="ab subtitle-2 headline mb-1"
                  justify-center
                >{{item.name}}
                  
                  </h4> 
              </v-card-text>
                      </v-card>
                     
      </v-flex>
      
     
     
      
      
    </v-layout>
       
    
  
  </v-card>

  

        <v-container grid-list-md text-xs-center>
          <v-layout row wrap>
            <v-flex xs4 data-aos="fade-right">
              <v-card color="transparent" width="200" height="200" flat>
                <v-layout align-center column justify-center>
                  <div class="display-3 mb-1">
                    <i class="fab fa-cc-visa fa-3x" style="color:#212121;"></i>
                  </div>
                </v-layout>
              </v-card>
            </v-flex>

            <v-flex xs4 data-aos="fade-right" data-aos-delay="500">
              <v-card color="transparent" width="200" height="200" flat>
                <div class="display-3 mb-1">
                  <i class="fab fa-cc-mastercard fa-3x" style="color:#212121;"></i>
                </div>
              </v-card>
            </v-flex>

            <v-flex xs4 data-aos="fade-right" data-aos-delay="1000">
              <v-card color="transparent" width="200" height="200" flat>
                <div class="display-3 mb-1">
                  <i class="fab fa-cc-amex fa-3x" style="color:#212121;"></i>
                </div>
              </v-card>
            </v-flex>
          </v-layout>
        </v-container>
    <br>
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
      slideshowItems: [],
      items:[
        
        {
          image :"http://localhost:8000/storage/slideshow/1563280479-10519703_1621551864757385_30034616773715997_o.jpg"
        },
        
        {
          image :"http://localhost:8000/storage/slideshow/1563280479-10519703_1621551864757385_30034616773715997_o.jpg"
        },
         
        {
          image :"http://localhost:8000/storage/slideshow/1563280479-10519703_1621551864757385_30034616773715997_o.jpg"
        },
         {
          image :"http://localhost:8000/storage/slideshow/1563280479-10519703_1621551864757385_30034616773715997_o.jpg"
        },
         {
          image :"http://localhost:8000/storage/slideshow/1563280479-10519703_1621551864757385_30034616773715997_o.jpg"
        }
      ],
      categorys:[
        {
          image :"http://localhost:8000/storage/slideshow/1563280479-10519703_1621551864757385_30034616773715997_o.jpg",
          name :"Gem boxes"
        },
        {
          image :"http://localhost:8000/storage/slideshow/1563280479-10519703_1621551864757385_30034616773715997_o.jpg",
           name :"Jewellery boxes"
        },
        {
          image :"http://localhost:8000/storage/slideshow/1563280479-10519703_1621551864757385_30034616773715997_o.jpg",
          name :"Gem boxes"
        },
      ],
       
    };
  },
  methods: {
    getSlideshow() {
      axios
        .get(this.$baseUrl +"/getImages")
        .then(response => {
          this.slideshowItems = response.data.images;
          console.log(this.slideshowItems);
        })
        .catch(error => {
          console.log(error.response);
          console.log("ERROR");
        });
    }
  },

  mounted() {
    this.getSlideshow();
    AOS.init({
      duration: 1000,
      once: true,
      
    });
  }
};
</script>

<style>

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

 .row-full{
 width: 100vw;
 position: relative;
 margin-left: -50vw;
 height: 100px;
 margin-top: 100px;
 
}

.custom-font1{
  font-family: 'Dancing Script', cursive;
  font-size: 6.3em;
}

.custom-font2{
  font-family: 'Dancing Script', cursive;
  font-size: 8em;
}


.custom-font3{
font-family: 'Fredericka the Great', cursive;
  font-size: 8em;
  color:#FF6F00;
  
}
.v-card.v-sheet.theme--light.blue-grey.lighten-4 {
   padding-left: 80px;
    padding-right: 80px;
    padding-bottom: 60px;
    padding-top: 60px;
}

.v-card.v-sheet.theme--light.brown.lighten-5 {
    padding-left: 80px;
    padding-right: 80px;
    padding-bottom: 60px;
    padding-top: 60px;
}
.card.category.v-card.v-sheet.theme--light {
    
    margin-left: 30px;
}
h4.ab.subtitle-2.headline.mb-1 {
    text-align: center;
}
.flex.d-flex {
    margin-bottom: auto;
}
.flex.d-flex.xs12.sm6.md3 {
    padding-top: 20px;
    padding-right: 20px;
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
.v-card.v-card--flat.v-sheet.theme--light {
    
    padding-left: 70px;
    padding-right: 60px;
    padding-top: 10px;
    padding-bottom: 10px;
}

.custom-font4{
font-family: 'Abril Fatface', cursive;
  font-size: 5em;
}
.custom-font5{
  font-family: 'Eagle Lake', cursive;
  font-size: 3em;
}

.v-responsive.v-image {
   
    margin-bottom: 0px;
}

</style>
