<template>
    
 <v-alert
      :value="true"
      color="yellow"
      icon="warning"
      outline
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
