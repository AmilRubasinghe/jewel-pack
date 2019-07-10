<template>
<div>
<navDrawer></navDrawer>


<div v-responsive.lg.xl >Only visible on desktop !</div>
 
  
 
   <div v-responsive.md.sm.xs >Only visible on smartphone!</div>


</div>
</template>

<script>
import navDrawer from './navDrawer.vue';
  export default {      
    components:{
            navDrawer,
        },
  }
</script>