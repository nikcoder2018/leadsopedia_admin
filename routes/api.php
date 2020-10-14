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

Route::get('leads/all', 'APIController@getAllLeads')->name('api.leads');
Route::post('leads/import', 'APIController@importLeads')->name('api.leads-import');
Route::get('categories', 'CategoriesController@getCategoryAPI')->name('api.categories');
Route::get('categories/json', 'CategoriesController@getCategoryJsonAPI')->name('api.categories.json');