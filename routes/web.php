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
            route::get('delete/{offer_id}','OfferController@delete')->name('offer.delete');
            route::get('all','OfferController@getAllOffers')->name('offers.all');
            });

            route::get('youtube','OfferController@getviewer');
});

/// Begin ajax Route 

Route::group(['prefix'=>'ajax-offers'],function()
{

    route::get('create','AjaxController@create');
    route::post('store','AjaxController@store')->name('ajax.offers.store');
    route::get('all','AjaxController@all')->name('ajax.offers.all');
    route::post('delete','AjaxController@delete')->name('ajax.offers.delete');

});
