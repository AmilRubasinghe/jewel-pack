<template>
<v-container>
    <v-form method="post" action="https://sandbox.payhere.lk/pay/checkout" target="_blank">
        <h4>Customer details</h4>
        First Name:   <input type="text" name="first_name" v-model="checkoutDetails.first_name" ><br><br>
        Last Name:  <input type="text" name="last_name" v-model="checkoutDetails.last_name" ><br><br>
        Email:  <input type="text" name="email" v-model="checkoutDetails.email" ><br><br>
        Address: <input type="text" name="address" v-model="checkoutDetails.address"><br><br>
        City: <input type="text" name="city" v-model="checkoutDetails.city"><br><br>
        Country: <input type="text" name="country" v-model="checkoutDetails.country"><br><br>
        Telephone: <input type="text" name="phone" v-model="checkoutDetails.phone"><br><br>

        <input type="hidden" name="merchant_id" value="1212709" v-model="checkoutDetails.merchant_id">
        <input type="hidden" name="return_url"  v-model="checkoutDetails.return_url">
        <input type="hidden" name="cancel_url"  v-model="checkoutDetails.cancel_url">
        <input type="hidden" name="notify_url"  v-model="checkoutDetails.notify_url"> 
        <input type="hidden" name="custom_1"  v-model="checkoutDetails.email"> 

        <h4>order details</h4>
            Order-Id: <input type="text" name="order_id" value="ItemNo12345" v-model="checkoutDetails.order_id"><br>
            Item:     <input type="text" name="items" value="gem boxes" v-model="checkoutDetails.items"><br>
            Amount :  <input type="text" name="amount"  v-model="checkoutDetails.amount"><br><br>
            Currency :  <input type="text" name="currency"  v-model="checkoutDetails.currency"><br><br>

         <v-btn color="success" type="submit">Pay now</v-btn>  
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
                    merchant_id : "1212709",
            return_url : "http://localhost:8080/",
            cancel_url : "http://localhost:8080/",
            notify_url : "https://webhook.site/08661338-c397-449a-9c32-4e89f6fbbe4e",
            first_name : "Thira",
            last_name : "Muna",
            email : "thira@gmail.com",
            phone : "0715418325",
            address : "Malimbada Gewatta, Nawimana South, Matara",
            city : "Matara",
            country : "Sri Lanka",
            order_id : "5",
            items : "Example Title",
            currency : "LKR",
            amount : "100",  
            custom_1: this.email,
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
