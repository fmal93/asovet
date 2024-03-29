<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// List Products
Route::get('products', 'Api\ProductController@index');
Route::get('categories', 'Api\CategoryController@index');
Route::get('types', 'Api\TypeController@index');
Route::get('Brands', 'Api\BrandController@index');
Route::get('regiones', 'Api\RegioneController@index');

//List single Product
Route::get('product/{id}', 'Api\ProductController@show');
Route::get('comunas/{id}', 'Api\ComunaController@index');

