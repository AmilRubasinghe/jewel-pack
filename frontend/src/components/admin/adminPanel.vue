<template>
  

  <div >
    <v-container fluid>
<v-layout justify-center>
    <v-flex xs12 sm12>
 

      <v-card>
        <v-container
          fluid
          grid-list-md
        >
          <v-layout row wrap>
            <v-flex
              v-for="card in cards"
              :key="card.title"
              v-bind="{ [`xs${card.flex}`]: true }"
              
            >
            
              <v-card class="clickable" :to="{path: '/admin/'+card.path}">
                <v-img
                  :src="card.src"
                  height="200px"
                  
                >
              
                  <v-container
                    fill-height
                    fluid
                    pa-2
                  >
                    <v-layout fill-height>
                      <v-flex xs12 align-end flexbox >
                        <span :class="card.class" v-text="card.title" ></span>
                      </v-flex>
                    </v-layout>
                  </v-container>
                </v-img>

              </v-card>
            </v-flex>
          </v-layout>
        </v-container>
      </v-card>
    </v-flex>
  </v-layout>
  </v-container>
</div>
</template>
<script>
import navDrawer from './navDrawer.vue';
  export default {

  data: () => ({
      cards: [
        { title: 'Users', src: 'https://images.unsplash.com/photo-1526656001029-20a71b17f7ba?ixlib=rb-1.2.1&q=85&fm=jpg&crop=entropy&cs=srgb&dl=sear-greyson-671095-unsplash.jpg', flex: 4, class:'headline white--text', path:"/users"},
        { title: 'Orders', src: 'https://images.unsplash.com/photo-1509315703195-529879416a7d?ixlib=rb-1.2.1&q=85&fm=jpg&crop=entropy&cs=srgb&dl=micheile-henderson-429781-unsplash.jpg', flex: 4, class:'headline black--text',path:'/reports'},
        { title: 'Products', src: 'https://images.unsplash.com/photo-1465820909510-5aa8bb14978f?ixlib=rb-1.2.1&q=85&fm=jpg&crop=entropy&cs=srgb&dl=clem-onojeghuo-101915-unsplash.jpg', flex: 4, class:'headline white--text' },
        { title: 'Category', src: 'https://images.unsplash.com/photo-1465820909510-5aa8bb14978f?ixlib=rb-1.2.1&q=85&fm=jpg&crop=entropy&cs=srgb&dl=clem-onojeghuo-101915-unsplash.jpg', flex: 4, class:'headline white--text' }
      ]
    }),
      
    components:{
            navDrawer
        },
  }
</script> 