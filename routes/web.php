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

Route::get('testwb', function () {
    return view('welcome');
});

Route::group(['middleware'=>'auth:web'],function(){

});

Route::group(['middleware'=>'guest:web'],function(){
    Route::get('/','WebsiteController@index')->name('website');
    Route::get('/category/{l1catID}','WebsiteController@showCategory')->name('show.category');
    Route::group(['namespace'=>'Auth'], function (){

    });
});
