<template>
    
 <v-alert
      :value="true"
      color="error"
      icon="warning"
      transition="scale-transition"
      
    >
      {{message}}
    </v-alert>
</template>

<script>
export default {
    name: 'alert',
    props: ['message'],

    data(){
        return{

        }
    }
}
</script>
