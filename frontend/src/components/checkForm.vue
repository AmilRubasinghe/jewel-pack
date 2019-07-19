<template>
<v-container>
    <v-form>
        <h4>Customer details</h4>
        Name:   <input type="text" name="name" value="Ridmi" ><br><br>
        Email:  <input type="text" name="email" value="samanp@gmail.com" ><br><br>
        Address: <input type="text" name="address" value="No.1, Galle Road,Colombo"><br><br>

        <input type="hidden" name="merchant_id" value="1212709" v-model="checkoutDetails.merchant_id">
        <input type="hidden" name="return_url" value="https://sample.com/return" v-model="checkoutDetails.return_url">
        <input type="hidden" name="cancel_url" value="https://sample.com/cancel" v-model="checkoutDetails.cancel_url">
        <input type="hidden" name="notify_url" value="https://sample.com/notify" v-model="checkoutDetails.notify_url"> 

        <h4>order details</h4>
            Order-Id: <input type="text" name="order_id" value="ItemNo12345" v-model="checkoutDetails.order_id"><br>
            Item:     <input type="text" name="items" value="gem boxes" v-model="checkoutDetails.items"><br>
            Amount :  <input type="text" name="amount" value="1000" v-model="checkoutDetails.amount"><br><br>
            Currency :  <input type="text" name="currency" value="LKR" v-model="checkoutDetails.currency"><br><br>

         <v-btn color="success" @click.native.prevent="sendData">Pay now</v-btn>  
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
            email:"",
            address:"",  
            merchant_id:"1212709",
            order_id:"",
            items:"",
            amount:"",
            currency:"",   
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
