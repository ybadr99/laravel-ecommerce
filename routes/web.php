<?php



Route::get('/','LandingPageController@index')->name('landing-page');

//shop and product
Route::get('/shop','ShopController@index')->name('shop');
Route::get('/shop/{product}','ShopController@show')->name('shop.show');
Route::view('/product', 'product');

//shopping-cart
Route::get('/cart', 'CartController@index')->name('cart.index');
Route::post('/cart', 'CartController@store')->name('cart.store');
Route::delete('/cart/{id}', 'CartController@destroy')->name('cart.destroy');
Route::post('/cart/{id}', 'CartController@savelater')->name('cart.savelater');

Route::delete('/savelater/{id}', 'SavelaterController@destroy')->name('savelater.destroy');
Route::post('/savelater/{id}', 'SavelaterController@movetocart')->name('savelater.movetocart');

Route::get('/empty', function(){
    Cart::instance('savelater')->destroy();
});

// Route::view('/test', 'test');
Route::view('/thankyou', 'thankyou');
