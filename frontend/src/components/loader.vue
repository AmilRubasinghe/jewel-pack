<template>
    
    
    <v-dialog
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
  
    
</template>