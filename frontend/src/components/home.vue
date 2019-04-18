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
  </br>
   
   
   <v-parallax
    
    src="https://scontent.fcmb4-1.fna.fbcdn.net/v/t1.0-9/43828367_2274666422779256_8541436203545657344_o.jpg?_nc_cat=106&_nc_ht=scontent.fcmb4-1.fna&oh=14481e0b61a94c7b067ceb4003cfdea2&oe=5D05A9F1&dl=1"
  >
    <v-layout
      align-center
      column
      justify-center
      color="blue"
    >
      <h1 class="display-2 font-weight-thin mb-3" >JewelPack</h1>
    </v-layout>
  </v-parallax>

  
   
    </div>
</template>

<script>

import axios from 'axios'

 export default {
    data () {
      return {

        slideshowItems:[],
        items: [/*
          {
            src: 'https://scontent.fcmb4-1.fna.fbcdn.net/v/t1.0-9/43952628_2274666736112558_2752018548523008000_o.jpg?_nc_cat=104&_nc_ht=scontent.fcmb4-1.fna&oh=87817afab2879d3ad24d4b65cca62c4a&oe=5D3D89F9&dl=1'
          },
          {
            src: 'https://scontent.fcmb4-1.fna.fbcdn.net/v/t31.0-8/10835057_1621554188090486_7112095629519844935_o.jpg?_nc_cat=106&_nc_ht=scontent.fcmb4-1.fna&oh=375db3bdc5c16061a175bf4bc2a695cf&oe=5D4EF9FC&dl=1'
          },
          {
            src: 'https://scontent.fcmb4-1.fna.fbcdn.net/v/t1.0-9/43828367_2274666422779256_8541436203545657344_o.jpg?_nc_cat=106&_nc_ht=scontent.fcmb4-1.fna&oh=14481e0b61a94c7b067ceb4003cfdea2&oe=5D05A9F1&dl=1'
          },
          {
            src: 'https://scontent.fcmb4-1.fna.fbcdn.net/v/t31.0-8/11075260_1621556254756946_973566724126207842_o.jpg?_nc_cat=105&_nc_ht=scontent.fcmb4-1.fna&oh=f0f6758ed7e91941ceb5b9a854a399f6&oe=5D41DB4E&dl=1'
          }*/

          {
            src: 'https://i.ibb.co/WDRbW3y/10519703-1621551864757385-30034616773715997-o.jpg'
          },
          {
            src: 'https://i.ibb.co/zmGD2j2/10835285-1621552268090678-4173469079808702324-o.jpg'
          },
          {
            src: 'https://i.ibb.co/9ZY2kpJ/10952932-1621555301423708-8429785822492018426-o.jpg'
          },
          {
            src: 'https://i.ibb.co/0QDkJ54/11018150-1621555038090401-2447821253654883999-o.jpg'
          },
          {
            src: 'https://i.ibb.co/FYnh8M5/11071592-1621554201423818-8781376146243943971-o.jpg'
          },
          {
            src: 'https://i.ibb.co/PTMjsfd/11084068-1621553484757223-8453650611327338621-o.jpg'
          },
          {
            src: 'https://i.ibb.co/31KZYDW/11090958-1621555728090332-7168703738469121013-o.jpg'
          },
          {
            src: 'https://i.ibb.co/fxvtBsK/11084152-1621556271423611-7736799005497095380-o.jpg'
          },
          
        ]
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
    }
  }
  

</script>

<style>
   

</style>
