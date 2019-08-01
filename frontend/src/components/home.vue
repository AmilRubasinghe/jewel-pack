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
            <v-parallax height=600 src="http://localhost:8000/storage/slideshow/1563280479-10519703_1621551864757385_30034616773715997_o.jpg">
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

        

        <!-- ..........nav........... -->
        <div class="container">
          <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
              <a
                class="nav-item nav-link active"
                id="nav-home-tab"
                data-toggle="tab"
                href="#nav-home"
                role="tab"
                aria-controls="nav-home"
                aria-selected="false"
              >All</a>
              <a
                class="nav-item nav-link"
                id="nav-profile-tab"
                data-toggle="tab"
                href="#nav-ear-ring"
                role="tab"
                aria-controls="nav-ear-ring"
                aria-selected="false"
              >Ear-ring</a>
              <a
                class="nav-item nav-link"
                id="nav-pendent-tab"
                data-toggle="tab"
                href="#nav-pendent"
                role="tab"
                aria-controls="nav-pendent"
                aria-selected="false"
              >Pendent Box</a>
              <a
                class="nav-item nav-link"
                id="nav-jewellary-tab"
                data-toggle="tab"
                href="#nav-jewellary"
                role="tab"
                aria-controls="nav-jewellary"
                aria-selected="false"
              >Jewellary Box</a>
            </div>
          </nav>
        </div>

        <!--    photo collection   -->

        <div class="container">
          <div class="product">
            <div class="gallery_product-1">
              <img
                src="https://scontent.fcmb3-1.fna.fbcdn.net/v/t1.0-9/10421193_1621549378090967_3170635747285958685_n.jpg?_nc_cat=107&_nc_ht=scontent.fcmb3-1.fna&oh=f4cc196d044eb1c71557d2bf6ac498fa&oe=5D691BF3 "
                class="img-responsive"
              >
            </div>

            <div class="gallery_product-2">
              <img
                src="https://scontent-sjc3-1.xx.fbcdn.net/v/t1.0-9/11081009_1621549388090966_6577302746957969645_n.jpg?_nc_cat=104&_nc_ht=scontent-sjc3-1.xx&oh=cbee5284a89a1bc1e74cc5fb3dec7d87&oe=5D732E0A"
                class="img-responsive"
              >
            </div>

            <div class="gallery_product-3">
              <img
                src="https://scontent.fcmb3-1.fna.fbcdn.net/v/t1.0-9/11035614_1621551864757385_30034616773715997_n.jpg?_nc_cat=104&_nc_ht=scontent.fcmb3-1.fna&oh=ba8416a1b899411f4af36acdac494ea5&oe=5D2FF64A"
                class="img-responsive"
              >
            </div>

            <div class="gallery_product-4">
              <img
                src="https://scontent.fcmb3-1.fna.fbcdn.net/v/t1.0-9/11035614_1621551864757385_30034616773715997_n.jpg?_nc_cat=104&_nc_ht=scontent.fcmb3-1.fna&oh=ba8416a1b899411f4af36acdac494ea5&oe=5D2FF64A"
                class="img-responsive"
              >
            </div>

            <div class="gallery_product-5">
              <img
                src="https://scontent-sjc3-1.xx.fbcdn.net/v/t1.0-9/11081009_1621549388090966_6577302746957969645_n.jpg?_nc_cat=104&_nc_ht=scontent-sjc3-1.xx&oh=cbee5284a89a1bc1e74cc5fb3dec7d87&oe=5D732E0A"
                class="img-responsive"
              >
            </div>

            <div class="gallery_product-6">
              <img
                src="https://scontent-lax3-1.xx.fbcdn.net/v/t1.0-9/21918_1621552604757311_3497408623699846175_n.jpg?_nc_cat=103&_nc_ht=scontent-lax3-1.xx&oh=7db10030c5459594daf9a1e69a0edfa8&oe=5D369B2A"
                class="img-responsive"
              >
            </div>

            <div class="gallery_product-7">
              <img
                src="https://scontent-lax3-1.xx.fbcdn.net/v/t1.0-9/11012081_1621553498090555_284000877275315659_n.jpg?_nc_cat=110&_nc_ht=scontent-lax3-1.xx&oh=3355847db88540e0e255a5eb33f38ef9&oe=5D6EE753"
                class="img-responsive"
              >
            </div>

            <div class="gallery_product-8">
              <img
                src="https://scontent.fcmb3-1.fna.fbcdn.net/v/t1.0-9/11117608_1621552268090678_4173469079808702324_n.jpg?_nc_cat=101&_nc_ht=scontent.fcmb3-1.fna&oh=1c792ed7fff7d21af93db4ecc7641193&oe=5D308E20"
                class="img-responsive"
              >
            </div>

            <div class="gallery_product-9">
              <img
                src="https://scontent.fcmb3-1.fna.fbcdn.net/v/t1.0-9/21769_1621551491424089_7080591978003687507_n.jpg?_nc_cat=104&_nc_ht=scontent.fcmb3-1.fna&oh=7631784490175ca34439f3123b6b441d&oe=5D66A8DA"
                class="img-responsive"
              >
            </div>
          </div>
        </div>

        <!--......................................................................................-->

        <div class="container">
          <div>
            <h3 class="popular">POPULAR C O L O U R BOX</h3>
          </div>

          <p>Here are some of recomended boxes of the year</p>
        </div>

        <!--...............popular product...............................-->
        <div class="container">
          <div class="product">
            <div class="product-item">
              <a href="#">
                <div class="gallery_product-1">
                  <img
                    src="https://scontent.fcmb3-1.fna.fbcdn.net/v/t1.0-9/10672245_1621555038090401_2447821253654883999_n.jpg?_nc_cat=111&_nc_ht=scontent.fcmb3-1.fna&oh=26e3f7f5918b452aee8c161d9a1a197b&oe=5D7179EA"
                    class="img-responsive"
                    width="600"
                    height="400"
                  >
                </div>
                <!-- <span class="effect"></span>
            <div class="post-content">
              <div class="trip-metas">
                <div class="clearfix title-price-wrapper">
                  <h4 class="post-title">2 x 2 inches New White Gold Line</h4>
                  <span class="trip-price">
                    <span class="current-price">
                    <del> $ 32 </del>
                    </span>
                    <span class="sale-price">$ 25 </span>
                  </span> 
                </div>
                    <div class="clearfix">
                      <div class="wp-travel-average-review" title="Rated 0 out of 5">
									      <span style="width:0%">
										       <strong itemprop="ratingValue" class="rating">0</strong> out of <span itemprop="bestRating">5</span>
                     	  </span>
                      </div>
                    <span class="rating-count">( 0 Reviews )</span>
                    <span class="trip-category">Camping</span>  	
								  </div>
                    </div>  

                </div>-->
              </a>
            </div>

            <div class="gallery_product-2">
              <img
                src="https://scontent.fcmb3-1.fna.fbcdn.net/v/t1.0-9/11094682_1621555298090375_620247687130712777_n.jpg?_nc_cat=106&_nc_ht=scontent.fcmb3-1.fna&oh=8d221df8ab2dff085932f54ab24702cf&oe=5D32DB49"
                class="img-responsive"
              >
            </div>

            <div class="gallery_product-3">
              <img
                src="https://scontent.fcmb3-1.fna.fbcdn.net/v/t1.0-9/11081330_1621555734756998_575403437887243041_n.jpg?_nc_cat=105&_nc_ht=scontent.fcmb3-1.fna&oh=29f927f3e8afb1f1b062f05c01fdad7d&oe=5D695CAB"
                class="img-responsive"
              >
            </div>

            <div class="gallery_product-4">
              <img
                src="https://scontent.fcmb3-1.fna.fbcdn.net/v/t1.0-9/44054646_2274666516112580_2449991599250210816_o.jpg?_nc_cat=105&_nc_ht=scontent.fcmb3-1.fna&oh=6939ba2611ff313b9d94b2c86ebce811&oe=5D380D84"
                class="img-responsive"
              >
            </div>

            <div class="gallery_product-5">
              <img
                src="https://scontent.fcmb3-1.fna.fbcdn.net/v/t1.0-9/43950994_2274666559445909_840016532749680640_o.jpg?_nc_cat=109&_nc_ht=scontent.fcmb3-1.fna&oh=2fc0c99ea1c6c161c545629723bb408d&oe=5D6210F0"
                class="img-responsive"
              >
            </div>

            <div class="gallery_product-6">
              <img
                src="https://scontent.fcmb3-1.fna.fbcdn.net/v/t1.0-9/43851592_2274666409445924_4292087511838097408_o.jpg?_nc_cat=111&_nc_ht=scontent.fcmb3-1.fna&oh=6005143b7f6f6051e7c2a709e68c9e5a&oe=5D67596F"
                class="img-responsive"
              >
            </div>
          </div>
        </div>

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
                        <v-img :aspect-ratio="3/3" :src="item.image">
                         
                        </v-img>
                      </div>  
                      </v-card>
                     
      </v-flex>
      


      
    </v-layout>
  </v-card>

      
           

        <!-- ..............Jewellery display.............................-->
        <div class="container"></div>

       
            <v-parallax src="http://localhost:8000/storage/slideshow/1563280490-11071592_1621554201423818_8781376146243943971_o.jpg">
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
                        width="300"
                        height="393"
                        
                      >
                        <v-img :aspect-ratio="3.8/4.2" :src="item.image">
                         
                        </v-img>
                         <v-card-text> 
                            <h4
                style="color:#8D6E63"
                  class="ab subtitle-2 headline mb-1"
                  
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
        .get("http://localhost:8000/api/getImages")
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



</style>
