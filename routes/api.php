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

        Route::get('/item-list', 'API\ItemListController@getAllItem');
        Route::post('/item-list/save', 'API\ItemListController@save');
        Route::put('/item-list/update', 'API\ItemListController@update');
        Route::post('/item-list/delete', 'API\ItemListController@delete');

        Route::get('/item-group', 'API\ItemGroupController@getAllItemGroup');
        Route::post('/item-group', 'API\ItemGroupController@save');
        Route::post('/item-group/delete', 'API\ItemGroupController@delete');

        Route::get('/item-asset-group', 'API\ItemAssetGroupController@getAllItemAssetGroup');
        Route::post('/item-asset-group', 'API\ItemAssetGroupController@save');
        Route::post('/item-asset-group/delete', 'API\ItemAssetGroupController@delete');
        
        Route::get('/category1', 'API\ItemCategory1Controller@getAllCategory');
        Route::post('/category1', 'API\ItemCategory1Controller@save');
        Route::post('/category1/delete', 'API\ItemCategory1Controller@delete');

        Route::get('/category2', 'API\ItemCategory2Controller@getAllCategory');
        Route::post('/category2', 'API\ItemCategory2Controller@save');
        Route::post('/category2/delete', 'API\ItemCategory2Controller@delete');

        Route::get('/category3', 'API\ItemCategory3Controller@getAllCategory');
        Route::post('/category3', 'API\ItemCategory3Controller@save');
        Route::post('/category3/delete', 'API\ItemCategory3Controller@delete');

        Route::get('/category4', 'API\ItemCategory4Controller@getAllCategory');
        Route::post('/category4', 'API\ItemCategory4Controller@save');
        Route::post('/category4/delete', 'API\ItemCategory4Controller@delete');

        Route::get('/category5', 'API\ItemCategory5Controller@getAllCategory');
        Route::post('/category5', 'API\ItemCategory5Controller@save');
        Route::post('/category5/delete', 'API\ItemCategory5Controller@delete');

        Route::post('/uom/save', 'API\ItemUomController@save');
        Route::put('/uom/update', 'API\ItemUomController@update');
        Route::post('/uom/delete', 'API\ItemUomController@delete');

    });

    Route::group(['prefix' => 'suppliers'], function(){

        Route::get('/supplier-list', 'API\SupplierListController@getAllSupplierList');
        Route::post('/supplier-list/save', 'API\SupplierListController@save');
        Route::put('/supplier-list/update', 'API\SupplierListController@update');
        Route::post('/supplier-list/delete', 'API\SupplierListController@delete');

        Route::get('/supplier-group', 'API\SupplierGroupController@getAllSupplierGroup');
        Route::post('/supplier-group', 'API\SupplierGroupController@save');
        Route::post('/supplier-group/delete', 'API\SupplierGroupController@delete');

        Route::post('/supplier-discount-regular/save', 'API\SupplierDiscountRegularController@save');
        Route::put('/supplier-discount-regular/update', 'API\SupplierDiscountRegularController@update');
        Route::post('/supplier-discount-regular/delete', 'API\SupplierDiscountRegularController@delete');

    });

    Route::group(['prefix' => 'customers'], function(){
        Route::get('/customer-group', 'API\CustomerGroupController@getAllCustomerGroup');
        Route::post('/customer-group', 'API\CustomerGroupController@save');
        Route::post('/customer-group/delete', 'API\CustomerGroupController@delete');

    });

    Route::group(['prefix' => 'employees'], function(){
        Route::get('/employment-type', 'API\EmployeeEmploymentTypeController@getAllEmploymentType');
        Route::post('/employment-type', 'API\EmployeeEmploymentTypeController@save');
        Route::post('/employment-type/delete', 'API\EmployeeEmploymentTypeController@delete');

    });

    Route::group(['prefix' => 'company'], function(){

        Route::get('/branch', 'API\CompanyBranchController@getAllBranch');
        Route::post('/branch', 'API\CompanyBranchController@save');
        Route::post('/branch/delete', 'API\CompanyBranchController@delete');

        Route::get('/branch-location', 'API\CompanyBranchLocationController@getAllBranchLocation');
        Route::post('/branch-location', 'API\CompanyBranchLocationController@save');
        Route::post('/branch-location/delete', 'API\CompanyBranchLocationController@delete');

        Route::get('/payment-term', 'API\CompanyPaymentTermController@getAllPaymentTerm');
        Route::post('/payment-term', 'API\CompanyPaymentTermController@save');
        Route::post('/payment-term/delete', 'API\CompanyPaymentTermController@delete');

        Route::get('/taxation', 'API\CompanyTaxationController@getAllTaxation');
        Route::post('/taxation', 'API\CompanyTaxationController@save');
        Route::post('/taxation/delete', 'API\CompanyTaxationController@delete');

        Route::get('/cost-center', 'API\CompanyCostCenterController@getAllCostCenter');
        Route::post('/cost-center', 'API\CompanyCostCenterController@save');
        Route::post('/cost-center/delete', 'API\CompanyCostCenterController@delete');

        Route::get('/chart-of-accounts', 'API\CompanyChartOfAccountController@getAllChartOfAccounts');
        Route::post('/chart-of-accounts', 'API\CompanyChartOfAccountController@save');
        Route::post('/chart-of-accounts/delete', 'API\CompanyChartOfAccountController@delete');

        Route::get('/chart-of-accounts-payables', 'API\CompanyChartOfAccountController@getAllPayables');
        Route::get('/chart-of-accounts-income', 'API\CompanyChartOfAccountController@getAllIncomeAccount');
        Route::get('/chart-of-accounts-cost-of-sales', 'API\CompanyChartOfAccountController@getAllCostOfSales');

        Route::get('/coa-report-group', 'API\CompanyCOAReportGroupController@getAllReportGroup');
        Route::post('/coa-report-group', 'API\CompanyCOAReportGroupController@save');
        Route::post('/coa-report-group/delete', 'API\CompanyCOAReportGroupController@delete');

        Route::get('/coa-account-group', 'API\CompanyCOAAccountGroupController@getAllAccountGroup');
        Route::post('/coa-account-group', 'API\CompanyCOAAccountGroupController@save');
        Route::post('/coa-account-group/delete', 'API\CompanyCOAAccountGroupController@delete');

    });

    Route::group(['prefix' => 'globals'], function(){
        Route::get('/address-list', 'API\GlobalAddressListController@getAllAddressList');
        Route::post('/address-list', 'API\GlobalAddressListController@save');
        Route::post('/address-list/delete', 'API\GlobalAddressListController@delete');

        Route::get('/customer-chain', 'API\GlobalCustomerChainController@getCustomerChains');
        Route::post('/customer-chain', 'API\GlobalCustomerChainController@save');
        Route::post('/customer-chain/delete', 'API\GlobalCustomerChainController@delete');

        Route::get('/customer-channel', 'API\GlobalCustomerChannelController@getCustomerChannels');
        Route::post('/customer-channel', 'API\GlobalCustomerChannelController@save');
        Route::post('/customer-channel/delete', 'API\GlobalCustomerChannelController@delete');

        Route::get('/customer-type', 'API\GlobalCustomerTypeController@getCustomerTypes');
        Route::post('/customer-type', 'API\GlobalCustomerTypeController@save');
        Route::post('/customer-type/delete', 'API\GlobalCustomerTypeController@delete');
    });

    Route::group(['prefix' => 'admin'], function(){
        Route::get('/company-list', 'API\CompanyListController@getCompanyList');
        Route::post('/company-list', 'API\CompanyListController@save');
        Route::post('/company-list/delete', 'API\CompanyListController@delete');
    });

    Route::get('/menus', 'API\MenuController@index');

});
