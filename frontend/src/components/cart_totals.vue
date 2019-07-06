<template>

  <div id='app'>
    <v-app id="inspire">
    <v-container fluid grid-list-md>
        <h3>Your Bill</h3>
    <table class="datatable table">
      <tbody>
        <tr>
          <td><br>Name:</td>
          <td class="text-xs-right">{{getName}}</td>
          <td class="text-xs-right">
              <v-flex xs14 sm5>
            <v-btn flat icon color="black">
              <v-icon>edit</v-icon>
            </v-btn>
            </v-flex>
          </td>
        </tr>
        <tr>
          <td><br>Number of items :</td>
          <td class="text-xs-right"> <br> {{ item_count }} </td>
          <td class="text-xs-right">
             <v-flex xs14 sm5>
            <v-btn flat icon color="black">
              <v-icon>edit</v-icon>
            </v-btn>
            </v-flex>
          </td>
          
        </tr>
        <tr>
          <td>Subtotal:</td>
          <td class="text-xs-right">{{ subtotal | money }}</td>
          <td>
             <v-flex xs14 sm5>
            </v-flex>
          </td>
        </tr>
        
        <tr>
          <td>Discount:</td>
          <td class="text-xs-right">{{ Promotions }}</td>
          <td>
             <v-flex xs14 sm5>
            </v-flex>
          </td>
        </tr>
        <tr>
          <td><strong>Grand Total:</strong></td>
          <td>
             <v-flex xs14 sm5>
            </v-flex>
          </td>
          <td class="text-xs-right"><strong>{{ grand_total }}</strong></td>
        </tr>

      </tbody>
    </table>
    <v-btn color="success" href="https://sandbox.payhere.lk/pay/checkout">Pay Now</v-btn>
   
    <v-btn flat href="/home">Cancel</v-btn>
    </v-container>
    </v-app>
  </div><!-- .table__overflow -->

</template>

<script>
export default {
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
        getName(){return }

    },

    editItems(){
        
    }
}
</script>


