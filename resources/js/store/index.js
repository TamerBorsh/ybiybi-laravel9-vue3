import { createApp } from 'vue'
import { createStore } from 'vuex'
import axios from 'axios'

// Create a new store instance.
const store = createStore({

    state: {
        token: localStorage.getItem('token') || 0,
        user :{},
    },

    mutations: {

    },

    actions: {

    },

    getters: {
        // get state variable value
        getToken: function (state) {
            return state.token
        }
        
    }

})

export default store;