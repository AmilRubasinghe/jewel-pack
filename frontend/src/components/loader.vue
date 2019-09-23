<template>
  <!--  <v-dialog
      v-model="$store.getters.loader"
      hide-overlay
      persistent
      width="300"
    >
      <v-card
        color="#448AFF"
        dark
      >
        <v-card-text>
          Please stand by
          <v-progress-linear
            indeterminate
            color="white"
            class="mb-0"
          ></v-progress-linear>
        </v-card-text>
      </v-card>
    </v-dialog>
    
  <div v-if="$store.getters.loader">
    <v-card>
    <v-progress-circular
      
      :size=70
      :width="7"
      color="purple"
      indeterminate
      
    ></v-progress-circular>
    </v-card>

      <v-layout row justify-center>
      <v-dialog v-model="$store.getters.loader" persistent fullscreen content-class="loading-dialog" transition=false>
        
        <v-container fill-height>
          <v-layout row justify-center align-center>
            <v-progress-circular indeterminate :size="100" :width="6" color="deep-purple accent-4"></v-progress-circular>
          </v-layout>
        </v-container>
        
      </v-dialog>
    </v-layout>
    
  -->

  <!--
  <div id="app" >
   <v-layout row justify-center>
      <v-dialog v-model="$store.getters.loader" persistent fullscreen content-class="loading-dialog" transition=false>
        
        <v-container fill-height>
          <v-layout row justify-center align-center>
     <breeding-rhombus-spinner
  :animation-duration="2000"
  :size="65"
  color="#ff1d5e"
/>

      </v-layout>
        </v-container>
        
      </v-dialog>
    </v-layout>
  </div>
  -->

  <div id="app">
    <v-layout row justify-center>
      <v-dialog
        v-model="$store.getters.loader"
        persistent
        fullscreen
        content-class="loading-dialog"
        transition="false"
      >
        <v-container fill-height>
          <v-layout row justify-center align-center>
            <ScaleLoader
              color="#FFAB00"
              :loading="true"
              :size="150"
              :height="60"
              :width="5"
              :radius="0"
              
            ></ScaleLoader>
          </v-layout>
        </v-container>
      </v-dialog>
    </v-layout>
  </div>
</template>

<script>
/*import Store from '../store.js'
 //import 'epic-spinners/dist/lib/epic-spinners.min.css'
 // import { BreedingRhombusSpinner } from 'epic-spinners/dist/lib/epic-spinners.min.js'
 import { BreedingRhombusSpinner } from 'epic-spinners/src/components/lib/BreedingRhombusSpinner.vue'
 //import { BreedingRhombusSpinner } from 'epic-spinners'
 

  export default {
    components: {
      'breeding-rhombus-spinner':BreedingRhombusSpinner
    }
  }*/

import { ScaleLoader } from "@saeris/vue-spinners";

export default {
  components: {
    ScaleLoader
  }
};
</script>