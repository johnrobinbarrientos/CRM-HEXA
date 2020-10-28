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

import EmployeeMain from './views/client/master-data/employee/main'
import EmployeeForm from './views/client/master-data/employee/form'

import CompanyMain from './views/client/master-data/company/main'

import GlobalAddressList from './views/admin/globals/address-list'
import GlobalCustomerChain from './views/admin/globals/customer-chain'
import GlobalCustomerChannel from './views/admin/globals/customer-channel'
import GlobalCustomerType from './views/admin/globals/customer-type'
import GlobalCostCenter from './views/admin/globals/cost-center'

import GlobalUom from './views/admin/globals/global-uom'


import CompanyList from './views/admin/settings/company-list'
import CompanyForm from './views/admin/settings/company-form'

import AdminCoaReportGroup from './views/admin/settings/admin-coa-report-group'
import AdminCoaAccountGroup from './views/admin/settings/admin-coa-account-group'
import AdminChartofAccounts from './views/admin/settings/admin-chart-of-accounts'
import AdminCostCenter from './views/admin/settings/admin-cost-center'

import PurchaseOrderMain from './views/client/buy-and-pay/purchase-order/purchase-order-main'
import PurchaseOrderList from './views/client/buy-and-pay/purchase-order/purchase-order-list'
import PurchaseOrderCreate from './views/client/buy-and-pay/purchase-order/purchase-order-create'
import PurchaseOrderDetails from './views/client/buy-and-pay/purchase-order/purchase-order-details'

import PurchaseReceiptMain from './views/client/buy-and-pay/purchase-receipt/main'

import PriceRuleMain from './views/client/inventory/price-rule/price-rule-main'
import PriceRuleSupplierForm from './views/client/inventory/price-rule/price-rule-supplier-form'



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
          path: '/global-address-list',
          name: 'global-address-list',
          component: GlobalAddressList,
          beforeEnter: checkAuth,
          meta: { protected: true }
        },
        {
          path: '/global-customer-chain',
          name: 'global-customer-chain',
          component: GlobalCustomerChain,
          beforeEnter: checkAuth,
          meta: { protected: true }
        },
        {
          path: '/global-customer-channel',
          name: 'global-customer-channel',
          component: GlobalCustomerChannel,
          beforeEnter: checkAuth,
          meta: { protected: true }
        },
        {
          path: '/global-customer-type',
          name: 'global-customer-type',
          component: GlobalCustomerType,
          beforeEnter: checkAuth,
          meta: { protected: true }
        },
        {
          path: '/global-cost-center',
          name: 'global-cost-center',
          component: GlobalCostCenter,
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
          path: '/purchase-order-main',
          name: 'purchase-order-main',
          component: PurchaseOrderMain,
          beforeEnter: checkAuth,
          meta: { protected: true }
        },
        {
          path: '/purchase-orders/create',
          name: 'purchase-order-create',
          component: PurchaseOrderCreate,
          beforeEnter: checkAuth,
          meta: { protected: true }
        },
        {
          path: '/purchase-orders/:order_uuid',
          name: 'purchase-order-details',
          component: PurchaseOrderDetails,
          props: { view_mode: false },
          beforeEnter: checkAuth,
          meta: { protected: true }
        },
        {
          path: '/purchase-orders/:order_uuid/view',
          name: 'purchase-order-details',
          component: PurchaseOrderDetails,
          props: { view_mode: true },
          beforeEnter: checkAuth,
          meta: { protected: true }
        },
        {
          path: '/purchase-receipt-main',
          name: 'purchase-receipt-main',
          component: PurchaseReceiptMain,
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
            path: '/price-rules/suppliers/create',
            name: 'price-rule-supplier-form',
            component: PriceRuleSupplierForm,
            beforeEnter: checkAuth,
            meta: { protected: true }
        },
        {
            path: '/price-rules/suppliers/:priceRuleSupplierUUID',
            name: 'price-rule-supplier-form',
            component: PriceRuleSupplierForm,
            beforeEnter: checkAuth,
            meta: { protected: true }
        },
    ],
});