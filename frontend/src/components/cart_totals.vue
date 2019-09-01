<template>

  <div id='app'>
    <v-app id="inspire">
    <v-container fluid grid-list-md>
        <h3 style="color:#FFCA28;">Your Bill</h3>
  <v-form method="post" action="https://sandbox.payhere.lk/pay/checkout" target="_blank">
    <table class="datatable table">
      <tbody>
        <h4 style="color:#827717;">Customer Details</h4>
        <tr>
          <td><br>First Name:</td>
          <td class="sm-only-text-right"><br>
          <input type="text" name="first_name" v-model="checkoutDetails.first_name">
          </td>
          <td class="text-xs-right">
          </td>
        </tr>
         <tr>
          <td><br>Last Name:</td>
          <td class="sm-only-text-right"><br>
          <input type="text" name="last_name" v-model="checkoutDetails.last_name">
          </td>
        </tr>

        <tr>
          <td><br>Email:</td>
          <td class="sm-only-text-right"><br>
          <input type="text" name="email" v-model="checkoutDetails.email">
          </td>
        </tr>

        <tr>
          <td><br>Address:</td>
          <td class="sm-only-text-right"><br>
            <input type="text" name="address" v-model="checkoutDetails.address">
          </td>
        </tr>

        <tr>
          <td><br>Contact No:</td>
          <td class="sm-only-text-right"><br>
          <input type="text" name="phone" v-model="checkoutDetails.phone">
          </td>
        </tr>
        <tr><td></td><td class="sm-only-text-right"></td></tr>
      </tbody>
    </table>

    
      <table class="datatable table">
      <tbody>
        <h4 style="color:#827717;">Order Details</h4>
        <tr>
          <td><br>Order ID :</td>
          <td class="sm-only-text-right"> <br> 
          <input type="text" name="order_id" v-model="checkoutDetails.order_id" readonly>
          </td>
        </tr>

        <tr>
          <td><br>Items:</td>
          <td class="sm-only-text-right"><br> 
          <input type="text" name="items" v-model="checkoutDetails.items" readonly>
          </td>
        </tr>

        <tr>
          <td><br>Subtotal:</td>
          <td class="sm-only-text-right"><br> 
           <input type="text" name="amount"  v-model="checkoutDetails.amount" readonly>
          </td>
        </tr>
        
        <tr>
          <td><br>Currency:</td>
          <td class="sm-only-text-right"><br>
           <input type="text" name="currency"  v-model="checkoutDetails.currency" readonly>
          </td>
          <td>
             <v-flex xs14 sm5>
            </v-flex>
          </td>
        </tr>
        
        <tr>
          <td>Discount:</td>
          <td class="sm-only-text-right"></td>
          <td>
          </td>
        </tr>
        <tr>
          <td><strong>Grand Total:</strong></td>
          <td>
            
          </td>
          <td class="sm-only-text-right"><strong>{{ grand_total }}</strong></td>
        </tr>
      </tbody>
    </table>

     <input type="hidden" name="merchant_id" value="1212709" v-model="checkoutDetails.merchant_id">
     <input type="hidden" name="return_url"  v-model="checkoutDetails.return_url">
     <input type="hidden" name="cancel_url"  v-model="checkoutDetails.cancel_url">
     <input type="hidden" name="notify_url"  v-model="checkoutDetails.notify_url"> 
     <input type="hidden" name="custom_1"  v-model="checkoutDetails.email"> 

     <v-btn color="amber" type="submit">Pay now</v-btn> 
    <v-btn color="#FFF176" href="/home">Cancel</v-btn>
  </v-form>
    </v-container>
    </v-app>
  </div><!-- .table__overflow -->

</template>

<script>
import axios from 'axios';

export default {
    
    data(){
       return{
         
         checkoutDetails:{
            merchant_id : "1212709",
            return_url : "http://localhost:8080/",
            cancel_url : "http://localhost:8080/",
            notify_url : "https://webhook.site/5f37258e-8750-4fa3-aea1-b045ffadb9ab",
            first_name:"",
            last_name:"",
            address:"",
            email:"",
            order_id:"",
            phone:"",
            items : "Gem Boxes",
            currency : "LKR",
            amount :"",  
            custom_1: this.email
         },
         
       }
    },

     mounted(){
       this.autoFill();
    },

    editedIndex: -1,

    computed:{
        items(){return this.$store.state.cart},
        item_count(){return this.$store.state.cartCount},
        subtotal(){
            let total =0;
            for(let item of this.$store.state.cart){
                total+=((item.Price)*(item.qty));
            }
            return total.toFixed(2);
        },
        promotions(){
            
        },
        grand_total(){
          //let grand=0;
         // grand+=subtotal-promotions;
          //return grand.toFixed(2);
        },  

    },

    methods:{

    autoFill(){
      axios
        .get("http://localhost:8000/api/showUser")
        .then(response => {
          this.checkoutDetails.first_name= response.data.printUser.firstName;
          this.checkoutDetails.last_name= response.data.printUser.lastName;

          console.log(this.first_name);
        })
        .catch(error => {
          console.log(error.response);
          console.log("ERROR");
        });

        axios
        .get("http://localhost:8000/api/showOrder")
        .then(response => {
          this.checkoutDetails.email = response.data.printOrder.customerEmail;
          this.checkoutDetails.order_id=response.data.printOrder.OID;
          this.checkoutDetails.phone=response.data.printOrder.contactNo;
          this.checkoutDetails.address=response.data.printOrder.deliveryAddress;
          console.log(this.email);
        })
        .catch(error => {
          console.log(error.response);
          console.log("ERROR");
        });

        this.checkoutDetails.amount=this.subtotal;
    },

    /* saveData(){

            if (!this.errors.any()) {
                axios.post('http://localhost:8000/api/checkDetails',this.checkoutDetails
                , {

            }).then(response=>{
                console.log(response.data.message);
                    
                     
                })
                .catch(error=>{
                    console.log(error.response);
                    console.log("ERROR");
                })
            }

           
        }*/
}
}
</script>


