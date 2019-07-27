<template>
    <div>
        <v-container>
        <form>
            <h1>What's your email?</h1>
            <v-text-field
            v-model="User.email"
            label="Email Address"
            v-validate="'email'" 
            data-vv-as="email" 
            name="email_field" 
            type="text"
             :error-messages="errors.collect('email_field')"
        ></v-text-field>

        <v-btn dark @click="sendPasswordResetLink">Send Password Reset Link</v-btn>
        </form>
        </v-container>
    </div>
</template>

<script>
import axios from "axios";

export default {

 
    data(){
        return{
            User:{
            email:'',
        },
        }
        
    },
    methods:{
        sendPasswordResetLink(){
            this.$validator.validateAll();

            axios
          .post(
            "http://localhost:8000/api/sendPasswordResetLink/",
            this.User
          )

          .then(response => {
              
          })
          .catch(error => {
          console.log(error.response);
          console.log("ERROR");
        });;

        },

        
    }
}
</script>

