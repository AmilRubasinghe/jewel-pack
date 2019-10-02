<template>
<v-container>
  <br>
 <h4 class="display-1" text-color="blue" align="center">Check-out</h4>
<br>
  <v-stepper v-model="e6" vertical>
    <v-stepper-step :complete="e6 > 1" step="1">
      Customer
      <small>Checking out as a Guest? You'll be able to save your details to create an account with us later.</small>
    </v-stepper-step>

    <v-stepper-content step="1">
      <template>
        <div id="app">
        <v-app id="inspire">
         <v-form v-model="valid" ref="form" @submit.prevent="saveData" >
         <v-container>
   <v-flex xs12 sm6>
    <v-text-field
      label="First Name"
      id="fn"
      v-model="checkDetails.firstname"
      :rules="nameRules"
      :counter="50"
      required
      box
      background-color="#F5F5F5"
      color="#FFAB00"
    ></v-text-field>
   </v-flex>
   <v-flex xs12 sm6>
    <v-text-field
      label="Last Name"
      id="ln"
      v-model="checkDetails.lastname"
      :rules="nameRules"
      :counter="50"
      required
      box
      background-color="#F5F5F5"
      color="#FFAB00"
    ></v-text-field>
   </v-flex>
   <v-flex xs12 sm6>
    <v-text-field
      label="E-mail"
      id="email"
      v-model="checkDetails.email"
      :rules="emailRules"
      required
      box
      background-color="#F5F5F5"
      color="#FFAB00"
    ></v-text-field>
   </v-flex>
   <v-flex xs12 sm6>
     <v-text-field
      label="Contact No"
      v-model="checkDetails.phone"
      :rules="PhoneRules"
      required
      box
      background-color="#F5F5F5"
      color="#FFAB00"
    ></v-text-field>
   </v-flex>
   <v-flex xs12 sm6>
    <v-text-field
      label="Postal Code"
      v-model="checkDetails.postalcode"
      :rules="codeRules"
      required
      box
      background-color="#F5F5F5"
      color="#FFAB00"
    ></v-text-field>
   </v-flex>
   <v-flex xs12 sm6>
     <v-text-field
      label="Delivery Address"
      v-model="checkDetails.address"
      :rules="AddressRules"
      required
      box
      background-color="#F5F5F5"
      color="#FFAB00"
    ></v-text-field>
   </v-flex> 
  </v-container>
      <v-btn type="submit" :class="{ red: !valid, amber: valid }"  @click="e6 = 2" :disabled="!valid">Continue</v-btn>
      <v-btn color="#FFF176">Cancel</v-btn>
  </v-form>
  </v-app>
  </div>
 </template>

    </v-stepper-content>

    <v-stepper-step :complete="e6 > 2" step="2">Payment</v-stepper-step>
        
    <v-stepper-content step="2">
          
      <template> 
       Enter coupon code here: <input type="text" id="couponcode" name="couponcode" >
       <v-btn color="primary" @click="coupon()">Enter</v-btn><br><br>

      <v-btn color="amber" href="/cart_totals" @click="check()">Place order</v-btn>
      <v-btn color="#FFCA28" @click.native="e6=1">Previous</v-btn>
      <v-btn color="#FFF176">Cancel</v-btn>
      </template>
    </v-stepper-content>
  </v-stepper>
</v-container>
</template>


<script>
 //import cart_totals from './components/cart_totals.vue'
import alert from './alert.vue';
import axios from 'axios';
import Store from "../store.js";


  export default {
    components:{
          //'cart-totals':cart_totals
         
    },
    data () {
      return {
        user:[],
        valid: false,
        name: 'Default',
        nameRules: [
          (v) => !!v || 'Name is required',
          (v) => v && v.length <= 50 || 'Name must be less than 20 characters'
        ],
        email: '',
        emailRules: [
          (v) => !!v || 'E-mail is required',
          (v) => /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'E-mail must be valid'
        ],
        phone:'',
        PhoneRules:[
             (v) => !!v || 'Contact No is required',
             (v) => v && v.length == 10 || 'Phone must be valid',
             (v) => /^\d{10}$/.test(v) || 'Phone number should only contains numbers'
            
        ],
        postalcode:'',
        codeRules:[
            (v) => !!v || 'Postal code is required',
            (v) => /^[0-9]{5}(?:-[0-9]{4})?$/.test(v) || 'Postal Code should be valid'
        ],

        address:'',
        AddressRules:[
             (v) => !!v || 'Address is required',
        ],

        checkDetails:{
            email:"",
            firstname:"",
            lastname:"",
            phone:"",
            postalcode:"",
            address:"",
            order_status:"success"
            
        },

       
        e6: 1
      }
    },

    components:{
           alert
    },

    computed:{
      isComplete () {
          return this.email;
  }
     
    },
    mounted(){
      this.autoFill();
    },

    methods:{

          saveData(){

            if (!this.errors.any()) {
                axios.post(this.$baseUrl+'/checkDetails',this.checkDetails
                , {

            }).then(response=>{
                console.log(response.data.message);
                    
                     
                })
                .catch(error=>{
                    console.log(error.response);
                    console.log("ERROR");
                })
            }

           
        },
        
        coupon(){
        },

        autoFill(){
          if(Store.getters.user){
            this.user=Store.getters.user;
            this.checkDetails.email=this.user.email;
            this.checkDetails.firstname=this.user.firstName;
            this.checkDetails.lastname=this.user.lastName;
            //set user login fields constants
            document.getElementById('fn').readOnly=true;
            document.getElementById('ln').readOnly=true;
            document.getElementById('email').readOnly=true;
            var fnval=document.getElementById('fn');
            fnval.style.color="#CD853F";
            var lnval=document.getElementById('ln');
            lnval.style.color="#CD853F";
             var emailval=document.getElementById('email');
            emailval.style.color="#CD853F";
          }
    }
    }
  }
  
</script>