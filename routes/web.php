<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin','namespace' =>'Admin'], function () {
   Route::group(['prefix' => 'category'], function () {
        Route::get('/','CategoryController@index')->name('admin.category.index');
        Route::get('create','CategoryController@create')->name('admin.category.create');
        Route::post('store','CategoryController@store')->name('admin.category.store');
        Route::get('show','CategoryController@show')->name('admin.category.show');
        Route::post('update','CategoryController@update')->name('admin.category.update');
        Route::post('destroy','CategoryController@destroy')->name('admin.category.destroy');
        Route::post('active', 'CategoryController@changeActive')->name('admin.category.active');
        Route::post('postion', 'CategoryController@changePostion')->name('admin.category.postion');
   });
   Route::group(['prefix' => 'blog'], function () {
        Route::get('/','BlogController@index')->name('admin.blog.index');
        Route::get('create','BlogController@create')->name('admin.blog.create');
        Route::post('store','BlogController@store')->name('admin.blog.store');
        Route::get('show','BlogController@show')->name('admin.blog.show');
        Route::post('update','BlogController@update')->name('admin.blog.update');
        Route::post('delete','BlogController@destroy')->name('admin.blog.destroy');
         Route::post('active', 'BlogController@changeActive')->name('admin.blog.active');
   });

    Route::group(['prefix' => 'catblog'], function () {
            Route::get('/','CategoryPostController@index')->name('admin.catblog.index');
            Route::get('create','CategoryPostController@create')->name('admin.catblog.create');
            Route::post('store','CategoryPostController@store')->name('admin.catblog.store');
            Route::get('show','CategoryPostController@show')->name('admin.catblog.show');
            Route::post('update','CategoryPostController@update')->name('admin.catblog.update');
            Route::post('delete','CategoryPostController@destroy')->name('admin.catblog.destroy');
            Route::post('active', 'CategoryPostController@changeActive')->name('admin.catblog.active');
    });
    Route::group(['prefix' => 'calendar'], function () {
        Route::get('/test','CalendarController@test')->name('admin.calendar.test');
        Route::get('/','CalendarController@index')->name('admin.calendar.index');
        Route::get('create','CalendarController@create')->name('admin.calendar.create');
        Route::post('store','CalendarController@store')->name('admin.calendar.store');
        Route::get('show','CalendarController@show')->name('admin.calendar.show');
        Route::post('update','CalendarController@update')->name('admin.calendar.update');
        Route::post('delete','CalendarController@destroy')->name('admin.calendar.destroy');
        Route::post('active', 'CalendarController@changeActive')->name('admin.calendar.active');
   });
    Route::group(['prefix' => 'qrcode'], function () {
        Route::get('/','Login2FaController@index')->name('admin.qrcode.index');
        Route::get('/login','Login2FaController@login')->name('admin.qrcode.login');
    });
    Route::group(['prefix' => 'role'], function () {
        Route::get('/','RoleController@perMission')->name('admin.qrcode.index');
        Route::get('/login','Login2FaController@login')->name('admin.qrcode.login');
    });

});

Auth::routes();

Route::get('/home', 'RoleController@perMisstion')->name('role.permisstion');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


// Route::group(['prefix' => ['shopping']], function () {
//     Route::get('add/{id}', 'CartController@addProduct')->name('add.shopping.cart');
//     Route::get('danh-sach', 'CartController@getListShoppingCart')->name('get.list.cart');
//     Route::get('delete/{id}', 'CartController@deleteItemShoppingCart')->name('get.delete.tiem.cart');
// });

// Route::group(['prefix' => ['gio-hang']], function () {
//     Route::get('thanh-toan', 'CartController@getFormPay')->name('add.shopping.pay');
//    // Route::get('/danh-sach', 'CartController@getListShoppingCart')->name('get.list.cart');
// });
