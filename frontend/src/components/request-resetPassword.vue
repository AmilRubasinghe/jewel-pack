<template>
    <div>
        <v-container>
            <notification v-if="notify"  :message="notify" :type="status"></notification>
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
import notification from "./notification.vue";

export default {

 
    data(){
        return{
            User:{
            email:'',
        },
        notify:'',
        status:'',
        }
        
    },

    components: {
    notification
  },
    methods:{
        sendPasswordResetLink(){
            this.notify='',
            this.$validator.validateAll();

            axios
          .post(
            this.$baseUrl+"/sendPasswordResetLink/",
            this.User
          )

          .then(response => {
              this.notify=response.data.data;
              this.status=2;
              
          })
          .catch(error => {
              this.notify=error.response.data.error;
              this.status=0;
          console.log(error.response);
          console.log("ERROR");
        });;

        },

        
    }
}
</script>

