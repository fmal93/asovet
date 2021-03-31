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

Route::get('/', 'HomeController@index')->name('Inicio');
Route::get('/contacts', 'HomeController@contacts')->name('contacts');
Route::post('/send-message', 'HomeController@getSendMessage')->name('msgSend');

Route::get('/tienda', 'TiendaController@index')->name('tienda.index');
Route::get('/tienda/{id}', 'TiendaController@show')->name('tienda.show');

Route::get('/carrito', 'CartController@index')->name('cart.index');
Route::get('/add-to-cart/{id}', 'CartController@getAddToCart')->name('cart.add');
Route::get('/remove/{id}', 'CartController@getRemoveItem')->name('cart.remove');
Route::get('/update-cart', 'CartController@getupdateItem')->name('cart.update');
Route::get('/add-many', 'CartController@getAddManyItem')->name('cart.addMany');
Route::get('/get-discount', 'CartController@getDiscountItems')->name('cart.discountItems');

Route::post('/checkout', 'CheckoutController@getCheckout')->name('checkout');
Route::get('/checkout-form', 'CheckoutController@getCheckoutForm')->name('checkoutForm');
Route::post('/checkout-return', 'CheckoutController@getReturnCheckout')->name('checkoutReturn');
Route::post('/checkout-final', 'CheckoutController@getFinalCheckout')->name('checkoutFinal');

Route::get('/busqueda', 'SearchController@index')->name('Search');




Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
