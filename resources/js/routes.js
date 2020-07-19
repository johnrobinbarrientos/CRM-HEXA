import Vue from 'vue'
import VueRouter from 'vue-router'

import Home from './views/Home'
import Auth from './views/Auth'
import Register from './views/Register'
import Profile from './views/Profile'
import Users from './views/Users'
import Companies from './views/Companies'
import Locations from './views/locations/Locations'
import Supplier from './views/supplier/supplier-details'

Vue.use(VueRouter)

function checkAuth (to, from, next) {
    // check if route is protected
    if (to.meta.protected) {
      var token = localStorage.getItem(window.TOKEN_KEY)
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
    var token = localStorage.getItem(window.TOKEN_KEY)
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
            path: '/register',
            name: 'register',
            component: Register,
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
          path: '/users',
          name: 'users',
          component: Users,
          beforeEnter: checkAuth,
          meta: { protected: true }
        },
        {
          path: '/companies',
          name: 'companies',
          component: Companies,
          beforeEnter: checkAuth,
          meta: { protected: true }
        },
        {
          path: '/locations',
          name: 'locations',
          component: Locations,
          beforeEnter: checkAuth,
          meta: { protected: true }
        },
        {
          path: '/supplier',
          name: 'supplier',
          component: Supplier,
          beforeEnter: checkAuth,
          meta: { protected: true }
        },
    ],
});