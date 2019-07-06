<template>
<v-container>
  <br>
 <h4 class="display-1" text-color="blue" align="center">Check-out</h4>
<br>
  <v-stepper v-model="e6" vertical>
    <v-stepper-step :complete="e6 > 1" step="1">
      Customer
      <small>Checking out as a Guest? 
            You'll be able to save your details to create an account with us later.</small>
    </v-stepper-step>

    <v-stepper-content step="1">
      <v-layout>

                   <v-flex xs4 sm3>
                    <v-text-field
                     v-model="Email"
                     label="Email"
                     box
                    ></v-text-field>
                   </v-flex>
                   <v-flex sm5 >
                       <v-btn medium>Checkout as a guest</v-btn>
                   </v-flex>    
      </v-layout>             
      <v-btn color="primary" @click="e6 = 2">Continue</v-btn>
      <v-btn flat>Cancel</v-btn>
    </v-stepper-content>

    <v-stepper-step :complete="e6 > 2" step="2">Billing</v-stepper-step>

    <v-stepper-content step="2">
      <template>
          <v-form>
              <v-container>
              <v-layout row wrap>

                   <v-flex xs4 sm4>
                    <v-text-field
                     v-model="first"
                     label="First Name"
                     box
                    ></v-text-field>
                   </v-flex>

                   <v-flex xs4 sm4>
                   <v-text-field
                     v-model="last"
                     label="Last Name"
                     box
                   ></v-text-field>
                   </v-flex>

                   <v-flex xs8>
                   <v-text-field
                     v-model="Phone"
                     label="Phone Number(Required)"
                     box
                   ></v-text-field>
                   </v-flex>

                   <v-flex xs8>
                   <v-text-field
                     v-model="address"
                     label="Address"
                     box
                   ></v-text-field>
                   </v-flex>

                   <v-flex xs8>
                   <v-text-field
                     v-model="code"
                     label="Postal Code (required)"
                     box
                   ></v-text-field>
                   </v-flex>
                   <v-flex xs8>
                     <v-checkbox
                     v-model="checkbox"
                     lable="My shipping address is the same as my billing address.">
                     </v-checkbox>
                   </v-flex>  
               </v-layout>
               </v-container>
          </v-form>
       </template>

      <v-btn color="primary" @click="e6 = 3">Continue</v-btn>
      <v-btn flat @click.native="e6 = 1">Previous</v-btn>
      <v-btn flat>Cancel</v-btn>
      

    </v-stepper-content>

    <v-stepper-step :complete="e6 > 3" step="3">Payment</v-stepper-step>
        
    <v-stepper-content step="3" @click="chekout()">
          
      <template> 
      
      <v-btn color="primary" href="/cart_totals">Place order</v-btn>
      <v-btn flat @click.native="e6=2">Previous</v-btn>
      <v-btn flat>Cancel</v-btn>
      </template>
    </v-stepper-content>
  </v-stepper>
</v-container>
</template>


<script>
 //import cart_totals from './components/cart_totals.vue'

  export default {
    components:{
          //'cart-totals':cart_totals
    },
    data () {
      return {
        e6: 1
      }
    },

    methods:{
         checkout(){
           
         }
    }
   
  }
</script>