<template>
<div>
<div class="container box">

<form class="form-signin">
            <h1 align="center">Profile</h1>
            <h3>ID : {{ user.ID }}</h3>
            <h3>Name : {{ user.firstName }} {{ user.lastName }}</h3>
            <h3>Email : {{ user.email }}</h3>
            
            
</form>

    <button @click="logout" class="btn btn-lg btn-primary btn-block">Sign out</button>
     <button @click="me" class="btn btn-lg btn-primary btn-block">Profile</button>
    </div>
    </div>
</template>


<script>
import axios from 'axios'


    export default {
        data() {
            return {
                user:[]
            }
        },

        props: ['userL'],

        created: function () {
           this.me();
            // this.user=response.data.user;
            
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
                console.log($Token);
                 

                
            //this.$http.post('http://localhost:8000/api/me?token='+$Token)
            axios.post('http://localhost:8000/api/me?token='+$Token
                , {

            })
                .then(response => {
                    console.log(response.data.user);
                    this.user=response.data.user;
                    if(!$Token){
                        this.$router.push('/loginPage');
                    }
                })
                .catch(error => {
                    console.log(error.response);
                    console.log("ERROR");
                    this.logout();
                })

        }
        }
    }
</script>