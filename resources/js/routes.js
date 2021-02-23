import Vue from 'vue'
import VueRouter from 'vue-router'

import Auth from './views/public/Auth'
import Confirmation from './views/public/Confirmation'

import Logout from './views/Logout'
import Profile from './views/Profile'
import Dashboard from './views/Dashboard'
import Users from './views/Users'

import ItemMain from './views/client/master-data/item/main'
import ItemForm from './views/client/master-data/item/form'

import SupplierMain from './views/client/master-data/supplier/main'
import SupplierForm from './views/client/master-data/supplier/form'

import CustomerMain from './views/client/master-data/customer/main'
import CustomerForm from './views/client/master-data/customer/form'

import ProjectMain from './views/client/master-data/project/main'
import ProjectForm from './views/client/master-data/project/form'

import EmployeeMain from './views/client/master-data/employee/main'
import EmployeeForm from './views/client/master-data/employee/form'

import CompanyMain from './views/client/master-data/company/main'


import GlobalsMain from './views/admin/globals/main'


import CompanyList from './views/admin/settings/company-list'
import CompanyForm from './views/admin/settings/company-form'


import AdminMain from './views/admin/settings/main'

import BuyANDPayOrders from './views/client/buy-and-pay/orders/main'
import BuyANDPayOrdersForm from './views/client/buy-and-pay/orders/form'
import BuyANDPayOrdersDetails from './views/client/buy-and-pay/orders/details'

import BuyANDPayReceipts from './views/client/buy-and-pay/receipts/main'
import BuyANDPayReceiptsDetails from './views/client/buy-and-pay/receipts/details'

import BuyANDPayBillingReturnMain from './views/client/buy-and-pay/billing-and-return/main'
import BuyANDPayBillingReturnDetails from './views/client/buy-and-pay/billing-and-return/billing/details'

import BuyANDPayPayments from './views/client/buy-and-pay/payments/main'
import BuyANDPayPaymentsForm from './views/client/buy-and-pay/payments/form'

import SalesOrderMain from './views/client/sell-and-collect/orders/main'
import InvoiceANDReversalMain from './views/client/sell-and-collect/invoicing-and-reversal/main'



import PriceRuleMain from './views/client/inventory/price-rule/main'
import PriceRuleForm from './views/client/inventory/price-rule/price-rule-form'



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
          path: '/item-main',
          name: 'item-main',
          component: ItemMain,
          beforeEnter: checkAuth,
          meta: { protected: true }
        },
        {
          path: '/items/:itemUUID',
          name: 'item-form',
          component: ItemForm,
          beforeEnter: checkAuth,
          props: { view_mode: false },
          meta: { protected: true }
        },
        {
          path: '/items/:itemUUID/view',
          name: 'item-form',
          component: ItemForm,
          beforeEnter: checkAuth,
          props: { view_mode: true },
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
          path: '/suppliers/:supplierUUID',
          name: 'supplier-form',
          component: SupplierForm,
          beforeEnter: checkAuth,
          meta: { protected: true }
        },
        {
          path: '/suppliers/:supplierUUID/view',
          name: 'supplier-form',
          component: SupplierForm,
          beforeEnter: checkAuth,
          props: { view_mode: true },
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
          path: '/customers/:customerUUID',
          name: 'customer-form',
          component: CustomerForm,
          beforeEnter: checkAuth,
          meta: { protected: true }
        },
        {
          path: '/customers/:customerUUID/view',
          name: 'customer-form',
          component: CustomerForm,
          beforeEnter: checkAuth,
          props: { view_mode: true },
          meta: { protected: true }
        },
        {
          path: '/project-main',
          name: 'project-main',
          component: ProjectMain,
          beforeEnter: checkAuth,
          meta: { protected: true }
        },
        {
          path: '/projects/:projectUUID',
          name: 'project-form',
          component: ProjectForm,
          beforeEnter: checkAuth,
          meta: { protected: true }
        },
        {
          path: '/projects/:projectUUID/view',
          name: 'project-form',
          component: ProjectForm,
          beforeEnter: checkAuth,
          props: { view_mode: true },
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
          path: '/employees/:employeeUUID',
          name: 'employee-form',
          component: EmployeeForm,
          beforeEnter: checkAuth,
          meta: { protected: true }
        },
        {
          path: '/employees/:employeeUUID/view',
          name: 'employee-form',
          component: EmployeeForm,
          beforeEnter: checkAuth,
          props: { view_mode: true },
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
          path: '/globals-main',
          name: 'globals-main',
          component: GlobalsMain,
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
          path: '/admin-main',
          name: 'admin-main',
          component: AdminMain,
          beforeEnter: checkAuth,
          meta: { protected: true }
        },

        {
            path: '/buy-and-pay/orders',
            name: 'buy-and-pay-orders',
            component: BuyANDPayOrders,
            beforeEnter: checkAuth,
            meta: { protected: true }
        },
        {
          path: '/buy-and-pay/orders/create',
          name: 'buy-and-pay-orders-create',
          component: BuyANDPayOrdersForm,
          beforeEnter: checkAuth,
          meta: { protected: true }
        },
        {
          path: '/buy-and-pay/orders/:order_uuid/:action',
          name: 'purchase-order-details',
          component: BuyANDPayOrdersDetails,
          props: { view_mode: false },
          beforeEnter: checkAuth,
          meta: { protected: true }
        },

        {
            path: '/buy-and-pay/receipts',
            name: 'buy-and-pay-receipts',
            component: BuyANDPayReceipts,
            beforeEnter: checkAuth,
            meta: { protected: true }
        },
        {
          path: '/buy-and-pay/receipts/:order_uuid/:action',
          name: 'buy-and-pay-receipts-details',
          component: BuyANDPayReceiptsDetails,
          props: { view_mode: false },
          beforeEnter: checkAuth,
          meta: { protected: true }
        },

        {
            path: '/buy-and-pay/bills',
            name: 'buy-and-pay-bills',
            component: BuyANDPayBillingReturnMain,
            beforeEnter: checkAuth,
            meta: { protected: true }
        },
        {
          path: '/buy-and-pay/bills/create',
          name: 'buy-and-pay-bills-create',
          component: BuyANDPayBillingReturnDetails,
          props: { view_mode: false },
          beforeEnter: checkAuth,
          meta: { protected: true }
        },
        {
          path: '/buy-and-pay/bills/:bill_uuid/:action',
          name: 'buy-and-pay-bills-details',
          component: BuyANDPayBillingReturnDetails,
          props: { view_mode: false },
          beforeEnter: checkAuth,
          meta: { protected: true }
        },
        {
            path: '/buy-and-pay/payments',
            name: 'buy-and-pay-payments',
            component: BuyANDPayPayments,
            beforeEnter: checkAuth,
            meta: { protected: true }
        },
        {
            path: '/buy-and-pay/payments/create',
            name: 'buy-and-pay-payment-create',
            component: BuyANDPayPaymentsForm,
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
        {
            path: '/price-rule/:priceRuleUUID',
            name: 'price-rule-form',
            component: PriceRuleForm,
            beforeEnter: checkAuth,
            meta: { protected: true }
        },

        {
          path: '/sell-and-collect/orders',
          name: 'sales-order-main',
          component: SalesOrderMain,
          beforeEnter: checkAuth,
          meta: { protected: true }
        },
        {
          path: '/sell-and-collect/invoicing-reversal',
          name: 'invoicing-and-reversal-main',
          component: InvoiceANDReversalMain,
          beforeEnter: checkAuth,
          meta: { protected: true }
        },
    ],
});