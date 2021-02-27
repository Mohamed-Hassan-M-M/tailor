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
Route::get('testad', function () {
    return view('dashboard.auth.login');
});
Route::group(['middleware'=>'auth:admin'],function(){
    Route::get('/','DashboardController@index')->name('dashboard');
    Route::get('/logout','LoginController@logout')->name('admin.logout');

    Route::resource('main-category', 'MainCategoryController');
    Route::resource('sub-category', 'SubCategoryController');
    Route::resource('categorylevel2', 'CategoryL1Controller');
    Route::resource('categorylevel3', 'CategoryL2Controller');
    Route::resource('product', 'ProductController');
    Route::resource('brand', 'BrandController');
    Route::resource('size', 'SizeController');
    Route::resource('color', 'ColorController');
    Route::resource('customer', 'CustomerController');
    Route::resource('order', 'OrderController');

});
Route::group(['middleware'=>'guest:admin', 'namespace'=>'Auth'],function(){
    Route::get('/login','LoginController@getlogin')->name('admin.getlogin');
    Route::post('/login','LoginController@dologin')->name('admin.dologin');
});


