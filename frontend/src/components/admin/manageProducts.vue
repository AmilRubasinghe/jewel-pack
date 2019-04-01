<template>
<div>
<adminPanel></adminPanel>
   <v-progress-circular
      :size="70"
      :width="7"
      color="purple"
      indeterminate
    ></v-progress-circular>
  </div>
</template>


<script>
import adminPanel from './adminPanel'
export default {

    components:{
    'adminPanel':adminPanel
    }
}
</script>
