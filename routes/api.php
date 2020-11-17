<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//Route::post('auth', 'API\UserController@login');
Route::post('/register', 'API\AuthController@register');
Route::post('/login', 'API\AuthController@login');
Route::post('/confirmation', 'API\AuthController@confirmation');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:api'] ], function(){
    Route::get('/auth/check','API\AuthController@check');
    Route::get('/auth/revoke','API\AuthController@revoke');

    Route::get('/users','API\UserController@index');
    Route::post('/users','API\UserController@store');
    Route::put('/users','API\UserController@update');


    Route::group(['prefix' => 'items'], function(){

        Route::get('/item-list', 'API\ItemListController@getItemList');
        Route::post('/item-list', 'API\ItemListController@store');
        Route::put('/item-list', 'API\ItemListController@update');
        Route::get('/item-list/{item_uuid}','API\ItemListController@show');

        Route::delete('/item-list/{itemUUID}', 'API\ItemListController@delete');
        Route::get('/{itemUUID}/uoms', 'API\ItemListController@uoms');

        Route::get('/item-group', 'API\ItemGroupController@getItemGroup');
        Route::post('/item-group', 'API\ItemGroupController@save');
        Route::post('/item-group/delete', 'API\ItemGroupController@delete');

        Route::get('/item-asset-group', 'API\ItemAssetGroupController@getItemAssetGroup');
        Route::post('/item-asset-group', 'API\ItemAssetGroupController@save');
        Route::post('/item-asset-group/delete', 'API\ItemAssetGroupController@delete');

        
        Route::post('/item-supplier-discounts', 'API\ItemSupplierDiscountController@save');

        Route::delete('/item-supplier-discounts', 'API\ItemSupplierDiscountController@delete');
        Route::delete('/item-supplier-discounts-batch', 'API\ItemSupplierDiscountController@deleteBatch');


        Route::get('/cat-brand', 'API\ItemCatBrandController@getCatBrand');
        Route::post('/cat-brand', 'API\ItemCatBrandController@save');
        Route::post('/cat-brand/delete', 'API\ItemCatBrandController@delete');

        Route::get('/cat-category', 'API\ItemCatCategoryController@getCatCategory');
        Route::post('/cat-category', 'API\ItemCatCategoryController@save');
        Route::post('/cat-category/delete', 'API\ItemCatCategoryController@delete');

        Route::get('/cat-department', 'API\ItemCatDepartmentController@getCatDepartment');
        Route::post('/cat-department', 'API\ItemCatDepartmentController@save');
        Route::post('/cat-department/delete', 'API\ItemCatDepartmentController@delete');

        Route::get('/cat-form', 'API\ItemCatFormController@getCatForm');
        Route::post('/cat-form', 'API\ItemCatFormController@save');
        Route::post('/cat-form/delete', 'API\ItemCatFormController@delete');

        Route::get('/cat-item-type', 'API\ItemCatItemTypeController@getCatItemType');
        Route::post('/cat-item-type', 'API\ItemCatItemTypeController@save');
        Route::post('/cat-item-type/delete', 'API\ItemCatItemTypeController@delete');

        Route::get('/cat-manufacturer', 'API\ItemCatManufacturerController@getCatManufacturer');
        Route::post('/cat-manufacturer', 'API\ItemCatManufacturerController@save');
        Route::post('/cat-manufacturer/delete', 'API\ItemCatManufacturerController@delete');

        Route::get('/cat-packing-type', 'API\ItemCatPackingTypeController@getCatPackingType');
        Route::post('/cat-packing-type', 'API\ItemCatPackingTypeController@save');
        Route::post('/cat-packing-type/delete', 'API\ItemCatPackingTypeController@delete');

        Route::get('/cat-section', 'API\ItemCatSectionController@getCatSection');
        Route::post('/cat-section', 'API\ItemCatSectionController@save');
        Route::post('/cat-section/delete', 'API\ItemCatSectionController@delete');

        Route::get('/cat-sizes', 'API\ItemCatSizesController@getCatSizes');
        Route::post('/cat-sizes', 'API\ItemCatSizesController@save');
        Route::post('/cat-sizes/delete', 'API\ItemCatSizesController@delete');

    });

    Route::group(['prefix' => 'suppliers'], function(){

        Route::get('/supplier-list', 'API\SupplierListController@getSupplierList');
        Route::post('/supplier-list', 'API\SupplierListController@store');
        Route::put('/supplier-list', 'API\SupplierListController@update');
        Route::get('/supplier-list/{supplier_uuid}','API\SupplierListController@show');

        Route::post('/supplier-list/delete', 'API\SupplierListController@delete');
        Route::get('/supplier-list/{supplier_uuid}/items','API\SupplierListController@getSupplierItems');
      
        Route::get('/supplier-group', 'API\SupplierGroupController@getSupplierGroup');
        Route::post('/supplier-group', 'API\SupplierGroupController@save');
        Route::post('/supplier-group/delete', 'API\SupplierGroupController@delete');

        Route::get('/multiple/supplier-base-discount-group', 'API\SupplierBaseDiscountGroupController@getSupplierBaseDiscountGroupsMultiple');
        Route::get('/{supplierUUID}/supplier-base-discount-group', 'API\SupplierBaseDiscountGroupController@getSupplierBaseDiscountGroups');
        
        Route::post('/{supplierUUID}/supplier-base-discount-group', 'API\SupplierBaseDiscountGroupController@save');

        Route::get('/{supplierDiscountUUID}/supplier-base-discount-group-details', 'API\SupplierBaseDiscountGroupDetailController@getSupplierBaseDiscountGroupDetails');
        Route::post('/{supplierDiscountUUID}/supplier-base-discount-group-details', 'API\SupplierBaseDiscountGroupDetailController@save');


        Route::get('/{supplierUUID}/check-payee', 'API\SupplierCheckPayeeController@getCheckPayee');
        Route::post('/{supplierUUID}/check-payee', 'API\SupplierCheckPayeeController@save');
    
    });

    Route::group(['prefix' => 'customers'], function(){

        Route::get('/customer-list', 'API\CustomerListController@getCustomerList');
        Route::post('/customer-list', 'API\CustomerListController@store');
        Route::put('/customer-list', 'API\CustomerListController@update');
        Route::get('/customer-list/{customer_uuid}','API\CustomerListController@show');

        Route::post('/customer-list/delete', 'API\CustomerListController@delete');

        Route::get('/customer-group', 'API\CustomerGroupController@getCustomerGroup');
        Route::post('/customer-group', 'API\CustomerGroupController@save');
        Route::post('/customer-group/delete', 'API\CustomerGroupController@delete');

        Route::post('/customer-discount-regular', 'API\CustomerDiscountRegularController@save');
        Route::post('/customer-discount-regular/delete', 'API\CustomerDiscountRegularController@delete');

    });

    Route::group(['prefix' => 'employees'], function(){

        Route::get('/employee-list', 'API\EmployeeListController@getEmployeeList');
        Route::post('/employee-list', 'API\EmployeeListController@store');
        Route::post('/employee-list/update', 'API\EmployeeListController@update');
        Route::get('/employee-list/{employee_uuid}','API\EmployeeListController@show');

        Route::post('/employee-list/delete', 'API\EmployeeListController@delete');

        Route::get('/employment-type', 'API\EmployeeEmploymentTypeController@getEmploymentType');
        Route::post('/employment-type', 'API\EmployeeEmploymentTypeController@save');
        Route::post('/employment-type/delete', 'API\EmployeeEmploymentTypeController@delete');

        Route::get('/employment-status', 'API\EmployeeEmploymentStatusController@getEmploymentStatus');
        Route::post('/employment-status', 'API\EmployeeEmploymentStatusController@save');
        Route::post('/employment-status/delete', 'API\EmployeeEmploymentStatusController@delete');

        Route::get('/supervisors-list', 'API\EmployeeListController@getSupervisors');

    });

    Route::group(['prefix' => 'company'], function(){

        Route::get('/details', 'API\CompanyDetailsController@getCompanyDetails');

        Route::get('/department', 'API\CompanyDepartmentController@getDepartment');
        Route::post('/department', 'API\CompanyDepartmentController@save');
        Route::post('/department/delete', 'API\CompanyDepartmentController@delete');

        Route::get('/branch', 'API\CompanyBranchController@getBranch');
        Route::post('/branch', 'API\CompanyBranchController@save');
        Route::post('/branch/delete', 'API\CompanyBranchController@delete');

        Route::get('/branch-location', 'API\CompanyBranchLocationController@getBranchLocation');
        Route::post('/branch-location', 'API\CompanyBranchLocationController@save');
        Route::post('/branch-location/delete', 'API\CompanyBranchLocationController@delete');

        Route::get('/payment-term', 'API\CompanyPaymentTermController@getPaymentTerm');
        Route::post('/payment-term', 'API\CompanyPaymentTermController@save');
        Route::post('/payment-term/delete', 'API\CompanyPaymentTermController@delete');

        Route::get('/taxation', 'API\CompanyTaxationController@getTaxation');
        Route::post('/taxation', 'API\CompanyTaxationController@save');
        Route::post('/taxation/delete', 'API\CompanyTaxationController@delete');

        Route::get('/taxation-vat', 'API\CompanyTaxationController@getVAT');
        Route::get('/taxation-ewt', 'API\CompanyTaxationController@getEWT');
        Route::get('/taxation-wt', 'API\CompanyTaxationController@getWT');

        Route::get('/chart-of-accounts', 'API\CompanyChartOfAccountController@getChartOfAccounts');
        Route::post('/chart-of-accounts', 'API\CompanyChartOfAccountController@save');
        Route::post('/chart-of-accounts/delete', 'API\CompanyChartOfAccountController@delete');

        Route::get('/chart-of-accounts-payables', 'API\CompanyChartOfAccountController@getPayables');
        Route::get('/chart-of-accounts-income', 'API\CompanyChartOfAccountController@getIncomeAccount');
        Route::get('/chart-of-accounts-cost-of-sales', 'API\CompanyChartOfAccountController@getCostOfSales');
        Route::get('/chart-of-accounts-recievables', 'API\CompanyChartOfAccountController@getRecievables');

        Route::get('/coa-report-group', 'API\CompanyCOAReportGroupController@getReportGroup');
        Route::post('/coa-report-group', 'API\CompanyCOAReportGroupController@save');
        Route::post('/coa-report-group/delete', 'API\CompanyCOAReportGroupController@delete');

        Route::get('/coa-account-group', 'API\CompanyCOAAccountGroupController@getAccountGroup');
        Route::post('/coa-account-group', 'API\CompanyCOAAccountGroupController@save');
        Route::post('/coa-account-group/delete', 'API\CompanyCOAAccountGroupController@delete');

        Route::get('/account-period', 'API\CompanyAccountingPeriodController@getAccountingPeriod');
        Route::post('/account-period', 'API\CompanyAccountingPeriodController@save');

    });

    Route::group(['prefix' => 'globals'], function(){
        Route::get('/address-list', 'API\GlobalAddressListController@getAddressList');
        Route::post('/address-list', 'API\GlobalAddressListController@save');
        Route::post('/address-list/delete', 'API\GlobalAddressListController@delete');

        Route::get('/customer-chain', 'API\GlobalCustomerChainController@getCustomerChains');
        Route::post('/customer-chain', 'API\GlobalCustomerChainController@save');
        Route::post('/customer-chain/delete', 'API\GlobalCustomerChainController@delete');

        Route::get('/cost-center', 'API\GlobalCostCenterController@getCostCenter');
        Route::post('/cost-center', 'API\GlobalCostCenterController@save');
        Route::post('/cost-center/delete', 'API\GlobalCostCenterController@delete');

        Route::get('/customer-channel', 'API\GlobalCustomerChannelController@getCustomerChannels');
        Route::post('/customer-channel', 'API\GlobalCustomerChannelController@save');
        Route::post('/customer-channel/delete', 'API\GlobalCustomerChannelController@delete');

        Route::get('/customer-type', 'API\GlobalCustomerTypeController@getCustomerTypes');
        Route::post('/customer-type', 'API\GlobalCustomerTypeController@save');
        Route::post('/customer-type/delete', 'API\GlobalCustomerTypeController@delete');

        Route::get('/uom', 'API\GlobalUomController@getUoms');
        Route::post('/uom', 'API\GlobalUomController@save');
        Route::post('/uom/delete', 'API\GlobalUomController@delete');


        Route::get('/base-uom', 'API\GlobalUomController@getBaseUom');
        Route::get('/packing-uom', 'API\GlobalUomController@getPackingUom');
    });

    Route::group(['prefix' => 'admin'], function(){
        Route::get('/company-list', 'API\CompanyListController@getCompanyList');
        Route::post('/company-list', 'API\CompanyListController@save');
        Route::post('/company-list/delete', 'API\CompanyListController@delete');

        Route::get('/coa-report-group', 'API\AdminCOAReportGroupController@getReportGroup');
        Route::post('/coa-report-group', 'API\AdminCOAReportGroupController@save');
        Route::post('/coa-report-group/delete', 'API\AdminCOAReportGroupController@delete');

        Route::get('/coa-account-group', 'API\AdminCOAAccountGroupController@getAccountGroup');
        Route::post('/coa-account-group', 'API\AdminCOAAccountGroupController@save');
        Route::post('/coa-account-group/delete', 'API\AdminCOAAccountGroupController@delete');

        Route::get('/chart-of-accounts', 'API\AdminChartOfAccountController@getAccounts');
        Route::post('/chart-of-accounts', 'API\AdminChartOfAccountController@save');
        Route::post('/chart-of-accounts/delete', 'API\AdminChartOfAccountController@delete');

        Route::get('/cost-center', 'API\AdminCostCenterController@getCostCenter');
        Route::post('/cost-center', 'API\AdminCostCenterController@save');
        Route::post('/cost-center/delete', 'API\AdminCostCenterController@delete');

    });

    Route::group(['prefix' => 'buy-and-pay'], function(){
        
        Route::get('/orders', 'API\PurchaseOrderController@getOrders');
        Route::get('/orders/{order_uuid}', 'API\PurchaseOrderController@getOrderDetails');
        Route::get('/orders/{order_uuid}/supplier-items', 'API\PurchaseOrderController@getOrderSupplierItems');
        Route::get('/orders/{order_uuid}/suppliers/{supplier_uuid}/discounts', 'API\PurchaseOrderController@getSupplierDiscounts');

        Route::post('/order/reason-code', 'API\PurchaseOrderController@updateOrderReasonCode');
        Route::post('/order', 'API\PurchaseOrderController@saveOrder');
        Route::post('/order/delete', 'API\PurchaseOrderController@deleteOrder');

        Route::post('/order/{order_uuid}/cancel', 'API\PurchaseOrderController@cancelOrder');

        Route::post('/orders/{order_uuid}/details', 'API\PurchaseOrderDetailController@save');


        Route::get('/order-reason-code', 'API\PurchaseOrderReasonCodeController@getReasonCode');
        Route::post('/order-reason-code', 'API\PurchaseOrderReasonCodeController@saveReasonCode');
        Route::post('/order-reason-code/delete', 'API\PurchaseOrderReasonCodeController@deleteReasonCode');

        Route::get('/received', 'API\PurchaseReceiveController@getReceived');
        Route::get('/to-received', 'API\PurchaseReceiveController@getToReceive');

        Route::get('/billed', 'API\PurchaseBillingController@getBilled');
        Route::get('/to-bill', 'API\PurchaseBillingController@getToBill');
        Route::post('/billing/{order_uuid}/details', 'API\PurchaseBillingController@save');
        

        Route::post('/receiving/{order_uuid}/details', 'API\PurchaseReceiveDetailController@save');

        Route::get('/receiving/{order_uuid}', 'API\PurchaseReceiveDetailController@getOrderDetails');
        Route::get('/receiving/{order_uuid}/supplier-items', 'API\PurchaseReceiveDetailController@getOrderSupplierItems');

    });

    Route::group(['prefix' => 'users'], function(){
        Route::get('/get-branch', 'API\UserController@getBranch');
        Route::get('/get-branch-locations', 'API\UserController@getBranchLocations');
    });


    Route::group(['prefix' => 'inventory'], function(){


    });

    Route::group(['prefix' => 'price-rule'], function(){
        Route::get('/supplier', 'API\PriceRuleSupplierController@getPriceRuleSuppliers');
        Route::get('/supplier/{uuid}', 'API\PriceRuleSupplierController@getPriceRuleSupplierDetails');
        Route::post('/supplier', 'API\PriceRuleSupplierController@save');
        Route::post('/supplier/delete', 'API\PriceRuleSupplierController@delete');
        
        Route::get('/supplier/{uuid}/details', 'API\PriceRuleSupplierDetailController@index');
        Route::post('/supplier/{uuid}/details', 'API\PriceRuleSupplierDetailController@save');
        Route::delete('/supplier/{uuid}/details/{price_rule_supplier_detail_uuid}', 'API\PriceRuleSupplierDetailController@delete');

        Route::post('/supplier/details/{price_rule_supplier_detail_uuid}/items', 'API\PriceRuleSupplierItemController@save');
        Route::delete('/supplier/details/{price_rule_supplier_item_uuid}/items/{item_uuid}', 'API\PriceRuleSupplierItemController@delete');
        

        Route::get('/customer', 'API\PriceRuleCustomerController@getPriceRuleCustomer');
        Route::post('/customer', 'API\PriceRuleCustomerController@save');
        Route::post('/customer/delete', 'API\PriceRuleCustomerController@delete');
    });


    Route::get('/menus', 'API\MenuController@index');

});
