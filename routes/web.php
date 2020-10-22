<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes(['register' => false]);

Route::group(['middleware' => 'auth'], function(){
    Route::get('/', 'DashboardController@index')->name('home');
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');

    Route::resource('leads', 'LeadsController', ['except' => ['show','update', 'destroy']]);
    Route::post('leads/delete', 'LeadsController@destroy')->name('leads.delete');
    Route::get('leads/import', 'LeadsController@import')->name('leads.import');
    Route::get('leads/exportcsv', 'LeadsController@exportcsv')->name('leads.exportcsv');
    Route::get('leads/exportpdf', 'LeadsController@exportpdf')->name('leads.exportpdf');

    Route::resource('admins', 'AdminsController', ['except' => ['update', 'destroy']]);

    Route::resource('customers', 'CustomersController', ['except' => ['update', 'destroy']]);
    
    Route::resource('reports', 'ReportsController', ['except' => ['update', 'destroy']]);

    Route::resource('categories', 'CategoriesController', ['except' => ['edit','update', 'destroy']]);
    Route::post('categories/edit', 'CategoriesController@edit')->name('categories.edit');
    Route::post('categories/update', 'CategoriesController@update')->name('categories.update');
    Route::post('categories/import', 'CategoriesController@import')->name('categories.import');
    Route::post('categories/destroy', 'CategoriesController@destroy')->name('categories.destroy');

    
    Route::resource('subscriptions', 'SubscriptionsController', ['except' => ['edit','update', 'destroy']]);
    Route::post('subscriptions/edit', 'SubscriptionsController@edit')->name('subscriptions.edit');
    Route::post('subscriptions/update', 'SubscriptionsController@update')->name('subscriptions.update');
    Route::post('subscriptions/destroy', 'SubscriptionsController@destroy')->name('subscriptions.destroy');

    Route::get('transactions', 'TransactionsController@index')->name('transactions.index');
    Route::get('settings', 'SettingsController@index')->name('settings');
});
   

