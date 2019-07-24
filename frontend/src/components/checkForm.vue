<template>
<v-container>
    <v-form action='https://sandbox.payhere.lk/pay/checkout'>
        <v-container>
            <div class="form-group form-group-lg">
        <h4>Customer details</h4>
        Name:   <input type="text" name="name"  v-model="checkoutDetails.name" ><br><br>
        Email:  <input type="text" name="email" v-model="checkoutDetails.email" ><br><br>
        Address: <input type="text" name="address" v-model="checkoutDetails.address"><br><br>

        <input type="hidden" name="merchant_id"  v-model="checkoutDetails.merchant_id">
        <input type="hidden" name="return_url" value="https://sample.com/return" v-model="checkoutDetails.return_url">
        <input type="hidden" name="cancel_url" value="https://sample.com/cancel" v-model="checkoutDetails.cancel_url">
        <input type="hidden" name="notify_url" value="https://sample.com/notify" v-model="checkoutDetails.notify_url"> 

        <h4>order details</h4>
            Order-Id: <input type="text" name="order_id" v-model="checkoutDetails.order_id"><br>
            Item:     <input type="text" name="items"  v-model="checkoutDetails.items"><br>
            Amount :  <input type="text" name="amount"  v-model="checkoutDetails.amount"><br><br>
            Currency :  <input type="text" name="currency"  v-model="checkoutDetails.currency"><br><br>

         <v-btn color="success" @click.native.prevent="sendData">Pay now</v-btn> 
            </div>
        </v-container> 
    </v-form>
</v-container>
    
</template>


<script>
import axios from 'axios';
import checkVue from './check.vue';

//import checkFormVue from './checkForm.vue';
export default {
    data(){
        return{
         checkoutDetails:{ 
            name:"",
            email:"ridmianjula@gmail.com",
            address:"Galle road,Colombo.",  
            merchant_id:"1212709",
            order_id:"ItemNo12345",
            items:"gem boxes",
            amount:"1000",
            currency:"LKR",   
          }
        }
    },
    methods:{
        sendData(){

           if (!this.errors.any()) {
                axios.post('http://localhost:8000/api/checkoutDetails' , this.checkoutDetails,
                 {     

            }).then(response=>{
                console.log(response.data.message);
                    
                     
                })
                .catch(error=>{
                    console.log(error.response);
                    console.log("ERROR");
                })
            }
        }
    }

}
</script>
