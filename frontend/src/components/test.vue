<template>
 <v-layout align-center justify-center>
    <v-card max-width="600px">
          <v-card-title>
            <span class="headline">Upload File</span>
          </v-card-title>
          <v-card-text>
            <v-layout align-center justify-center>
              <v-card
                flat
                color="#B0BEC5"
                @click="$refs.file.click()"
                ripple
                hover
                height="300"
                width="300"
                max-width="600px"
              >
                <form enctype="multipart/form-data">
                  <div class="text-xs-center">
                   
                      <vue-dropzone ref="myVueDropzone" id="dropzone" :options="dropzoneOptions" v-on:vdropzone-sending="sendingEvent" ></vue-dropzone>
                      
                     
                    
                  </div>
                </form>
              </v-card>
            </v-layout>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
           
            <v-btn outline color="blue" @click="sendFile">Upload</v-btn>
          </v-card-actions>
        </v-card>
   

 </v-layout>
</template>
<script>
import vue2Dropzone from 'vue2-dropzone'
import 'vue2-dropzone/dist/vue2Dropzone.min.css'
export default {
  name: 'app',
  components: {
    vueDropzone: vue2Dropzone
  },
  data: function () {
    return {
      dropzoneOptions: {
          url: 'http://localhost:8000/api/storeImage',
          thumbnailWidth: 150,
          maxFilesize: 0.5,
          headers: { "My-Awesome-Header": "header value" },
          addRemoveLinks: true,
        dictDefaultMessage: "<i class='fa fa-cloud-upload'></i>UPLOAD ME",
        processing: false
          
      },
      methods: {
      sendingEvent (file, xhr, formData) {
        this.file=file;
        comsole.log("**************************")
        console.log(this.file);
      },
      sendFile() {
      const formData = new FormData();
      formData.append("file", this.file, this.file.name);
      console.log("****");

      let $Token = localStorage.getItem("token");
      axios
        .post(
          this.$baseUrl+"/storeImage" + "?token=" + $Token,
          // axios.post('http://localhost:8000/api/storeImage'+'?token='+$Token,response.data)
          // axios.post('https://vgy.me/upload?userkey=Kpx6WS9lOl8dx3rU9pDrOasKbkUOlpGs',
          formData
        )
        .then(response => {
          this.dialog = false;
          this.file = "";
          this.getSlideshow();
          alert("Succesfully Saved");
        })
        .catch(error => {
          console.log(error.response);
          console.log("Failed Save img url");
        });
    },
    }
    }
  }
  
}
</script>
<style>
.dropzone .dz-preview .dz-image {
  
    overflow: hidden;
    
    position: static;
    display: block;
    z-index: 10;
}
</style>