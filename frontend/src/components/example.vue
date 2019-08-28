<template>
<v-container>
    <h3>Your Bill</h3>    <form method="post" action="https://sandbox.payhere.lk/pay/checkout">   
    <input type="hidden" name="merchant_id" value="1212709">    <!-- Replace your Merchant ID -->
    <input type="hidden" name="return_url" value="http://sample.com/return">
    <input type="hidden" name="cancel_url" value="http://sample.com/cancel">
    <input type="hidden" name="notify_url" value="http://sample.com/notify">  
    <br><br><h4>Item Details</h4><br>
    <input type="text" name="order_id" value="ItemNo12345">
    <input type="text" name="items" value="Door bell wireless"><br>
    <input type="text" name="amount" :value="total()"><br>
     <input type="text" name="currency" value="LKR"> 
    <br><br><h4>Customer Details</h4><br>
    Name: <input type="text" name="first_name" value="Saman">
    <input type="text" name="last_name" value="Perera"><br>
    Email: <input type="text" name="email" value="samanp@gmail.com"><br>
    Phone: <input type="text" name="phone" value="0771234567"><br>
    Address: <input type="text" name="address" value="No.1, Galle Road"><br>
    City: <input type="text" name="city" value="Colombo">
    Country: <input type="hidden" name="country" value="Sri Lanka"><br><br> 
    <input type="submit" value="Buy Now" >   
    </form> 
</v-container>
</template>

<script>
export default {
    methods:{
         total(){
            let total =100;
            for(let item of this.$store.state.cart){
                total+=((item.Price)*(item.qty));
            }
            return total.toFixed(2);
        }
    }
}
</script>
