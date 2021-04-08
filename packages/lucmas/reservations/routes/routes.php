<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Chiamate pubbliche
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => ['web']], function () {
    Route::get('/login', 'LoginController@showLoginform')->name('login');
    Route::post('/login', 'LoginController@login');
    Route::post('/logout', 'LoginController@logout')->name('logout');

    Route::get('/', function (){
        return view('Lucmas\Reservations\Views::landing');
    })->name('home');


    /** Rotta per le ordinazioni tramite qrCode*/
    Route::get('/reservation/{token}', 'ReservationController@new')->name('newreservation');

});

Route::group(['middleware' => ['web', 'auth']], function () {
    Route::get('/admin/', 'AdminController@index')->name('admin.dashboard');
    Route::get('/admin/products', 'AdminProductController@products')->name('admin.product.index');
    Route::get('/admin/categories', 'AdminCategoryController@categories')->name('admin.category.index');
    Route::get('/admin/tables', 'AdminTableController@tables')->name('admin.table.index');
    Route::get('/admin/settings', 'AdminController@settings')->name('admin.settings');
    Route::get('/admin/orders', 'AdminOrderController@orders')->name('admin.order.index');
    Route::get('/admin/users', 'AdminController@users')->name('admin.user.index');
    Route::get('/admin/permission', 'AdminController@permission')->name('admin.permission.index');
    Route::get('/admin/role', 'AdminController@role')->name('admin.role.index');
    Route::get('/admin/checkout', 'AdminCheckoutController@checkout')->name('admin.checkout.index');
});


