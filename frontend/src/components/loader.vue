<template>
    
<v-progress-circular
      :size="70"
      color="blue"
      indeterminate
      v-model="$store.state.loader"
    ></v-progress-circular>

    
</template>