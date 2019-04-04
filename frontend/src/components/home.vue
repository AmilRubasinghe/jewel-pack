<template>
    <div>
  
  <v-carousel
    delimiter-icon="stop"
    prev-icon="arrow_back_ios"
    next-icon="arrow_forward_ios"
    interval="3000"
    height="700"
    
    
    
  >
    <v-carousel-item
      v-for="(item,i) in items"
      :key="i"
      :src="item.src"
    ></v-carousel-item>
  </v-carousel>

  
   
    </div>
</template>

<script>

 export default {
    data () {
      return {
        items: [
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
          }
        ]
      }
    }
  }
  

</script>

<style>
   

</style>
