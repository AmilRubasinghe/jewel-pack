<template>
  <div>
    <h1>Testing</h1>
<br>
    <form enctype="multipart/form-data">
      <input type="file" ref="file" @change="handleFileUpload"/>
      <v-btn @click="upload" dark>Upload</v-btn>
    </form>

    <v-img src="http://localhost:8000/storage/opJR9nPs8TGtMRIyfJG0H0B8xkt4nOPxMbjZ1KDO.jpeg"></v-img>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      file: ''
    };
  },

  methods: {
    upload() {
       let formData = new FormData();

            /*
                Add the form data we need to submit
            */
            formData.append('file', this.file);

        /*
          Make the request to the POST /single-file URL
        */
            axios.post( 'http://localhost:8000/api/upload',
                formData,
                {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
              }
            ).then(function(){
          console.log('SUCCESS!!');
        })
        .catch(function(){
          console.log('FAILURE!!');
        });
    },

    handleFileUpload() {
      this.file = this.$refs.file.files[0];
    }
  }
};
</script>

