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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['check.admin.api_token','gate.admin.api_token', 'auth:api']], function(){
    Route::get('dashboard/data', 'DashboardController@data');
    Route::get('leads/all', 'LeadsController@all')->name('api.leads');
    Route::post('leads/import', 'APIController@importLeads')->name('api.leads-import');
    Route::get('categories/all', 'CategoriesController@all')->name('api.category.list');
    Route::get('categories/json', 'CategoriesController@getCategoryJsonAPI')->name('api.categories.json');
    Route::get('admins/all', 'AdminsController@all')->name('api.admin.lists');
    Route::get('customers/all', 'CustomersController@all')->name('api.customers.lists');
    Route::get('subscriptions/all', 'SubscriptionsController@all')->name('api.subscriptions.lists');
    
    Route::get('transactions/all', 'TransactionsController@getAllTransactions')->name('api.transactions.lists');
    Route::get('transactions/archivelist', 'TransactionsController@getAllTransactionsArchive')->name('api.transactions.archivelist');
    Route::get('countries', 'APIController@countries')->name('api.countries');
    Route::get('languages', 'APIController@languages')->name('api.languages');
    Route::get('currencies', 'APIController@currencies')->name('api.currencies');
    Route::get('permissions/all', 'PermissionsController@all');
    Route::get('roles/all', 'RolesController@all');

    Route::get('payments/all', 'PaymentMethodsController@all');
    Route::get('integrations/all', 'IntegrationsController@all');
    Route::get('integrationgroups/all', 'IntegrationsGroupsController@all');

    Route::get('reports/sales/new', 'ReportsController@salesnewAPI');
    Route::get('reports/sales/renew', 'ReportsController@salesrenewAPI');


    Route::get('settings/init', 'SettingsController@init');
});
