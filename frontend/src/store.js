import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from 'vuex-persistedstate';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        loader:false,
        loggedIn: true,
        user:null
    },

    getters : {
        loggedIn: state => {
            return state.loggedIn
           },
        loader: state => {
            return state.loader
        },
        user: state => {
            return state.user
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
        }
    },

    actions: {
        logout (context) {
            this.$router.push('/')
        },
        setUser(context,payload){
            context.commit('setUser', payload)
        }
        
      },

      plugins: [createPersistedState()]


});