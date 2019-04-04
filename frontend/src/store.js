import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from 'vuex-persistedstate';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        loader:false
    },

    getters : {
       
      },

    mutations:{

        LOADER(state,payload){
            state.loader=payload;
        }
    },

    actions: {
        logout (context) {
            this.$router.push('/')
        }
      }


});