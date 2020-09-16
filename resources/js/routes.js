import Vue from 'vue'
import VueRouter from 'vue-router'

import Auth from './views/public/Auth'
import Confirmation from './views/public/Confirmation'

import Logout from './views/Logout'
import Profile from './views/Profile'
import Dashboard from './views/Dashboard'
import Users from './views/Users'

import ItemMain from './views/client/master-data/item/item-main'

import SupplierMain from './views/client/master-data/supplier/supplier-main'

import CustomerMain from './views/client/master-data/customer/customer-main'

import EmployeeMain from './views/client/master-data/employee/employee-main'

import CompanyMain from './views/client/master-data/company/company-main'

import AddressList from './views/admin/globals/address-list'
import CustomerChain from './views/admin/globals/customer-chain'
import CustomerChannel from './views/admin/globals/customer-channel'
import CustomerType from './views/admin/globals/customer-type'

import GlobalUom from './views/admin/globals/global-uom'


import CompanyList from './views/admin/companies/list'
import CompanyForm from './views/admin/companies/form'

import AdminCoaReportGroup from './views/admin/admin-globals/admin-coa-report-group'
import AdminCoaAccountGroup from './views/admin/admin-globals/admin-coa-account-group'
import AdminChartofAccounts from './views/admin/admin-globals/admin-chart-of-accounts'

import AdminCostCenter from './views/admin/admin-globals/admin-cost-center'

import PurchaseOrder from './views/client/buy-and-pay/purchase-order/main-purchase-order'
import PurchaseOrderDetails from './views/client/buy-and-pay/purchase-order/purchase-order-details'

import PriceRuleMain from './views/client/inventory/price-rule/price-rule-main'



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
            path: '/auth',
            name: 'auth',
            component: Auth,
            beforeEnter: checkGuess,
            meta: { protected: false }
        },
        {
            path: '/confirmation',
            name: 'confirmation',
            component: Confirmation,
            meta: { protected: false }
        },
        {
            path: '/',
            name: 'dashboard',
            component: Dashboard,
            beforeEnter: checkAuth,
            meta: { protected: true }
        },
        {
            path: '/logout',
            name: 'logout',
            component: Logout,
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
          path: '/companies',
          name: 'company-list',
          component: CompanyList,
          beforeEnter: checkAuth,
          meta: { protected: true }
        },
        {
          path: '/companies/create',
          name: 'company-create',
          component: CompanyForm,
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
        {
          path: '/global-uom',
          name: 'global-uom',
          component: GlobalUom,
          beforeEnter: checkAuth,
          meta: { protected: true }
        },
        {
          path: '/main-purchase-order',
          name: 'main-purchase-order',
          component: PurchaseOrder,
          beforeEnter: checkAuth,
          meta: { protected: true }
        },
        {
          path: '/purchase-order/:order_uuid',
          name: 'purchase-order-details',
          component: PurchaseOrderDetails,
          beforeEnter: checkAuth,
          meta: { protected: true }
        },
        {
          path: '/price-rule-main',
          name: 'price-rule-main',
          component: PriceRuleMain,
          beforeEnter: checkAuth,
          meta: { protected: true }
        },

    ],
});