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
      
         <v-form @submit.prevent='getEmail'>

                   <v-flex xs4 sm3>
                    <v-text-field
                     v-model="checkDetails.email"
                     label="Email"
                     v-validate="'required'"
                     box
                    ></v-text-field>
                   </v-flex>   
         </v-form>
                   
      <v-btn color="primary" @click="e6 = 2">Continue</v-btn>
      <v-btn flat>Cancel</v-btn>
    </v-stepper-content>

    <v-stepper-step :complete="e6 > 2" step="2">Billing</v-stepper-step>

    <v-stepper-content step="2">
      <template>
          <v-form @submit.prevent='saveData'>
              <v-container>
              

                   <div class="form-group form-group-lg">
            <input type="text" class="form-control" id="firstname" placeholder="First Name" name="firstname" v-validate="'required'" v-model="checkDetails.firstname">
            <div v-show="errors.has('firstname')" class="help block alert alert-danger">
                    {{ errors.first('firstname') }}
            </div>
        </div>

        <div class="form-group form-group-lg">
            <input type="text" class="form-control" id="lastname" placeholder="Last Name" name="lastname" v-validate="'required'" v-model="checkDetails.lastname">
            <div v-show="errors.has('lastname')" class="help block alert alert-danger">
                    {{ errors.first('lastname') }}
            </div>
        </div>

                   <div class="form-group form-group-lg">
            <input type="text" class="form-control" id="phone" placeholder="Phone number" name="phone" v-validate="'required'" v-model="checkDetails.phone">
            <div v-show="errors.has('phone')" class="help block alert alert-danger">
                    {{ errors.first('phone') }}
            </div>
        </div>

        <div class="form-group form-group-lg">
            <input type="text" class="form-control" id="postalcode" placeholder="Postal Code" name="postalcode" v-validate="'required'" v-model="checkDetails.postalcode">
            <div v-show="errors.has('postalcode')" class="help block alert alert-danger">
                    {{ errors.first('postalcode') }}
            </div>
        </div>

         <div class="form-group form-group-lg">
            <input type="text" class="form-control" id="address" placeholder="Delivery Address " name="address" v-validate="'required'" v-model="checkDetails.address">
            <div v-show="errors.has('address')" class="help block alert alert-danger">
                    {{ errors.first('address') }}
            </div>
        </div>
       
              
               </v-container>
                <v-btn type="submit" color="primary" @click="e6 = 3">Continue</v-btn>
      <v-btn flat @click.native="e6 = 1">Previous</v-btn>
      <v-btn flat>Cancel</v-btn>
      
          </v-form>
       </template>

     

    </v-stepper-content>

    <v-stepper-step :complete="e6 > 3" step="3">Payment</v-stepper-step>
        
    <v-stepper-content step="3" @click="chekout()">
          
      <template> 
       Enter coupon code here: <input type="text" id="couponcode" name="couponcode" >
       <v-btn color="primary" @click="coupon()">Enter</v-btn><br><br>
      <v-btn color="primary" href="/checkForm">Place order</v-btn>
      <v-btn flat @click.native="e6=2">Previous</v-btn>
      <v-btn flat>Cancel</v-btn>
      </template>
    </v-stepper-content>
  </v-stepper>
</v-container>
</template>


<script>
 //import cart_totals from './components/cart_totals.vue'
import alert from './alert.vue';
import axios from 'axios';

  export default {
    components:{
          //'cart-totals':cart_totals
    },
    data () {
      return {
        checkDetails:{
            email:"",
            firstname:"",
            lastname:"",
            phone:"",
            postalcode:"",
            address:""
            
        },

       
        e6: 1
      }
    },

    components:{
           alert
    },

    computed:{
    },

    methods:{

          saveData(){

            this.$validator.validateAll()

            if (!this.errors.any()) {
                axios.post('http://localhost:8000/api/checkDetails',this.checkDetails
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
        }
    }
   
  }
</script>