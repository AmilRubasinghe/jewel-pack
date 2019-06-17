import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from 'vuex-persistedstate';
import { totalmem } from 'os';


Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        loader:false,
        user:null,
        Items:[],
        
    },

    getters : {
        loader: state => {
            return state.loader
            
        },
        user: state => {
            if(state.user){
                return state.user
            }else{
                state.user=null
                return false;
            }
            
            
        },

        role: state => {
            
            if(state.user){
                return state.user.role;
            }
                
            else{
                
                return false;
            }
            
        },
        isAdmin: state => {
            if(state.user){
                if(state.user.role="admin"){
                    return true
                }else{
                    return false;
                }
            }
            else{
                return false;
            }
            
            
        },
        isAdminEditor: state => {
            if(state.user){
            if((state.user.role="admin")||(state.user.role="editor")){
                return true
            }else{
                return false;
            }
        }else{
            return false;
        }
            
        },

        cartItemList:state => {
            state.cartView.Items;
        },

        cartItems: state => {
            let Items = state.cartView.Items;
            let cart = [];

            Items.forEach((item,index) => {
                let found = state.products.Items.find(
                    (selectedItem) => item.id == selectedItem.PID
                );
                cart.push({
                    ...found,
                    quantity: item.quantity,
                });
            });
            return cart;
        },

        cartItemCount: state => {
            return cartItems(state).reduce((totalmem,current) => {
                   return total+current['quantity']},0);
            },
        
      },
    
    mutations:{

        LOADER(state,payload){
            state.loader=payload;
        },

        loggedIn(state,payload){
            state.isLoggedIn=payload;
        },

        setUser(state,payload){
            state.user=payload;
        },

        ADD_TO_CART(state,ProductId){
            const found = state.Items.find(selectedItem => selectedItem.PID == ProductId);
            if(found){
                found.quantity++;
            }
            else{
                state.Items.push({
                    id:ProductId,
                    quantity:1,
                });
            }
        },

        REMOVE_FROM_CART(state,removeProduct){

        },

    },

    actions: {
        logout (context) {
            this.$router.push('/')
        },
        setUser(context,payload){
            context.commit('setUser', payload)
        },
        addItemToCart({ commit },selectedItem){
              commit('ADD_TO_CART',selectedItem.PID);
          },
        
        removeItemFromCart({comit},selectedItem){
            comit('REMOVE_FROM_CART',selectedItem)
        }
        
      },

      plugins: [createPersistedState()]

    

});