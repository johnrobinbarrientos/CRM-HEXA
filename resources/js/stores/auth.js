import Vue from 'vue'
import axios from 'axios'
import router from '../routes.js'

export default {
  strict: true, // make sure everything us mutated, no direct editing of state
  name: 'auth',
  state: {
    user: null,
    isAuthenticated: false
  },
  getters: {
    isAuthenticated: state => {
        return state.isAuthenticated
    },
  },
  mutations: {
    authenticate  (state, payload) {
        localStorage.setItem(window.TOKEN_KEY, payload.token);
        state.isAuthenticated = true
        router.push({name: 'home'})
    },
    revoke (state, payload) {
        var token = (localStorage.getItem(window.TOKEN_KEY) === null || localStorage.getItem(window.TOKEN_KEY) === '') ? 'INVALID' : localStorage.getItem(window.TOKEN_KEY)
        var headers = {
            'X-Requested-With': 'XMLHttpRequest',
            'Authorization': 'Bearer ' + token
        }

        axios
        .get(window.API_URL + '/auth/revoke',{ 
            params: { },
            'headers': headers 
        })
        .then(response => {
          if (response.data.success) {
            state.isAuthenticated = false
            localStorage.removeItem(window.TOKEN_KEY);
            router.push({name: 'auth'})
          }
        })
        .catch(function (error) {
            state.isAuthenticated = false
            localStorage.removeItem(window.TOKEN_KEY)
            router.push({name: 'auth'})
        })
    },
    checkAuthenticated (state, payload) {
        var token = (localStorage.getItem(window.TOKEN_KEY) === null || localStorage.getItem(window.TOKEN_KEY) === '') ? 'INVALID' : localStorage.getItem(window.TOKEN_KEY)
        var headers = {
            'X-Requested-With': 'XMLHttpRequest',
            'Authorization': 'Bearer ' + token
        }

        axios
        .get(window.API_URL + '/auth/check',{ 
            params: { },
            'headers': headers 
        })
        .then(response => {
          if (response.data.success) {
            state.isAuthenticated = true
          } else {
            state.isAuthenticated = false
            router.push({name: 'auth'})
            localStorage.clear()
          }
        })
        .catch(function (error) {
            var data = error.response.data
            var code = error.response.status
            if (code === 401) {
                //router.push({name: 'auth'})
                localStorage.clear()
            }
        })
    },
  },
  actions: {
    authenticate ({ commit, state }, payload) {
        commit('authenticate', payload)
    },
    revoke ({ commit, state }, payload) {
        commit('revoke', payload)
    },
    checkAuthenticated ({ commit, state }, payload) {
        commit('checkAuthenticated', payload)
    }
  }
}
