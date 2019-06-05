 

<template>
  <v-container grid-list-md text-xs-center>
    <v-layout row wrap>

   

 

   <v-flex

        xs12

        md4

      >

     

          <v-avatar

            slot="offset"

            class="mx-auto d-block"

            size="250"

          >

            <img

              src="https://demos.creative-tim.com/vue-material-dashboard/img/marc.aba54d65.jpg"

            >

          </v-avatar>

         

          <v-card-text class="text-xs-center">

            <h6 class="category text-gray font-weight-thin mb-3">CEO / CO-FOUNDER</h6>

            <h4 class="card-title font-weight-light">Alec Thompson</h4>

            <p class="card-description font-weight-light">Don't be scared of the truth because we need to restart the human foundation in truth And I love you like Kanye loves Kanye I love Rick Owens’ bed design but the back is...</p>

           s

          </v-card-text>

    

    

</v-flex>

 

<v-flex

        xs12

        md8

       

      >

  <form>

    <v-flex xs3 >
          <v-text-field
            label="Full Name"
           
            readonly
           
          ></v-text-field>
        </v-flex>

    <v-flex xs6 >
          <v-text-field
            v-model="fullname"
           
            readonly
           
          ></v-text-field>
        </v-flex>

        <v-flex xs12 sm6>
          <v-text-field
            v-model="user.email"
           
            readonly
      
          ></v-text-field>
        </v-flex>


<v-dialog v-model="dialog">
        <v-card>
          <v-card-title>
            <span class="headline">Edit User</span>
          </v-card-title>

          <v-card-text>
            <v-container grid-list-md>
              <v-layout wrap>
                                  
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="user.firstName" label="First Name" ></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="user.lastName" label="Last Name" ></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="user.contactNo" label="Contact No" ></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="user.email" label="Email" ></v-text-field>
                </v-flex>
                
              </v-layout>
            </v-container>
          </v-card-text>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" flat >Cancel</v-btn>
            <v-btn color="blue darken-1" flat >Save</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>


    


   

 

    <v-btn @click="dialog=true" >Update</v-btn>

  

  </form>

</v-flex>

    </v-layout>
  </v-container>
</template>

 

<script>
import axios from 'axios'

import Store from '../store.js'

export default {

data(){
  return{
  user:[],
  dialog: false,
  }
},

computed: {
    fullname: function(){
        return this.user.firstName + ' ' + this.user.lastName;
    }
  },


created: function () {

           this.me();

            // this.user=response.data.user;

           

            if(Store.getters.user){

                this.user=Store.getters.user;

            }else{

                this.logout();

            }

           

            

         },
  

  methods: {
    logout() {
      let $Token = localStorage.getItem("token");
      /* console.log(Token);*/

      // this.$http.post('http://localhost:8000/api/logout?token='+$Token)
      axios
        .post("http://localhost:8000/api/logout?token=" + $Token)
        .then(response => {
          localStorage.removeItem("token");
          let $Token = localStorage.getItem("token");
          if (!$Token) {
            this.$store.commit("setUser", null);
            this.$router.push("/loginPage");
          }
        })
        .catch(error => {
          console.log(error.response);
          console.log("ERROR");
        });
    },

    me() {
      let $Token = localStorage.getItem("token");

      axios
        .post("http://localhost:8000/api/me?token=" + $Token, {})
        .then(response => {
          if (!$Token) {
            this.$router.push("/loginPage");
          } else {
            this.user = response.data.user;
            Store.dispatch("setUser", this.user);
          }
        })
        .catch(error => {
          console.log(error.response);
          console.log("ERROR");
          this.$store.commit("setUser", null);
          this.$router.push("/loginPage");
          this.logout();
        });
    },
  }
}
</script>