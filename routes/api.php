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
        Route::get('/category1', 'API\ItemCategory1Controller@getAllCategory');
        Route::post('/category1/save', 'API\ItemCategory1Controller@save');
        Route::put('/category1/update', 'API\ItemCategory1Controller@update');
        Route::post('/category1/delete', 'API\ItemCategory1Controller@delete');

        Route::get('/category2', 'API\ItemCategory2Controller@getAllCategory');
        Route::post('/category2/save', 'API\ItemCategory2Controller@save');
        Route::put('/category2/update', 'API\ItemCategory2Controller@update');
        Route::post('/category2/delete', 'API\ItemCategory2Controller@delete');

        Route::get('/category3', 'API\ItemCategory3Controller@getAllCategory');
        Route::post('/category3/save', 'API\ItemCategory3Controller@save');
        Route::put('/category3/update', 'API\ItemCategory3Controller@update');
        Route::post('/category3/delete', 'API\ItemCategory3Controller@delete');

        Route::get('/category4', 'API\ItemCategory4Controller@getAllCategory');
        Route::post('/category4/save', 'API\ItemCategory4Controller@save');
        Route::put('/category4/update', 'API\ItemCategory4Controller@update');
        Route::post('/category4/delete', 'API\ItemCategory4Controller@delete');

        Route::get('/category5', 'API\ItemCategory5Controller@getAllCategory');
        Route::post('/category5/save', 'API\ItemCategory5Controller@save');
        Route::put('/category5/update', 'API\ItemCategory5Controller@update');
        Route::post('/category5/delete', 'API\ItemCategory5Controller@delete');

    });

    Route::group(['prefix' => 'suppliers'], function(){
        Route::get('/supplier-group', 'API\SupplierGroupController@getAllSupplierGroup');
        Route::post('/supplier-group/save', 'API\SupplierGroupController@save');
        Route::put('/supplier-group/update', 'API\SupplierGroupController@update');
        Route::post('/supplier-group/delete', 'API\SupplierGroupController@delete');

    });

    Route::group(['prefix' => 'customers'], function(){
        Route::get('/customer-group', 'API\CustomerGroupController@getAllCustomerGroup');
        Route::post('/customer-group/save', 'API\CustomerGroupController@save');
        Route::put('/customer-group/update', 'API\CustomerGroupController@update');
        Route::post('/customer-group/delete', 'API\CustomerGroupController@delete');

    });

    Route::group(['prefix' => 'employees'], function(){
        Route::get('/employment-type', 'API\EmployeeEmploymentTypeController@getAllEmploymentType');
        Route::post('/employment-type/save', 'API\EmployeeEmploymentTypeController@save');
        Route::put('/employment-type/update', 'API\EmployeeEmploymentTypeController@update');
        Route::post('/employment-type/delete', 'API\EmployeeEmploymentTypeController@delete');

    });

    Route::group(['prefix' => 'company'], function(){
        Route::get('/payment-term', 'API\CompanyPaymentTermController@getAllPaymentTerm');
        Route::post('/payment-term/save', 'API\CompanyPaymentTermController@save');
        Route::put('/payment-term/update', 'API\CompanyPaymentTermController@update');
        Route::post('/payment-term/delete', 'API\CompanyPaymentTermController@delete');

        Route::get('/taxation', 'API\CompanyTaxationController@getAllTaxation');
        Route::post('/taxation/save', 'API\CompanyTaxationController@save');
        Route::put('/taxation/update', 'API\CompanyTaxationController@update');
        Route::post('/taxation/delete', 'API\CompanyTaxationController@delete');

        Route::get('/cost-center', 'API\CompanyCostCenterController@getAllCostCenter');
        Route::post('/cost-center/save', 'API\CompanyCostCenterController@save');
        Route::put('/cost-center/update', 'API\CompanyCostCenterController@update');
        Route::post('/cost-center/delete', 'API\CompanyCostCenterController@delete');

        Route::get('/coa-report-group', 'API\CompanyCOAReportGroupController@getAllReportGroup');
        Route::post('/coa-report-group/save', 'API\CompanyCOAReportGroupController@save');
        Route::put('/coa-report-group/update', 'API\CompanyCOAReportGroupController@update');
        Route::post('/coa-report-group/delete', 'API\CompanyCOAReportGroupController@delete');

        Route::get('/coa-account-group', 'API\CompanyCOAAccountGroupController@getAllAccountGroup');
        Route::post('/coa-account-group/save', 'API\CompanyCOAAccountGroupController@save');
        Route::put('/coa-account-group/update', 'API\CompanyCOAAccountGroupController@update');
        Route::post('/coa-account-group/delete', 'API\CompanyCOAAccountGroupController@delete');

    });

});
