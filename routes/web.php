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
    Route::get('profile', 'ProfilesController@index')->name('profile');
    Route::post('profile/update','ProfilesController@updateProfile')->name('profile.update');
    Route::post('profile/change-avatar','ProfilesController@changeAvatar')->name('profile.change.avatar');
    Route::post('profile/change-cover','ProfilesController@changeCover')->name('profile.change.cover');
    Route::post('profile/change-password','ProfilesController@changePassword')->name('profile.change.password');

    Route::resource('leads', 'LeadsController', ['except' => ['show','update', 'destroy']]);
    Route::post('leads/delete', 'LeadsController@destroy')->name('leads.delete');
    Route::get('leads/import', 'LeadsController@import')->name('leads.import');
    Route::get('leads/exportcsv', 'LeadsController@exportcsv')->name('leads.exportcsv');
    Route::get('leads/exportpdf', 'LeadsController@exportpdf')->name('leads.exportpdf');

    Route::resource('admins', 'AdminsController', ['except' => ['edit','update', 'destroy']]);
    Route::post('admins/edit', 'AdminsController@edit')->name('admins.edit');
    Route::post('admins/update', 'AdminsController@update')->name('admins.update');
    Route::post('admins/destroy', 'AdminsController@destroy')->name('admins.destroy');

    Route::resource('customers', 'CustomersController', ['except' => ['update', 'destroy']]);
    
    Route::resource('reports', 'ReportsController', ['except' => ['update', 'destroy']]);

    Route::resource('categories', 'CategoriesController', ['except' => ['edit','update', 'destroy']]);
    Route::post('categories/edit', 'CategoriesController@edit')->name('categories.edit');
    Route::post('categories/update', 'CategoriesController@update')->name('categories.update');
    Route::post('categories/import', 'CategoriesController@import')->name('categories.import');
    Route::post('categories/destroy', 'CategoriesController@destroy')->name('categories.destroy');
    Route::post('categories/destroy-many', 'CategoriesController@destroyMany')->name('categories.destroy-many');

    
    Route::resource('subscriptions', 'SubscriptionsController', ['except' => ['edit','update', 'destroy']]);
    Route::post('subscriptions/edit', 'SubscriptionsController@edit')->name('subscriptions.edit');
    Route::post('subscriptions/update', 'SubscriptionsController@update')->name('subscriptions.update');
    Route::post('subscriptions/destroy', 'SubscriptionsController@destroy')->name('subscriptions.destroy');

    Route::get('transactions', 'TransactionsController@index')->name('transactions.index');
    Route::post('transactions/archive', 'TransactionsController@archive')->name('transactions.archive');
    Route::post('transactions/restore', 'TransactionsController@restore')->name('transactions.restore');
    
    Route::get('archives/transactions', 'TransactionsController@archiveslist')->name('archives.transactions');

    Route::get('settings', 'SettingsController@index')->name('settings.index');
    Route::post('settings/general', 'SettingsController@update_general')->name('settings.general.update');
});
   

