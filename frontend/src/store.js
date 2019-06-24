import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from 'vuex-persistedstate';
import { totalmem } from 'os';
//import axios from axios;

Vue.use(Vuex);


let cart = window.localStorage.getItem('cart');
let cartCount = window.localStorage.getItem('cartCount');


export default new Vuex.Store({
    state: {
        loader:false,
        user:null,
        
        
        cart: cart ? JSON.parse(cart) : [],
        cartCount: cartCount ? parseInt(cartCount) : 0,
        
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
        cartCount:state => {
            return state.cartCount ;
            
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




        addToCart(state, item) { 
            console.log(item);
            
            
            let found = state.cart.find(function(element) {
                return element.PID ==item.PID;
              });

            //let found = state.cart.find(product => product.PID == item.PID); Short form of above function

        //console.log("++++++");
        state.cartCount+=item.qty;
        
            if (found) {
                console.log(found);         
                found.qty += item.qty;
                found.totalPrice = found.qty * found.Price;
            } else {
                             
//                Vue.set(item, 'qty', noItems);

                Vue.set(item, 'totalPrice', (item.Price*item.qty));
                state.cart.push(item);
            }
            //state.cartCount++;
           // state.cartCount+=item.qty;
            this.commit('saveCart');
            console.log(state.cart);   
        },

        removeFromCart(state, item) {
            let index = state.cart.indexOf(item);
        
            if (index > -1) {
                let product = state.cart[index];
                state.cartCount -= product.qty;
        
                state.cart.splice(index, 1);
            }
            this.commit('saveCart');
        },

        saveCart(state) {
            window.localStorage.setItem('cart', JSON.stringify(state.cart));
            window.localStorage.setItem('cartCount', state.cartCount);
        }


    },

    actions: {
        logout (context) {
            this.$router.push('/')
        },
        setUser(context,payload){
            context.commit('setUser', payload)
        },   
        
      },

      plugins: [createPersistedState()]

    

});