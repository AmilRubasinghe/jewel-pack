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
-->

     <v-layout row justify-center>
      <v-dialog v-model="$store.getters.loader" persistent fullscreen content-class="loading-dialog" transition=false>
        <v-container fill-height>
          <v-layout row justify-center align-center>
            <v-progress-circular indeterminate :size="100" :width="7" color="#42A5F5"></v-progress-circular>
          </v-layout>
        </v-container>
      </v-dialog>
    </v-layout>

</template>

<script>
import Store from '../store.js'
</script>