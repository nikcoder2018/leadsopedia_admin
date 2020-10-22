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

Route::group(['middleware' => 'check.admin.api_token'], function(){
    Route::get('leads/all', 'APIController@getAllLeads')->name('api.leads');
    Route::post('leads/import', 'APIController@importLeads')->name('api.leads-import');
    Route::get('categories', 'CategoriesController@getCategoryAPI')->name('api.categories');
    Route::get('categories/json', 'CategoriesController@getCategoryJsonAPI')->name('api.categories.json');
    Route::get('admins/all', 'AdminsController@getAllAdmin')->name('api.admin.lists');
    Route::get('customers/all', 'CustomersController@getAllCustomers')->name('api.customers.lists');
    Route::get('transactions/all', 'TransactionsController@getAllTransactions')->name('api.transactions.lists');
});
