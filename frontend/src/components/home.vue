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
