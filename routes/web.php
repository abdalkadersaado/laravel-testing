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





Auth::routes(['verify'=>true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::group(['prefix' => LaravelLocalization::setLocale(),
     'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']],
         function () {

        Route::group(['prefix'=>'offers'],function()
        {
            route::post('store','OfferController@store')->name('offer.store');
            route::get('create','OfferController@create');
            route::get('edit/{offer_id}','OfferController@edit');
            route::post('update/{offer_id}','OfferController@update')->name('offer.update');
            
            route::get('all','OfferController@getAllOffers');
            });
});
