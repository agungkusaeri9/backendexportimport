<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/', function(){
    return view('welcome');
})->name('home');

Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->namespace('Admin')->name('admin.')->group(function () {
        Route::get('/','DashboardController')->name('dashboard')->middleware('can:dashboard');
        Route::get('/profile', 'ProfileController@show')->name('profile.show')->middleware('can:profile-edit');
        Route::post('/profile', 'ProfileController@update')->name('profile.update')->middleware('can:profile-edit');


        // users
        Route::prefix('users')->group(function(){
            Route::get('/','UserController@index')->name('users.index')->middleware('can:user-view');
            Route::get('/create','UserController@create')->name('users.create')->middleware('can:user-create');
            Route::post('/create','UserController@store')->name('users.store')->middleware('can:user-create');
            Route::get('/{id}/edit','UserController@edit')->name('users.edit')->middleware('can:user-edit');
            Route::patch('/{id}/edit','UserController@update')->name('users.update')->middleware('can:user-edit');
            Route::delete('/{id}/delete','UserController@destroy')->name('users.destroy')->middleware('can:user-delete');
        });


        // roles
        Route::prefix('roles')->group(function(){
            Route::get('/','RoleController@index')->name('roles.index')->middleware('can:role-view');
            Route::get('/create','RoleController@create')->name('roles.create')->middleware('can:role-create');
            Route::post('/create','RoleController@store')->name('roles.store')->middleware('can:role-create');
            Route::get('/{id}/edit','RoleController@edit')->name('roles.edit')->middleware('can:role-edit');
            Route::patch('/{id}/edit','RoleController@update')->name('roles.update')->middleware('can:role-edit');
            Route::delete('/{id}/delete','RoleController@destroy')->name('roles.destroy')->middleware('can:role-delete');

            // role permissions
            Route::get('/{id}','RoleController@show')->name('roles.show')->middleware('can:rolepermission-view');
            Route::post('/{id}/permission','RoleController@permissionsUpdate')->name('roles.permissions-update')->middleware('can:rolepermission-update');

        });

        // permissions
        Route::prefix('permissions')->group(function(){
            Route::get('/','PermissionController@index')->name('permissions.index')->middleware('can:permission-view');
            Route::get('/create','PermissionController@create')->name('permissions.create')->middleware('can:permission-create');
            Route::post('/create','PermissionController@store')->name('permissions.store')->middleware('can:permission-create');
            Route::get('/{id}/edit','PermissionController@edit')->name('permissions.edit')->middleware('can:permission-edit');
            Route::patch('/{id}/edit','PermissionController@update')->name('permissions.update')->middleware('can:permission-edit');
            Route::delete('/{id}/delete','PermissionController@destroy')->name('permissions.destroy')->middleware('can:permission-delete');
        });

         // warehouses
         Route::prefix('warehouses')->group(function(){
            Route::get('/','WarehouseController@index')->name('warehouses.index')->middleware('can:warehouse-view');
            Route::get('/create','WarehouseController@create')->name('warehouses.create')->middleware('can:warehouse-create');
            Route::post('/create','WarehouseController@store')->name('warehouses.store')->middleware('can:warehouse-create');
            Route::get('/{id}/edit','WarehouseController@edit')->name('warehouses.edit')->middleware('can:warehouse-edit');
            Route::patch('/{id}/edit','WarehouseController@update')->name('warehouses.update')->middleware('can:warehouse-edit');
            Route::delete('/{id}/delete','WarehouseController@destroy')->name('warehouses.destroy')->middleware('can:warehouse-delete');
        });

        //country
        Route::prefix('countries')->group(function(){
            Route::get('/','CountryController@index')->name('countries.index')->middleware('can:country-view');
            Route::get('/create','CountryController@create')->name('countries.create')->middleware('can:country-create');
            Route::post('/create','CountryController@store')->name('countries.store')->middleware('can:country-create');
            Route::get('/{id}/edit','CountryController@edit')->name('countries.edit')->middleware('can:country-edit');
            Route::patch('/{id}/edit','CountryController@update')->name('countries.update')->middleware('can:country-edit');
            Route::delete('/{id}/delete','CountryController@destroy')->name('countries.destroy')->middleware('can:country-delete');
        });

         //carriers
         Route::prefix('carriers')->group(function(){
            Route::get('/','CarrierController@index')->name('carriers.index')->middleware('can:carrier-view');
            Route::get('/create','CarrierController@create')->name('carriers.create')->middleware('can:carrier-create');
            Route::post('/create','CarrierController@store')->name('carriers.store')->middleware('can:carrier-create');
            Route::get('/{id}/edit','CarrierController@edit')->name('carriers.edit')->middleware('can:carrier-edit');
            Route::patch('/{id}/edit','CarrierController@update')->name('carriers.update')->middleware('can:carrier-edit');
            Route::delete('/{id}/delete','CarrierController@destroy')->name('carriers.destroy')->middleware('can:carrier-delete');
        });

        //finances
        Route::prefix('finances')->group(function(){
            Route::get('/','FinanceController@index')->name('finances.index')->middleware('can:finance-view');
            Route::get('/create','FinanceController@create')->name('finances.create')->middleware('can:finance-create');
            Route::post('/create','FinanceController@store')->name('finances.store')->middleware('can:finance-create');
            Route::get('/{id}/download','FinanceController@download')->name('finances.download');
            Route::get('/{id}/edit','FinanceController@edit')->name('finances.edit')->middleware('can:finance-edit');
            Route::patch('/{id}/edit','FinanceController@update')->name('finances.update')->middleware('can:finance-edit');
            Route::delete('/{id}/delete','FinanceController@destroy')->name('finances.destroy')->middleware('can:finance-delete');
        });
    });
});
