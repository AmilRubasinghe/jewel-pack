import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        loader:false
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