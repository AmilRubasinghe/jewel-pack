c<template>
    <div>
  
  <v-carousel
    delimiter-icon="stop"
    prev-icon="arrow_back_ios"
    next-icon="arrow_forward_ios"
    interval="3000"
    height="700"
    
    
    
  >
    <v-carousel-item
      v-for="(item,i) in slideshowItems"
      :key="i"
      :src="item.image"
    ></v-carousel-item>
  </v-carousel>
  <br>
   
  

 <div  data-aos="fade-right">
    <v-layout row wrap>
      <v-flex xs6>
        
          <v-parallax
        
        src="https://i.vgy.me/Ti6jIj.jpg"
      >
        <v-layout
          align-center
          column
          justify-center
          color="blue"
        >
          <h1 style="color:#FFFFFF; align:center;" class="display-4 font-weight-thin mb-3"  >JewelPack</h1>
        </v-layout>
      </v-parallax>
        
      </v-flex>
      <v-flex xs6 >
        
        <v-layout
          align-center
          column
          justify-center
          color="blue"
        >
          <h3 style="color:#BF360C;" class="display-3 font-weight-400 font-italic mb-1 "   >Great for </h3>
          <h3 style="color:#BF360C;" class="display-3 font-weight-400 font-italic mb-1"   >storage or display</h3>
          <h4 style="color:#BF360C;" class="display-2 font-weight-400 font-italic mb-1"  >of</h4>
          <h3 style="color:#BF360C;" class="display-3 font-weight-400 font-italic mb-1"   >Jewellary & Gems</h3>
        </v-layout>
        
        
      </v-flex>
    </v-layout>
 </div>
      
       <!--slide end-->

    <div class="search">
    <div class="container">    
        <form>
  <div class="form-row align-items-center">
    <div class="col-auto">
      
      <input type="text" class="form-control mb-2" id="inlineFormInput" placeholder="Box name">
    </div>
    <!--<div class="col-auto">
    
      <div class="input-group mb-2">
       
        <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Colour">
      </div>
    </div>-->

 

       

      <v-flex xs12 sm4>
        <p>Segmented</p>

        <v-overflow-btn
          
          label="Segmented Btn"
          segmented
          target="#dropdown-example"
        ></v-overflow-btn>
      </v-flex>

    


        <div class="col-auto">
      
      <input type="text" class="form-control mb-2" id="inlineFormInput" placeholder="Size">
    </div>
   
    
    <div class="col-auto">
      <button type="Search" class="btn btn-primary mb-2">Search</button>
    </div>
  </div>
</form>
</div>

</div>

 <div class="container">
     <div>
         <h3>Find<span> your </span>color<span> Box</span></h3>
     </div>

     <p> Stop milions of hadmand and vintage item on the world's most imginative market place</p>


     </div>




     <!-- ..........nav........... -->
     <div class="container">
    <nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="false">All</a>
    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-ear-ring" role="tab" aria-controls="nav-ear-ring" aria-selected="false">Ear-ring</a>
    <a class="nav-item nav-link" id="nav-pendent-tab" data-toggle="tab" href="#nav-pendent" role="tab" aria-controls="nav-pendent" aria-selected="false">Pendent Box</a>
    <a class="nav-item nav-link" id="nav-jewellary-tab" data-toggle="tab" href="#nav-jewellary" role="tab" aria-controls="nav-jewellary" aria-selected="false">Jewellary Box</a>
  
  </div>
</nav>

</div>



<!--    photo collection   -->


        <div class="container">
           <div class="product">
            <div class="gallery_product-1">
                <img src="https://scontent.fcmb3-1.fna.fbcdn.net/v/t1.0-9/10421193_1621549378090967_3170635747285958685_n.jpg?_nc_cat=107&_nc_ht=scontent.fcmb3-1.fna&oh=f4cc196d044eb1c71557d2bf6ac498fa&oe=5D691BF3 "  class="img-responsive">
            </div>

            <div class="gallery_product-2">
                <img src="https://scontent-sjc3-1.xx.fbcdn.net/v/t1.0-9/11081009_1621549388090966_6577302746957969645_n.jpg?_nc_cat=104&_nc_ht=scontent-sjc3-1.xx&oh=cbee5284a89a1bc1e74cc5fb3dec7d87&oe=5D732E0A" class="img-responsive">
            </div>

            <div class="gallery_product-3">
                <img src="https://scontent.fcmb3-1.fna.fbcdn.net/v/t1.0-9/11035614_1621551864757385_30034616773715997_n.jpg?_nc_cat=104&_nc_ht=scontent.fcmb3-1.fna&oh=ba8416a1b899411f4af36acdac494ea5&oe=5D2FF64A" class="img-responsive">
            </div>

            <div class="gallery_product-4">
                <img src="https://scontent.fcmb3-1.fna.fbcdn.net/v/t1.0-9/11035614_1621551864757385_30034616773715997_n.jpg?_nc_cat=104&_nc_ht=scontent.fcmb3-1.fna&oh=ba8416a1b899411f4af36acdac494ea5&oe=5D2FF64A" class="img-responsive">
            </div>

            <div class="gallery_product-5">
                <img src="https://scontent-sjc3-1.xx.fbcdn.net/v/t1.0-9/11081009_1621549388090966_6577302746957969645_n.jpg?_nc_cat=104&_nc_ht=scontent-sjc3-1.xx&oh=cbee5284a89a1bc1e74cc5fb3dec7d87&oe=5D732E0A" class="img-responsive">
            </div>

            <div class="gallery_product-6">
                <img src="https://scontent-lax3-1.xx.fbcdn.net/v/t1.0-9/21918_1621552604757311_3497408623699846175_n.jpg?_nc_cat=103&_nc_ht=scontent-lax3-1.xx&oh=7db10030c5459594daf9a1e69a0edfa8&oe=5D369B2A" class="img-responsive">
            </div>

            <div class="gallery_product-7">
                <img src="https://scontent-lax3-1.xx.fbcdn.net/v/t1.0-9/11012081_1621553498090555_284000877275315659_n.jpg?_nc_cat=110&_nc_ht=scontent-lax3-1.xx&oh=3355847db88540e0e255a5eb33f38ef9&oe=5D6EE753" class="img-responsive">
            </div>

            <div class="gallery_product-8 ">
                <img src="https://scontent.fcmb3-1.fna.fbcdn.net/v/t1.0-9/11117608_1621552268090678_4173469079808702324_n.jpg?_nc_cat=101&_nc_ht=scontent.fcmb3-1.fna&oh=1c792ed7fff7d21af93db4ecc7641193&oe=5D308E20" class="img-responsive">
            </div>

            <div class="gallery_product-9">
                <img src="https://scontent.fcmb3-1.fna.fbcdn.net/v/t1.0-9/21769_1621551491424089_7080591978003687507_n.jpg?_nc_cat=104&_nc_ht=scontent.fcmb3-1.fna&oh=7631784490175ca34439f3123b6b441d&oe=5D66A8DA" class="img-responsive">
            </div>

        </div>
        </div>

    <!--......................................................................................-->

        <div class="container">
     <div>
         <h3 class="popular">POPULAR  C O L O U R   BOX</h3>
     </div>

     <p> Here are som of recomended boxes of the year</p>


     </div>


<!--...............popular product...............................-->
             <div class="container">
           <div class="product">
             <div class="product-item">
             <a href="#">
            <div class="gallery_product-1">
                <img src="https://scontent.fcmb3-1.fna.fbcdn.net/v/t1.0-9/10672245_1621555038090401_2447821253654883999_n.jpg?_nc_cat=111&_nc_ht=scontent.fcmb3-1.fna&oh=26e3f7f5918b452aee8c161d9a1a197b&oe=5D7179EA" class="img-responsive"width="600" height="400">
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

              </div> -->   
             
            </a>
            </div>


            <div class="gallery_product-2">
                <img src="https://scontent.fcmb3-1.fna.fbcdn.net/v/t1.0-9/11094682_1621555298090375_620247687130712777_n.jpg?_nc_cat=106&_nc_ht=scontent.fcmb3-1.fna&oh=8d221df8ab2dff085932f54ab24702cf&oe=5D32DB49" class="img-responsive">
            </div>

            <div class="gallery_product-3">
                <img src="https://scontent.fcmb3-1.fna.fbcdn.net/v/t1.0-9/11081330_1621555734756998_575403437887243041_n.jpg?_nc_cat=105&_nc_ht=scontent.fcmb3-1.fna&oh=29f927f3e8afb1f1b062f05c01fdad7d&oe=5D695CAB" class="img-responsive">
            </div>

            <div class="gallery_product-4">
                <img src="https://scontent.fcmb3-1.fna.fbcdn.net/v/t1.0-9/44054646_2274666516112580_2449991599250210816_o.jpg?_nc_cat=105&_nc_ht=scontent.fcmb3-1.fna&oh=6939ba2611ff313b9d94b2c86ebce811&oe=5D380D84" class="img-responsive">
            </div>

            <div class="gallery_product-5">
                <img src="https://scontent.fcmb3-1.fna.fbcdn.net/v/t1.0-9/43950994_2274666559445909_840016532749680640_o.jpg?_nc_cat=109&_nc_ht=scontent.fcmb3-1.fna&oh=2fc0c99ea1c6c161c545629723bb408d&oe=5D6210F0" class="img-responsive">
            </div>

            <div class="gallery_product-6">
                <img src="https://scontent.fcmb3-1.fna.fbcdn.net/v/t1.0-9/43851592_2274666409445924_4292087511838097408_o.jpg?_nc_cat=111&_nc_ht=scontent.fcmb3-1.fna&oh=6005143b7f6f6051e7c2a709e68c9e5a&oe=5D67596F" class="img-responsive">
            </div>

        </div>
        </div>

<!--...................newest product...................-->
        
        <div class="container">
     <div>
         <h3 class="newest">N E W E S T  B O X</h3>
     </div>
     </div>


         <div class="container">
           <div class="newest-product">
            <div class="gallery_product-1">
                <img src="https://scontent.fcmb3-1.fna.fbcdn.net/v/t1.0-9/10626822_1621556271423611_7736799005497095380_n.jpg?_nc_cat=101&_nc_ht=scontent.fcmb3-1.fna&oh=c3981005c98715e35ae5562c8ff04da1&oe=5D6551B9" class="img-responsive" >
            </div>

            <div class="gallery_product-2">
                <img src="https://scontent.fcmb3-1.fna.fbcdn.net/v/t1.0-9/11091137_1621552601423978_714322575191341730_n.jpg?_nc_cat=109&_nc_ht=scontent.fcmb3-1.fna&oh=bc689b1be997cb2f901148bcaed2881e&oe=5D68ADDA" class="img-responsive">
            </div>

            <div class="gallery_product-3">
                <img src="https://scontent.fcmb3-1.fna.fbcdn.net/v/t1.0-9/21769_1621551491424089_7080591978003687507_n.jpg?_nc_cat=104&_nc_ht=scontent.fcmb3-1.fna&oh=7631784490175ca34439f3123b6b441d&oe=5D66A8DA" class="img-responsive">
            </div>
          </div>
        </div>

    <!-- ..............Jewellery display.............................-->
      <div class="container">
        

      </div>
   

   <div  data-aos="fade-left">

     
 
    <v-layout row wrap>
      
      <v-flex xs6 >
        
        <v-layout
          align-center
          column
          justify-center
          color="blue"
        >
          <h3 style="color:#BF360C;" class="display-3 font-weight-400 font-italic mb-1"   >Great for </h3>
          <h3 style="color:#BF360C;" class="display-3 font-weight-400 font-italic mb-1"   >storage or display</h3>
          <h4 style="color:#BF360C;" class="display-2 font-weight-400 font-italic mb-1"  >of</h4>
          <h3 style="color:#BF360C;" class="display-3 font-weight-400 font-italic mb-1"   >Jewellary & Gems</h3>
        </v-layout>
        
        
      </v-flex>

      <v-flex xs6>
        
          <v-parallax
        
        src="https://i.vgy.me/Ti6jIj.jpg"
      >
        <v-layout
          align-center
          column
          justify-center
          color="blue"
        >
          <h1 style="color:#FFFFFF; align:center;" class="display-4 font-weight-thin mb-3"  >JewelPack</h1>
        </v-layout>
      </v-parallax>
        
      </v-flex>
    </v-layout>
   </div>


    </div>
</template>

<script>

import axios from 'axios'
import AOS from 'aos';
import 'aos/dist/aos.css'; // You can also use <link> for styles
// ..



 export default {
    data () {
      return {

        slideshowItems:[],
      }
    },
    methods:{

      getSlideshow(){
              axios.get('http://localhost:8000/api/getImages')
                  .then(response => {
                    
                    
                      this.slideshowItems=response.data.images;

                      console.log(this.slideshowItems);

                      
                      
                  })
                  .catch(error => {
                      console.log(error.response);
                      console.log("ERROR");
                  })
          },
    },

    mounted(){
      this.getSlideshow();
      AOS.init(
        {
        duration: 3000
        }
      );

    }
  }
  

</script>

<style>

.search {
    padding: 40px;
     color: #d1c0e1;
    padding color:#8e85c0;
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

   

</style>
