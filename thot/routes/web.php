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

//Route::get('/','FrontEndController@index');
//Route::prefix('admin')->middleware('admin')->group(function(){
Route::middleware('admin')->group(function(){
    Route::get('/','FrontEndController@login');
});

/*Route::middleware('admin')->group(function(){
    Route::get('/','FrontEndController@index');
});*/


//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::post('login','Auth\LoginController@login')->name('login');
