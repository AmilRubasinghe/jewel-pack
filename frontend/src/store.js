import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from 'vuex-persistedstate';


Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        loader:false,
        user:null,
        
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

    },

    actions: {
        logout (context) {
            this.$router.push('/')
        },
        setUser(context,payload){
            context.commit('setUser', payload)
        },
        addItemToCart({ commit }, productItems){
              commit('ADD_TO_CART',productItems.PID);
          }
        
      },

      plugins: [createPersistedState()]

    

});