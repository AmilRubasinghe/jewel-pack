<template>
<body class="inventory-body">
    
<div class="wrapper">
    
    
                            
 

    <div class="container box" >

  
        <alert v-if="alert" v-bind:message="alert" />
        <form class="form-signin" @submit.prevent='loginUser'>
            <h1 align="center">Sign In</h1>
            <div class="form-group form-group-lg">
                <input type="email" class="form-control"
                       id="inputEmail3"
                       placeholder="Email"  name="email"
                       autofocus
                       v-validate="'required|email'"
                       v-model="login.email"
                >

                <div v-show="errors.has('email')" class="help block alert alert-danger">
                    {{ errors.first('email') }}
                </div>
            </div>

            <br>


            <div class="form-group form-group-lg">
                <input type="password" class="form-control"
                       id="inputPassword3" placeholder="password"
                       name="password"
                       v-validate="'required'"
                       v-model="login.password"
                        >
                <div v-show="errors.has('password')" class="help block alert alert-danger">
                    {{ errors.first('password') }}
                </div>
            </div>




            <div class="form-group form-group-lg">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck1">
                    <label class="form-check-label" for="gridCheck1">
                          Remember Me
                    </label>
                </div>
            </div>


            <div class="form-group form-group-lg"  v-ripple="{ class: 'white--text' }">
                <v-btn type="submit" round color="blue" outline  block>Sign in</v-btn>
            </div>


        </form>

  </div>
</div>
</body>
</template>

<script>

import alert from './alert.vue';
import axios from 'axios'
import Store from '../store.js'
    export default {
        data() {
            return {
                login: {
                    email: "",
                    password: ""
                },
                alert:'',
            }
        },

        components:{
            alert
        },
        created(){
            if(this.$route.query.alert){
                    this.alert=this.$route.query.alert;
            }
        },
        methods:{
             loginUser(){
                
                axios.post('http://localhost:8000/api/login',this.login
                , {

            })
            .then( (response) => {
                    
                    this.alert=response.data.message;
                    let $token=response.data.token;
                    console.log($token);
                    this.$store.dispatch("setUser",null);
                     if($token){
                        localStorage.setItem('token',$token);
                        console.log(response.data.role);
                       
                       this.$store.dispatch("setUser",response.data.user);
                       console.log("User");
                     //  console.log(this.$store.state.user);
                      // console.log(Store.getters.role);
                        if(response.data.role=='admin'){
                            this.$router.push('/admin');
                        }else{
                        this.$router.push('/profile');
                        }
                    }
            })
            .catch( (error) => {
                console.log(error.response);
                    console.log("ERROR");
            });
        }
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
     }

.wrapper {
  height: 100%; 
  width: 100%; 
}




</style>
