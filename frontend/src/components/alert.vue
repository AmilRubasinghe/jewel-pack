<template>
    
 <v-alert
      :value="true"
      color="yellow"
      icon="warning"
      outline
      
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
