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

        Route::delete('/{itemUUID}', 'API\ItemListController@delete');
        Route::get('/{itemUUID}/uoms', 'API\ItemListController@uoms');

        Route::get('/item-group', 'API\ItemGroupController@index');
        Route::post('/item-group', 'API\ItemGroupController@save');
        Route::post('/item-group/delete', 'API\ItemGroupController@delete');

        Route::get('/item-asset-group', 'API\ItemAssetGroupController@index');
        Route::post('/item-asset-group', 'API\ItemAssetGroupController@save');
        Route::post('/item-asset-group/delete', 'API\ItemAssetGroupController@delete');

        
        Route::get('/cat-brand', 'API\ItemCatBrandController@index');
        Route::post('/cat-brand', 'API\ItemCatBrandController@save');
        Route::post('/cat-brand/delete', 'API\ItemCatBrandController@delete');

        Route::get('/cat-category', 'API\ItemCatCategoryController@index');
        Route::post('/cat-category', 'API\ItemCatCategoryController@save');
        Route::post('/cat-category/delete', 'API\ItemCatCategoryController@delete');

        Route::get('/cat-department', 'API\ItemCatDepartmentController@index');
        Route::post('/cat-department', 'API\ItemCatDepartmentController@save');
        Route::post('/cat-department/delete', 'API\ItemCatDepartmentController@delete');

        Route::get('/cat-form', 'API\ItemCatFormController@index');
        Route::post('/cat-form', 'API\ItemCatFormController@save');
        Route::post('/cat-form/delete', 'API\ItemCatFormController@delete');

        Route::get('/cat-item-type', 'API\ItemCatItemTypeController@index');
        Route::post('/cat-item-type', 'API\ItemCatItemTypeController@save');
        Route::post('/cat-item-type/delete', 'API\ItemCatItemTypeController@delete');

        Route::get('/cat-manufacturer', 'API\ItemCatManufacturerController@index');
        Route::post('/cat-manufacturer', 'API\ItemCatManufacturerController@save');
        Route::post('/cat-manufacturer/delete', 'API\ItemCatManufacturerController@delete');

        Route::get('/cat-packing-type', 'API\ItemCatPackingTypeController@index');
        Route::post('/cat-packing-type', 'API\ItemCatPackingTypeController@save');
        Route::post('/cat-packing-type/delete', 'API\ItemCatPackingTypeController@delete');

        Route::get('/cat-section', 'API\ItemCatSectionController@index');
        Route::post('/cat-section', 'API\ItemCatSectionController@save');
        Route::post('/cat-section/delete', 'API\ItemCatSectionController@delete');

        Route::get('/cat-sizes', 'API\ItemCatSizesController@index');
        Route::post('/cat-sizes', 'API\ItemCatSizesController@save');
        Route::post('/cat-sizes/delete', 'API\ItemCatSizesController@delete');

        Route::get('/', 'API\ItemListController@index');
        Route::post('/', 'API\ItemListController@store');
        Route::put('/', 'API\ItemListController@update');
        Route::get('/{item_uuid}','API\ItemListController@show');

    });

    Route::group(['prefix' => 'suppliers'], function(){

        Route::post('/delete', 'API\SupplierListController@delete');
        Route::get('/{supplier_uuid}/items','API\SupplierListController@getSupplierItems');
      
        Route::get('/supplier-group', 'API\SupplierGroupController@index');
        Route::post('/supplier-group', 'API\SupplierGroupController@save');
        Route::post('/supplier-group/delete', 'API\SupplierGroupController@delete');

        Route::get('/multiple/supplier-base-discount-group', 'API\SupplierBaseDiscountGroupController@getSupplierBaseDiscountGroupsMultiple');
        Route::get('/{supplierUUID}/supplier-base-discount-group', 'API\SupplierBaseDiscountGroupController@getSupplierBaseDiscountGroups');
        
        Route::post('/{supplierUUID}/supplier-base-discount-group', 'API\SupplierBaseDiscountGroupController@save');

        Route::get('/{supplierDiscountUUID}/supplier-base-discount-group-details', 'API\SupplierBaseDiscountGroupDetailController@index');
        Route::post('/{supplierDiscountUUID}/supplier-base-discount-group-details', 'API\SupplierBaseDiscountGroupDetailController@save');

        Route::post('/item-supplier-discounts', 'API\SupplierBaseDiscountGroupItemController@save');

        Route::delete('/item-supplier-discounts', 'API\SupplierBaseDiscountGroupItemController@delete');
        Route::delete('/item-supplier-discounts-batch', 'API\SupplierBaseDiscountGroupItemController@deleteBatch');

        Route::get('/{supplierUUID}/check-payee', 'API\SupplierCheckPayeeController@index');
        Route::post('/{supplierUUID}/check-payee', 'API\SupplierCheckPayeeController@save');

        Route::get('/', 'API\SupplierListController@index');
        Route::post('/', 'API\SupplierListController@store');
        Route::put('/', 'API\SupplierListController@update');
        Route::get('/{supplier_uuid}','API\SupplierListController@show');
    
    });

    Route::group(['prefix' => 'customers'], function(){

        Route::post('/delete', 'API\CustomerListController@delete');

        Route::get('/customer-group', 'API\CustomerGroupController@index');
        Route::post('/customer-group', 'API\CustomerGroupController@save');
        Route::post('/customer-group/delete', 'API\CustomerGroupController@delete');

        Route::post('/customer-discount-regular', 'API\CustomerDiscountRegularController@save');
        Route::post('/customer-discount-regular/delete', 'API\CustomerDiscountRegularController@delete');

        Route::get('/', 'API\CustomerListController@index');
        Route::post('/create', 'API\CustomerListController@store');
        Route::put('/', 'API\CustomerListController@update');
        Route::get('/{customer_uuid}','API\CustomerListController@show');

    });

    Route::group(['prefix' => 'projects'], function(){

        Route::get('/', 'API\ProjectListController@index');
        Route::post('/', 'API\ProjectListController@store');
        Route::put('/', 'API\ProjectListController@update');
        Route::get('/{project_uuid}','API\ProjectListController@show');

    });

    Route::group(['prefix' => 'employees'], function(){

        Route::post('/delete', 'API\EmployeeListController@delete');

        Route::get('/employment-type', 'API\EmployeeEmploymentTypeController@index');
        Route::post('/employment-type', 'API\EmployeeEmploymentTypeController@save');
        Route::post('/employment-type/delete', 'API\EmployeeEmploymentTypeController@delete');

        Route::get('/employment-status', 'API\EmployeeEmploymentStatusController@index');
        Route::post('/employment-status', 'API\EmployeeEmploymentStatusController@save');
        Route::post('/employment-status/delete', 'API\EmployeeEmploymentStatusController@delete');

        Route::get('/supervisors-list', 'API\EmployeeListController@getSupervisors');

        Route::get('/', 'API\EmployeeListController@index');
        Route::post('/', 'API\EmployeeListController@store');
        Route::put('/update', 'API\EmployeeListController@update');
        Route::get('/{employee_uuid}','API\EmployeeListController@show');

    });

    Route::group(['prefix' => 'companies'], function(){
        Route::get('/branches', 'API\CompanyBranchController@getBranch');
        Route::post('/branches', 'API\CompanyBranchController@save');
        Route::delete('/branches', 'API\CompanyBranchController@delete');
    });

    Route::group(['prefix' => 'company'], function(){

        Route::get('/details', 'API\CompanyDetailsController@getCompanyDetails');

        Route::get('/department', 'API\CompanyDepartmentController@index');
        Route::post('/department', 'API\CompanyDepartmentController@save');
        Route::post('/department/delete', 'API\CompanyDepartmentController@delete');

        Route::get('/branch', 'API\CompanyBranchController@index');
        Route::post('/branch', 'API\CompanyBranchController@save');
        Route::post('/branch/delete', 'API\CompanyBranchController@delete');

        Route::get('/branch-location', 'API\CompanyBranchLocationController@index');
        Route::post('/branch-location', 'API\CompanyBranchLocationController@save');
        Route::post('/branch-location/delete', 'API\CompanyBranchLocationController@delete');

        Route::get('/payment-term', 'API\CompanyPaymentTermController@index');
        Route::post('/payment-term', 'API\CompanyPaymentTermController@save');
        Route::post('/payment-term/delete', 'API\CompanyPaymentTermController@delete');

        Route::get('/taxation', 'API\CompanyTaxationController@index');
        Route::post('/taxation', 'API\CompanyTaxationController@save');
        Route::post('/taxation/delete', 'API\CompanyTaxationController@delete');

        Route::get('/taxation/{uuid}', 'API\CompanyTaxationController@getDetails');

        Route::get('/taxation-vat', 'API\CompanyTaxationController@getVAT');
        Route::get('/taxation-ewt', 'API\CompanyTaxationController@getEWT');
        Route::get('/taxation-wt', 'API\CompanyTaxationController@getWT');

        Route::get('/chart-of-accounts', 'API\CompanyChartOfAccountController@index');
        Route::post('/chart-of-accounts', 'API\CompanyChartOfAccountController@save');
        Route::post('/chart-of-accounts/delete', 'API\CompanyChartOfAccountController@delete');

        Route::get('/chart-of-accounts-payables', 'API\CompanyChartOfAccountController@getPayables');
        Route::get('/chart-of-accounts-income', 'API\CompanyChartOfAccountController@getIncomeAccounts');
        Route::get('/chart-of-accounts-cost-of-sales', 'API\CompanyChartOfAccountController@getCostOfSales');
        Route::get('/chart-of-accounts-recievables', 'API\CompanyChartOfAccountController@getRecievables');

        Route::get('/coa-report-group', 'API\CompanyCOAReportGroupController@index');
        Route::post('/coa-report-group', 'API\CompanyCOAReportGroupController@save');
        Route::post('/coa-report-group/delete', 'API\CompanyCOAReportGroupController@delete');

        Route::get('/coa-account-group', 'API\CompanyCOAAccountGroupController@index');
        Route::post('/coa-account-group', 'API\CompanyCOAAccountGroupController@save');
        Route::post('/coa-account-group/delete', 'API\CompanyCOAAccountGroupController@delete');

        Route::get('/account-period', 'API\CompanyAccountingPeriodController@index');
        Route::post('/account-period', 'API\CompanyAccountingPeriodController@save');

    });

    Route::group(['prefix' => 'globals'], function(){
        Route::get('/address-list', 'API\GlobalAddressListController@index');
        Route::post('/address-list', 'API\GlobalAddressListController@save');
        Route::post('/address-list/delete', 'API\GlobalAddressListController@delete');

        Route::get('/customer-chain', 'API\GlobalCustomerChainController@index');
        Route::post('/customer-chain', 'API\GlobalCustomerChainController@save');
        Route::post('/customer-chain/delete', 'API\GlobalCustomerChainController@delete');

        Route::get('/cost-center', 'API\GlobalCostCenterController@index');
        Route::post('/cost-center', 'API\GlobalCostCenterController@save');
        Route::post('/cost-center/delete', 'API\GlobalCostCenterController@delete');

        Route::get('/customer-channel', 'API\GlobalCustomerChannelController@index');
        Route::post('/customer-channel', 'API\GlobalCustomerChannelController@save');
        Route::post('/customer-channel/delete', 'API\GlobalCustomerChannelController@delete');

        Route::get('/customer-type', 'API\GlobalCustomerTypeController@index');
        Route::post('/customer-type', 'API\GlobalCustomerTypeController@save');
        Route::post('/customer-type/delete', 'API\GlobalCustomerTypeController@delete');

        Route::get('/uom', 'API\GlobalUomController@index');
        Route::post('/uom', 'API\GlobalUomController@save');
        Route::post('/uom/delete', 'API\GlobalUomController@delete');


        Route::get('/base-uom', 'API\GlobalUomController@getBaseUom');
        Route::get('/packing-uom', 'API\GlobalUomController@getPackingUom');
    });

    Route::group(['prefix' => 'admin'], function(){
        Route::get('/company-list', 'API\CompanyListController@index');
        Route::post('/company-list', 'API\CompanyListController@save');
        Route::post('/company-list/delete', 'API\CompanyListController@delete');

        Route::get('/coa-report-group', 'API\AdminCOAReportGroupController@index');
        Route::post('/coa-report-group', 'API\AdminCOAReportGroupController@save');
        Route::post('/coa-report-group/delete', 'API\AdminCOAReportGroupController@delete');

        Route::get('/coa-account-group', 'API\AdminCOAAccountGroupController@index');
        Route::post('/coa-account-group', 'API\AdminCOAAccountGroupController@save');
        Route::post('/coa-account-group/delete', 'API\AdminCOAAccountGroupController@delete');

        Route::get('/chart-of-accounts', 'API\AdminChartOfAccountController@index');
        Route::post('/chart-of-accounts', 'API\AdminChartOfAccountController@save');
        Route::post('/chart-of-accounts/delete', 'API\AdminChartOfAccountController@delete');

        Route::get('/cost-center', 'API\AdminCostCenterController@index');
        Route::post('/cost-center', 'API\AdminCostCenterController@save');
        Route::post('/cost-center/delete', 'API\AdminCostCenterController@delete');

    });

    Route::group(['prefix' => 'buy-and-pay'], function(){
        
        Route::get('/orders', 'API\BuyAndPayOrderController@index');
        Route::get('/orders/{order_uuid}', 'API\BuyAndPayOrderController@show'); // check if can use this for all PO status
        Route::put('/orders/{order_uuid}', 'API\BuyAndPayOrderController@update');

        Route::get('/orders/{order_uuid}/suppliers/{supplier_uuid}/discounts', 'API\BuyAndPayOrderController@getSupplierDiscounts');

        Route::post('/orders', 'API\BuyAndPayOrderController@save');
        Route::post('/order/delete', 'API\BuyAndPayOrderController@deleteOrder');
        Route::post('/orders/{order_uuid}/cancel', 'API\BuyAndPayOrderController@cancelOrder');

        Route::get('/reason-codes', 'API\BuyAndPayReasonCodeController@index');
        Route::post('/reason-codes', 'API\BuyAndPayReasonCodeController@save');
        Route::delete('/reason-codes/{uuid}', 'API\BuyAndPayReasonCodeController@delete');

        Route::get('/received', 'API\PurchaseReceiveController@getReceived');
        Route::get('/to-received', 'API\PurchaseReceiveController@getToReceive');

        Route::get('/billed', 'API\PurchaseBillingController@getBilled');
        Route::get('/to-bill', 'API\PurchaseBillingController@getToBill');
        Route::post('/billing/{order_uuid}/details', 'API\PurchaseBillingController@save');
        

        Route::post('/receipts/{order_uuid}', 'API\BuyAndPayReceiveController@save');

        Route::get('/receipts/{order_uuid}', 'API\BuyAndPayReceiveController@show');
        Route::get('/receipts/{order_uuid}/supplier-items', 'API\BuyAndPayReceiveController@getOrderSupplierItems');

        Route::get('/{type}/{order_uuid}/items', 'API\BuyAndPayItemController@index');
        Route::post('/{type}/{order_uuid}/items', 'API\BuyAndPayItemController@save');


        Route::get('/bills', 'API\BuyAndPayBillController@index');
        Route::post('/bills', 'API\BuyAndPayBillController@store');

        Route::get('/bills/{order_uuid}', 'API\BuyAndPayBillController@show');
        Route::get('/bills/{order_uuid}/supplier-items', 'API\BuyAndPayBillController@getOrderSupplierItems');
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
        
    });

    Route::group(['prefix' => 'price-rules'], function(){
        Route::get('/', 'API\PriceRuleController@index');
        Route::get('/{uuid}', 'API\PriceRuleController@show');
        Route::post('/', 'API\PriceRuleController@store');
        Route::put('/', 'API\PriceRuleController@update');
        Route::post('/delete', 'API\PriceRuleController@delete');
    });


    Route::get('/menus', 'API\MenuController@index');

});
