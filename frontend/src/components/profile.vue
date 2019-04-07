<template>

<div class="container box">

<form class="form-signin">
            <h1 align="center">Profile</h1>
            <h3>ID : {{ user.ID }}</h3>
            <h3>Name : {{ user.firstName }} {{ user.lastName }}</h3>
            <h3>Email : {{ user.email }}</h3>
            
            
</form>

    
     <v-btn @click="me"  color="blue" outline class="btn btn-lg btn-primary btn-block">Profile</v-btn>
    </div>
    
</template>


<script>
import axios from 'axios'
import Store from '../store.js'

    export default {
        data() {
            return {
                user:[]
            }
        },

        

        created: function () {
           //this.me();
            // this.user=response.data.user;
            console.log("Created");
            console.log(Store.getters.user);
            if(Store.getters.user){
                this.user=Store.getters.user;
            }else{
                logout;
            }
            
            
         },

        /* beforeCreate() {
             this.me();
             },*/

        methods:{
            logout(){
                let $Token=localStorage.getItem('token');
               /* console.log(Token);*/
                
   // this.$http.post('http://localhost:8000/api/logout?token='+$Token)
             axios.post('http://localhost:8000/api/logout?token='+$Token)
                .then(response => {
                    localStorage.removeItem('token');
                    let $Token=localStorage.getItem('token');
                    if(!$Token){
                        this.$router.push('/loginPage');
                    }
                })
                .catch(error => {
                    console.log(error.response);
                    console.log("ERROR");
                    
                })

        },

        me(){
                let $Token=localStorage.getItem('token');
                //console.log($store.getters.isLoggedIn);
                 

                
            //this.$http.post('http://localhost:8000/api/me?token='+$Token)
            axios.post('http://localhost:8000/api/me?token='+$Token
                , {

            })
                .then(response => {
                    
                    if(!$Token){
                        this.$router.push('/loginPage');
                    }else{
                        this.user=response.data.user;
                    }
                })
                .catch(error => {
                    console.log(error.response);
                    console.log("ERROR");
                    this.$store.commit("setUser",null);
                    this.$router.push('/loginPage');
                    this.logout();
                })

        }
        }
    }
</script>