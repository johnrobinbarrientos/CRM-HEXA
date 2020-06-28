import Vue from 'vue'
import VueRouter from 'vue-router'

import Hello from './views/Hello'
import Home from './views/Home'
import Auth from './views/Auth'
import Profile from './views/Profile'
import Users from './views/Users'
import Calculations from './views/Calculations'

Vue.use(VueRouter)

function checkAuth (to, from, next) {
    // check if route is protected
    if (to.meta.protected) {
      var token = localStorage.getItem("kxtoken")
      if (token && token !== null && token !== '' ) {
        next() // allow to enter route
      } else {
        next('/auth') // go to '/auth';
      }
    } else {
      next()
    }
}

function checkGuess (to, from, next) {
    // check if route is protected
    var token = localStorage.getItem("kxtoken")
    if (token && token !== null && token !== '' ) {
    next('/')// allow to enter route
    } else {
    next() // go to '/auth';
    }
  
}

export default new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home,
            beforeEnter: checkAuth,
            meta: { protected: true }
        },
        {
            path: '/auth',
            name: 'auth',
            component: Auth,
            beforeEnter: checkGuess,
            meta: { protected: false }
        },
        {
            path: '/profile',
            name: 'profile',
            component: Profile,
            beforeEnter: checkAuth,
            meta: { protected: true }
        },
        {
            path: '/hello',
            name: 'hello',
            component: Hello,
            beforeEnter: checkAuth,
            meta: { protected: true }
        },
        {
          path: '/users',
          name: 'users',
          component: Users,
          beforeEnter: checkAuth,
          meta: { protected: true }
      },
      {
        path: '/calculations',
        name: 'calculations',
        component: Calculations,
        beforeEnter: checkAuth,
        meta: { protected: true }
    },
    ],
});