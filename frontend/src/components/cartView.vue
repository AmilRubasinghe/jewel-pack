<template>
    <div>
        <br><br>
        <div class="display-1" align="center">Your Cart</div>
        <br><br>
        <v-card>
            <v-list two-line>
                <template v-for="(item,index) in $store.state.cart">

                    <v-list-tile avatar :key="item.Size">
                    <v-list-tile-avatar>
                        <img   :src="item.Image">
                    </v-list-tile-avatar>

                    <v-list-tile-content>
                        <v-list-tile-title v-html="item.Size + item.Colour">
                        </v-list-tile-title>
                    <v-list-tile-sub-title>
                        Quantity: {{ item.qty }} &nbsp; - &nbsp;
                        {{ item.Price}} $
                    </v-list-tile-sub-title>
                    </v-list-tile-content>
                    <v-list-tile>
                        {{item.Price}}$
                    </v-list-tile>

                    <v-list-tile-action>
                        <v-text-field lable="Quantity" reverse :value="item.qty"></v-text-field>
                    </v-list-tile-action>
                    <v-list-tile>
                        {{item.qty * item.Price}}$
                    </v-list-tile>
                    

                    <v-list-tile-action>
                        <v-btn icon ripple @click.native="removeItem(item)">
                        <v-icon color="red-lighten-1">
                        delete
                        </v-icon>
                        </v-btn>
                    </v-list-tile-action>
                    </v-list-tile>

                    <v-divider v-if="index+1 < $store.state.cart.length" :key="index"></v-divider>
                </template>
            </v-list>

            <v-card-actions class="justify-center">
            <v-btn color="success"
                   v-if="item_count > 0"
                   to="/check">
             Check out
            </v-btn>
            </v-card-actions>
        </v-card>

        <s-check v-model="Check"></s-check>
    </div>

</template>

</<script>
export default {
    data(){
        return{
             Check:false,
        }
       
    },

    computed:{
         //return
                //this.$store.getters.item},

        item_count(){
            return this.$store.state.cartCount;
        },    
        },

    methods:{
        removeItem(item){
            this.store.dispatch('removeFromCart',item);
        },

    }

    }

</script>


