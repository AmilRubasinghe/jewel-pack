<template>
<body class="inventory-body">
    <div>
    <div class="container box">
        <alert v-if="alert" v-bind:message="alert" />

   <form @submit.prevent='registerUser'>



        <h1 align="center">Register</h1>
        <div class="form-group form-group-lg">
            <input type="text" class="form-control" id="firstname" placeholder="First Name" name="firstname" v-validate="'required'" v-model="register.firstname">
            <div v-show="errors.has('firstname')" class="help block alert alert-danger">
                    {{ errors.first('firstname') }}
            </div>
        </div>


        <div class="form-group form-group-lg">
            <input type="text" class="form-control" id="lastname" placeholder="Last Name" name="lastname" v-validate="'required'" v-model="register.lastname">
            <div v-show="errors.has('lastname')" class="help block alert alert-danger">
                    {{ errors.first('lastname') }}
            </div>
        </div>


        <div class="form-group form-group-lg">
            <input type="email" class="form-control" id="email" placeholder="Email" name="email" v-validate="'required|email'" v-model="register.email">
            <div v-show="errors.has('email')" class="help block alert alert-danger">
                    {{ errors.first('email') }}
            </div>
        </div>


        <div class="form-group form-group-lg">
            <input type="password" class="form-control" id="password" placeholder="password" name="password" v-validate="'required'" v-model="register.password">
            <div v-show="errors.has('password')" class="help block alert alert-danger">
                    {{ errors.first('password') }}
            </div>
        </div>



        <div class="form-group form-group-lg">
            <input type="password" class="form-control" id="confirm_password" placeholder="confirm password" name="confirm_password" v-validate="'required'" v-model="register.confirm_password">
            <div v-show="errors.has('confirm_password')" class="help block alert alert-danger">
                    {{ errors.first('confirm_password') }}
            </div>
        </div>


        <div class="form-group form-group-lg" v-ripple="{ class: 'white--text' }">
            
            <v-btn type="submit" round color="blue" outline  block>Register</v-btn>

        </div>

    </form>
    </div>
    </div>
    
    </body>
</template>



<script>
import alert from './alert.vue';
import axios from 'axios';
import Store from '../store.js';

export default{
    data(){
        return{
            register:{
                firstname:"",
                lastname:"",
                email:"",
                password:"",
                confirm_password:""
            },
             alert:'',
        }
    },
     components:{
            alert
        },
    methods:{
        registerUser(){

            this.$validator.validateAll()
            
             Store.commit("setEmailToVerify",this.register.email);
            if (!this.errors.any()) {
                axios.post('http://localhost:8000/api/register',this.register
                , {

            }).then(response=>{
                //console.log(response.data.message);
                     this.$router.push({path:'/loginPage',query:{alert:response.data.message,snack:response.data.snack}});
                     
                })
                .catch(error=>{
                    console.log(error.response);
                    console.log("ERROR");
                })
            }

           
        },
    }

}

</script>


<style>
    html, body, app-root {
     height: 100%;
     margin: 0;
     }
 .inventory-body {
     min-width: 100%;
     background-image: url("https://coloredbrain.com/wp-content/uploads/2016/07/login-background.jpg");
     background-repeat: no-repeat;
     background-size: 50%;
     background-position: center;
     background-size: cover;
       /*filter: blur(8px);
  -webkit-filter: blur(8px);*/
     }

.wrapper {
  height: 100%; 
  width: 100%; 
}





</style>
