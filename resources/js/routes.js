import Vue from 'vue'
import VueRouter from 'vue-router'

import Auth from './views/Auth'
import Register from './views/Register'
import Profile from './views/Profile'
import Dashboard from './views/Dashboard'
import Users from './views/Users'

import ItemMain from './views/client/item/item-main'

import SupplierMain from './views/client/supplier/supplier-main'

import CustomerMain from './views/client/customer/customer-main'

import EmployeeMain from './views/client/employee/employee-main'

import CompanyMain from './views/client/company/company-main'

import AddressList from './views/admin/globals/address-list'
import CustomerChain from './views/admin/globals/customer-chain'
import CustomerChannel from './views/admin/globals/customer-channel'
import CustomerType from './views/admin/globals/customer-type'

import CompanyList from './views/admin/company-list'

import AdminCoaReportGroup from './views/admin/admin-globals/admin-coa-report-group'
import AdminCoaAccountGroup from './views/admin/admin-globals/admin-coa-account-group'
import AdminChartofAccounts from './views/admin/admin-globals/admin-chart-of-accounts'

import AdminCostCenter from './views/admin/admin-globals/admin-cost-center'



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
            name: 'dashboard',
            component: Dashboard,
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
          path: '/address-list',
          name: 'address-list',
          component: AddressList,
          beforeEnter: checkAuth,
          meta: { protected: true }
        },
        {
          path: '/item-main',
          name: 'item-main',
          component: ItemMain,
          beforeEnter: checkAuth,
          meta: { protected: true }
        },
        {
          path: '/supplier-main',
          name: 'supplier-main',
          component: SupplierMain,
          beforeEnter: checkAuth,
          meta: { protected: true }
        },
        {
          path: '/customer-main',
          name: 'customer-main',
          component: CustomerMain,
          beforeEnter: checkAuth,
          meta: { protected: true }
        },
        {
          path: '/employee-main',
          name: 'employee-main',
          component: EmployeeMain,
          beforeEnter: checkAuth,
          meta: { protected: true }
        },
        {
          path: '/company-main',
          name: 'company-main',
          component: CompanyMain,
          beforeEnter: checkAuth,
          meta: { protected: true }
        },
        {
          path: '/customer-chain',
          name: 'customer-chain',
          component: CustomerChain,
          beforeEnter: checkAuth,
          meta: { protected: true }
        },
        {
          path: '/customer-channel',
          name: 'customer-channel',
          component: CustomerChannel,
          beforeEnter: checkAuth,
          meta: { protected: true }
        },
        {
          path: '/customer-type',
          name: 'customer-type',
          component: CustomerType,
          beforeEnter: checkAuth,
          meta: { protected: true }
        },
        {
          path: '/company-list',
          name: 'company-list',
          component: CompanyList,
          beforeEnter: checkAuth,
          meta: { protected: true }
        },
        {
          path: '/admin-coa-report-group',
          name: 'admin-coa-report-group',
          component: AdminCoaReportGroup,
          beforeEnter: checkAuth,
          meta: { protected: true }
        },
        {
          path: '/admin-coa-account-group',
          name: 'admin-coa-account-group',
          component: AdminCoaAccountGroup,
          beforeEnter: checkAuth,
          meta: { protected: true }
        },
        {
          path: '/admin-chart-of-accounts',
          name: 'admin-chart-of-accounts',
          component: AdminChartofAccounts,
          beforeEnter: checkAuth,
          meta: { protected: true }
        },
        {
          path: '/admin-cost-center',
          name: 'admin-cost-center',
          component: AdminCostCenter,
          beforeEnter: checkAuth,
          meta: { protected: true }
        },

    ],
});