<template>
<body class="inventory-body">
    
<div class="wrapper">
    
    
  

    <div class="container box" >

  

        <form class="form-signin" @submit.prevent='loginUser'>
            <h1 align="center">Login</h1>
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

            </br>


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


            <div class="form-group form-group-lg">
                <button type="submit" class="btn btn-lg btn-primary btn-block">Sign in</button>
            </div>


        </form>

  </div>
</div>
</body>
</template>

<script>


import axios from 'axios'
    export default {
        data() {
            return {
                login: {
                    email: "",
                    password: ""
                },
                userL:[],
            }
        },

        methods:{
             loginUser(){
                
                axios.post('http://localhost:8000/api/login',this.login
                , {

            })
            .then( (response) => {
                    let $alert=response.data.alert;
                    let $token=response.data.token;
                        
                    if($alert){
                        alert($alert);
                    }
                     if($token){
                        localStorage.setItem('token',$token);
                       // console.log($token);
                        this.$router.push('/profile');
                    }
            })
            .catch( (error) => {
                console.log(error.response);
                    console.log("ERROR");
            });
                
                /*
            this.$http.post('http://localhost:8000/api/login', this.login)
                .then(response => {
                    let $alert=response.data.alert;
                    let $token=response.data.token;

                    if($alert){
                        alert($alert);
                    }
                    
                    if($token){
                        localStorage.setItem('token',$token);
                       // console.log($token);
                        this.$router.push('/profile');
                    }
                })
                .catch(error => {
                    console.log(error.response);
                    console.log("ERROR");
                })
*/
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
     position: fixed;
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
