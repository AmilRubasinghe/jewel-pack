<template>
<div>
<navDrawer></navDrawer>
</br>
<v-card color="blue">
    <div class="container">
<form enctype="multipart/form-data" @submit.prevent="sendFile">
<div class="field">
    <label for="file" class="lable">Upload File</label>
    <input 
    type="file"
    ref="file"
    @change="selectFile"
    >

    <v-btn outline color="black" type="submit">Upload</v-btn>
</div>
</form>
</div>
</v-card>
</div>
</template>

<script>
import axios from 'axios'
import navDrawer from '../admin/navDrawer.vue';
  export default {      
    data(){
        return{
            file: ""
        }
        
    },
    methods:{
        selectFile(event){
            this.file= event.target.files[0];
        },

        sendFile(){
            const formData = new FormData();
            formData.append('file',this.file,this.file.name);
            //console.log(this.file,this.file.name);

           /* 
              axios.post('https://api.imgbb.com/1/upload?key=248ae1eef04b0d558d5fa2b1691e0d3a', formData,{
                  crossdomain: true,

              })
                  
                  */
/*
                 axios({
    method: 'post',
    url: 'https://api.imgbb.com/1/upload?key=5fa06059080bd5aeb316e6210a8068a0',
    data: formData,
    config: { headers: {'Content-Type': 'multipart/form-data' }}
    })
    .then(function (response) {
        //handle success
        console.log(response);
    })
    .catch(function (response) {
        //handle error
        console.log(response);
    });*/


                  
                  
                  axios.post('https://vgy.me/upload?userkey=Kpx6WS9lOl8dx3rU9pDrOasKbkUOlpGs', formData)
                  .then(response => {
                      console.log(response)
                    console.log(response.data.image) 
                                axios.post('http://localhost:8000/api/storeImage',response.data)
                                .then(response => {
                                    console.log("Succesfully Saved");
                                        
                                        
                                    })
                                .catch(error => {
                                        console.log(error.response);
                                        console.log("Failed Save img url");
                                })                 
                    })
                    .catch(error => {
                        console.log(error.response);
                        console.log("Upload Failed");
                    })
                            
                    }
                  },

    components:{
            navDrawer
        },
  }
</script>