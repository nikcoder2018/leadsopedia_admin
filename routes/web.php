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
    Route::get('account/permissions', 'UsersController@mypermissions');

    Route::get('/', 'DashboardController@index')->name('home');
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('profile', 'ProfilesController@index')->name('profile');
    Route::post('profile/update','ProfilesController@updateProfile')->name('profile.update');
    Route::post('profile/change-avatar','ProfilesController@changeAvatar')->name('profile.change.avatar');
    Route::post('profile/change-cover','ProfilesController@changeCover')->name('profile.change.cover');
    Route::post('profile/change-password','ProfilesController@changePassword')->name('profile.change.password');

    Route::resource('leads', 'LeadsController', ['except' => ['show','update', 'destroy']]);
    Route::get('leads/{id}/delete', 'LeadsController@destroy')->name('leads.delete');
    Route::get('leads/import/{id}', 'LeadsController@import')->name('leads.import');
    Route::get('leads/import/{id}/body', 'LeadsController@importbody')->name('leads.importbody');
    Route::post('leads/import/data', 'LeadsController@importData')->name('leads.importdata');
    Route::post('leads/uploadcsv', 'LeadsController@uploadcsv')->name('leads.uploadcsv');
    Route::get('leads/exportcsv', 'LeadsController@exportcsv')->name('leads.exportcsv');
    Route::get('leads/exportpdf', 'LeadsController@exportpdf')->name('leads.exportpdf');

    Route::resource('admins', 'AdminsController');
    Route::post('admins/{id}', 'AdminsController@update')->name('admins.update');
    Route::get('admins/{id}/delete', 'AdminsController@destroy')->name('admins.delete');

    Route::resource('customers', 'CustomersController');
    Route::get('customers/{id}/deactivate', 'CustomersController@deactivate')->name('customers.deactivate');
    Route::get('customers/{id}/activate', 'CustomersController@activate')->name('customers.activate');
    Route::get('customers/{id}/delete', 'CustomersController@destroy')->name('customers.delete');

    Route::resource('/roles', 'RolesController', ['except' => ['show','update','destroy']]);
    Route::post('/roles/{id}', 'RolesController@update')->name('roles.update');
    Route::get('/roles/{id}/delete', 'RolesController@destroy')->name('roles.delete');

    Route::resource('/permissions', 'PermissionsController', ['except' => ['show', 'update','destroy']]);
    Route::post('/permissions/update', 'PermissionsController@update')->name('permissions.update');
    Route::get('/permissions/{id}/delete', 'PermissionsController@destroy')->name('permissions.delete');
    
    Route::resource('reports', 'ReportsController', ['except' => ['update', 'destroy']]);

    Route::resource('categories', 'CategoriesController', ['except' => ['update', 'destroy']]);
    Route::post('categories/update', 'CategoriesController@update')->name('categories.update');
    Route::post('categories/import', 'CategoriesController@import')->name('categories.import');
    Route::get('categories/{id}/delete', 'CategoriesController@destroy')->name('categories.delete');
    Route::post('categories/destroy-many', 'CategoriesController@destroyMany')->name('categories.destroy-many');

    
    Route::resource('subscriptions', 'SubscriptionsController', ['except' => ['update', 'destroy']]);
    Route::post('subscriptions/update', 'SubscriptionsController@update')->name('subscriptions.update');
    Route::get('subscriptions/{id}/delete', 'SubscriptionsController@destroy')->name('subscriptions.delete');

    Route::get('transactions', 'TransactionsController@index')->name('transactions.index');
    Route::get('transactions/{id}/details', 'TransactionsController@show')->name('transactions.details');
    Route::get('transactions/{id}/archive', 'TransactionsController@archive')->name('transactions.archive');
    Route::get('transactions/{id}/restore', 'TransactionsController@restore')->name('transactions.restore');
    Route::get('transactions/{id}/delete', 'TransactionsController@destroy')->name('transactions.delete');

    Route::post('payment-methods/store', 'PaymentMethodsController@store')->name('payment-methods.store');
    Route::get('payment-methods/{id}/edit', 'PaymentMethodsController@edit')->name('payment-methods.edit');
    Route::post('payment-methods/update', 'PaymentMethodsController@update')->name('payment-methods.update');
    Route::get('payment-methods/{id}/delete', 'PaymentMethodsController@destroy')->name('payment-methods.delete');

    Route::post('integrations/store', 'IntegrationsController@store')->name('integrations.store');
    Route::get('integrations/{id}/edit', 'IntegrationsController@edit')->name('integrations.edit');
    Route::post('integrations/update', 'IntegrationsController@update')->name('integrations.update');
    Route::get('integrations/{id}/delete', 'IntegrationsController@destroy')->name('integrations.delete');

    Route::post('integrationgroups/store', 'IntegrationsGroupsController@store')->name('integrationgroups.store');
    Route::post('integrationgroups/edit', 'IntegrationsGroupsController@edit')->name('integrationgroups.edit');
    Route::post('integrationgroups/update', 'IntegrationsGroupsController@update')->name('integrationgroups.update');
    Route::post('integrationgroups/destroy', 'IntegrationsGroupsController@destroy')->name('integrationgroups.destroy');

    Route::get('reports/sales/new', 'ReportsController@salesnew')->name('reports.sales.new');
    Route::get('reports/sales/renew', 'ReportsController@salesrenew')->name('reports.sales.renew');

    Route::get('archives/transactions', 'TransactionsController@archiveslist')->name('archives.transactions');

    Route::get('settings', 'SettingsController@index')->name('settings.index');
    Route::post('settings/general', 'SettingsController@update_general')->name('settings.general.update');
});
   
use App\Integration;
use App\IntegrationDataDefault;
Route::get('test-zerobounce', function(){
    $int_zb = Integration::where('app_key','zero_bounce')->where('scope','backend')->where('status', 'enabled')->first();
    
    if($int_zb){
        $zp_api_key = IntegrationDataDefault::where('integration_id', $int_zb->id)->where('name', 'api_key')->first()->value;
        $zb = new ZeroBounce($zp_api_key);
        return response()->json($zb->getCredits());
        // return response()->json($zb->batchValidate(
        //     array(
        //         (object)['email_address'=>'b.nickjay05@gmail.com', 'ip_address' => ''],
        //         (object)['email_address'=>'b.nickjay06@gmail.com', 'ip_address' => ''],
        //         (object)['email_address'=>'b.nickjay07@gmail.com', 'ip_address' => ''],
        //     )
        // ));
    }
});

Route::get('test-hubspot', function(){
    $int_hubspot = Integration::where('app_key','hubspot')->where('scope','frontend')->where('status', 'enabled')->first();
    
    if($int_hubspot){
        $hubspot_api_key = IntegrationDataDefault::where('integration_id', $int_hubspot->id)->where('name', 'api_key')->first()->value;
        $hubspot = new HubspotContact($hubspot_api_key);
        return response()->json($hubspot->getByEmail('bh@hubspot.com'));
        // return response()->json($hubspot->createOrUpdateBatch(
        //     array(
        //         (object) array(
        //             'vid' => '201',
        //             'properties' => [
        //                 (object)['property'=>'email', 'value'=>'b.nickjay05@gmail.com'],
        //                 (object)['property'=>'firstname', 'value'=>'Andrian'],
        //                 (object)['property'=>'lastname', 'value'=>'Mott'],
        //                 (object)['property'=>'website', 'value'=>'http://hubspot.com'],
        //                 (object)['property'=>'company', 'value'=>'HubSpot']
        //             ]
        //         ),
        //         (object) array(
        //             'email' => 'b.nickjay07@hubspot.com',
        //             'properties' => [
        //                 (object)['property'=>'email', 'value'=>'b.nickjay07@hubspot.com'],
        //                 (object)['property'=>'firstname', 'value'=>'Andrian'],
        //                 (object)['property'=>'lastname', 'value'=>'Mott'],
        //                 (object)['property'=>'website', 'value'=>'http://hubspot.com'],
        //                 (object)['property'=>'company', 'value'=>'HubSpot']
        //             ]
        //         )
        //     )
        // ));
        // return response()->json($hubspot->update(2, (object) array(
        //     "name" => "test1"
        // )));

        #return response()->json($hubspot->getById(2)); exit;
        // return response()->json($zb->batchValidate(
        //     array(
        //         (object)['email_address'=>'b.nickjay05@gmail.com', 'ip_address' => ''],
        //         (object)['email_address'=>'b.nickjay06@gmail.com', 'ip_address' => ''],
        //         (object)['email_address'=>'b.nickjay07@gmail.com', 'ip_address' => ''],
        //     )
        // ));
    }
});

Route::get('test-copper', function(){
    $int_copper = Integration::where('app_key','copper')->where('scope','frontend')->where('status', 'enabled')->first();
    
    if($int_copper){
        $copper_api_key = IntegrationDataDefault::where('integration_id', $int_copper->id)->where('name', 'api_key')->first()->value;
        $copper_email = IntegrationDataDefault::where('integration_id', $int_copper->id)->where('name', 'email')->first()->value;
        $copper = new Copper($copper_api_key, $copper_email);
        return response()->json($copper->getUserById(887429));
    }
});

