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




route::group(['namespace' =>'Front' ,'prefix'=>'Admin', 'middleware' => 'auth'],function(){
    
    Route::get('/admin','FirstController@showadmin');
    
});
route::get('/','UserController@show');
route::get('/show','UserController@show');

route::get('/index','UserController@index');

route::resource('news','NewsController');

route::get('landing',function(){

    return view('landing');
});