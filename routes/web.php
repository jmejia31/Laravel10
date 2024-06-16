<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PermissionController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
		Route::get('icons', ['as' => 'pages.icons', 'uses' => 'App\Http\Controllers\PageController@icons']);
		Route::get('maps', ['as' => 'pages.maps', 'uses' => 'App\Http\Controllers\PageController@maps']);
		Route::get('notifications', ['as' => 'pages.notifications', 'uses' => 'App\Http\Controllers\PageController@notifications']);
		Route::get('rtl', ['as' => 'pages.rtl', 'uses' => 'App\Http\Controllers\PageController@rtl']);
		Route::get('tables', ['as' => 'pages.tables', 'uses' => 'App\Http\Controllers\PageController@tables']);
        Route::get('tables', ['as' => 'pages.tables', 'uses' => 'App\Http\Controllers\PageController@tables']);
		Route::get('typography', ['as' => 'pages.typography', 'uses' => 'App\Http\Controllers\PageController@typography']);
		Route::get('upgrade', ['as' => 'pages.upgrade', 'uses' => 'App\Http\Controllers\PageController@upgrade']);
});

Route::group(['middleware' => 'auth'], function () {
    Route::resource('user', UserController::class);
	//Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

//ESTAS SON LAS RUTAS DE ROLES
Route::group(['middleware' => 'auth'], function () {
    Route::resource('role', RoleController::class);
    Route::get('role/{roleId}/delete', [RoleController::class, 'destroy']);
    Route::get('role/{roleId}/give-permissions', [RoleController::class, 'addPermissionToRole']);
    Route::put('role/{roleId}/give-permissions', [RoleController::class, 'givePermissionToRole']);

    //SEGUNDA FORMA DE CREAR RUTAS RESOURCES Y SIMPLES mas larga
    //Route::resource('role', App\Http\Controllers\RoleController::class);
    //Route::get('role/{roleId}/delete', [App\Http\Controllers\RoleController::class, 'destroy']);

});

//ESTAS SON LAS RUTAS DE PERMISSIONS
Route::group(['middleware' => 'auth'], function () {
    Route::resource('permissions', App\Http\Controllers\PermissionController::class);
    Route::get('permissions/{permissionId}/delete', [App\Http\Controllers\PermissionController::class, 'destroy']);

    //SEGUNDA FORMA DE CREAR RUTAS RESOURCES Y SIMPLES mas cortos
    //Route::resource('permissions', PermissionController::class);
    //Route::get('permissions/{permissionId}/delete', [PermissionController::class, 'destroy']);
});



