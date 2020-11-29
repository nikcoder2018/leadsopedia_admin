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

    Route::post('payment-methods/store', 'PaymentMethodsController@store')->name('payment-methods.store');
    Route::post('payment-methods/edit', 'PaymentMethodsController@edit')->name('payment-methods.edit');
    Route::post('payment-methods/update', 'PaymentMethodsController@update')->name('payment-methods.update');
    Route::post('payment-methods/destroy', 'PaymentMethodsController@destroy')->name('payment-methods.destroy');

    Route::post('integrations/store', 'IntegrationsController@store')->name('integrations.store');
    Route::post('integrations/edit', 'IntegrationsController@edit')->name('integrations.edit');
    Route::post('integrations/update', 'IntegrationsController@update')->name('integrations.update');
    Route::post('integrations/destroy', 'IntegrationsController@destroy')->name('integrations.destroy');

    Route::post('integrationgroups/store', 'IntegrationsGroupsController@store')->name('integrationgroups.store');
    Route::post('integrationgroups/edit', 'IntegrationsGroupsController@edit')->name('integrationgroups.edit');
    Route::post('integrationgroups/update', 'IntegrationsGroupsController@update')->name('integrationgroups.update');
    Route::post('integrationgroups/destroy', 'IntegrationsGroupsController@destroy')->name('integrationgroups.destroy');


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

