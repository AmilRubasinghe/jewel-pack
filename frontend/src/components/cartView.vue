<template>
    <div class="container">
        <br><br>
        <div class="display-1" align="center">Your Cart</div>
        <br><br>
        <v-card>
            <v-list two-line>
             <div v-if="$store.state.cartCount>0">   
                <template v-for="(item,index) in $store.state.cart">

                    <v-list-tile avatar :key="item.Size" >
                    <v-list-tile-avatar>
                        <img   :src="item.Image">
                    </v-list-tile-avatar>

                    <v-list-tile-content>
                        <v-list-tile-title v-html="item.Size + item.Colour">
                        </v-list-tile-title>
                    <v-list-tile-sub-title>
                        Quantity: {{ item.qty }} &nbsp; - &nbsp;
                        {{ item.Price}} $
                        
                            <span id="quantity" class="a-size-medium a-color-quantity">
                              <div class="minusplusnumber">
                                <div class="mpbtn minus" v-on:click="decrement()">-</div>
                                <div id="field_container">
                                  <input
                                    @change="valid()"
                                    type="number"
                                    v-model.number="value"
                                    onkeydown="javascript: return event.keyCode == 69 ? false : true"
                                  />
                                </div>
                                <div class="mpbtn plus" v-on:click="increment()">+</div>
                              </div>
                            </span>
                         
                    </v-list-tile-sub-title>
                    </v-list-tile-content>

                    <v-list-tile>
                        {{item.qty * item.Price}}$
                    </v-list-tile>
                    
                    <v-list-tile-action>
                        <v-btn icon ripple @click.native="refreahItem(item,value)">
                        <v-icon color="green" >
                        cached
                        </v-icon>
                        </v-btn>
                    </v-list-tile-action>
                    <v-list-tile-action>
                        <v-btn icon ripple @click.native="removeItem(item)">
                        <v-icon color="red-lighten-1" >
                        delete
                        </v-icon>
                        </v-btn>
                    </v-list-tile-action>
                    </v-list-tile>

                    <v-divider v-if="index+1 < $store.state.cart.length" :key="index"></v-divider>
                </template>
                <v-list-tile-sub-title align="middle">
                    Total : {{totalPrice}}
                </v-list-tile-sub-title>
             </div>
             
             <div v-else>
                 <v-list-tile-content align="middle">
                <h4> Your cart is empty.</h4>
                 </v-list-tile-content>
            </div>
             
            </v-list>

            <v-card-actions class="justify-center">
            <v-btn class="black--text"
                   color="#FFAB00"
                   align="right"
                   v-if="item_count > 0"
                   to="/check">
             Check out
            </v-btn>
            <v-btn class="gold--text"
                   color="#FFAB00"
                   align="right"
                   to="/products">
             Continue shopping
            </v-btn>
            </v-card-actions>
        </v-card>
    </div>

</template>

</<script>
export default {
    data(){
        return{
            
             //value:"item.qty",
             value:'',
             min:0,
             max: 500,
             size: 0

        }
       
       
    },
  mounted(){
    for(let item of this.$store.state.cart){
      this.autoFill();
       }
  },
    computed:{
         //return
                //this.$store.getters.item},

        item_count(){
            return this.$store.state.cartCount;
        },

        totalPrice(){
            let total =0;
            for(let item of this.$store.state.cart){
                total+=((item.Price)*(item.qty));
            }
            return total.toFixed(2);
        }    
        },

    methods:{
        removeItem(item){
            this.$store.commit('removeFromCart',item);
        },

        refreshItem(item,value){
            Vue.set(item, 'qty', value);
            this.$store.commit('addToCart',item);
        },

        increment() {
      if (this.value >= this.max) {
        alert("Available only " + this.max + " units");
        this.value = this.max;
      } else {
        this.value = this.value + this.size;
      }
    },
    decrement() {
      if (this.value <= this.min) {
        alert("Negative quantity not allowed");
        this.value = this.min;
      } else {
        this.value = this.value - this.size;
      }
    },

    autoFill(){
         for(let item of this.$store.state.cart){
            this.value=item.qty;
         }        
    },
    valid() {
      if (this.value >= this.max) {
        this.value = this.max;
      } else if (this.value <= this.min) {
        this.value = this.min;
      }
    }

    }

    }

</script>


