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

Route::get('/', 'TestController@welcome');

Auth::routes();

//Socialite routes
Route::get('/login/redirect', 'Auth\LoginController@redirectToProvider');
Route::get('/login/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('/search', 'SearchController@show');
Route::get('/products/json', 'SearchController@data');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/products/{id}', 'ProductController@show');
Route::get('/categories/{category}', 'CategoryController@show');

Route::post('/cart', 'CartDetailController@store');
Route::delete('/cart', 'CartDetailController@destroy');
Route::post('/order', 'CartController@update');

//CRUD
Route::middleware(['auth', 'admin'])->prefix('admin')->namespace('Admin')->group(function () {
    Route::get('/products', 'ProductController@index'); //Lista de productos
    Route::get('/products/create', 'ProductController@create'); //Crear producto
    Route::post('/products', 'ProductController@store'); //guardar en db producto
    Route::get('/products/{id}/edit', 'ProductController@edit'); //Editar producto
    Route::post('/products/{id}/edit', 'ProductController@update'); //actualizar en db el producto
    Route::delete('/products/{id}', 'ProductController@destroy'); //eliminar en db el producto

    Route::get('/products/{id}/images', 'ImagesController@index'); //Listado
    Route::post('/products/{id}/images', 'ImagesController@store'); //registrar imagenes
    Route::delete('/products/{id}/images', 'ImagesController@destroy'); //eliminar en db el producto
    Route::get('/products/{id}/images/select/{img}', 'ImagesController@select'); //Destacar img

    Route::get('/categories', 'CategoryController@index');
    Route::get('/categories/create', 'CategoryController@create');
    Route::post('/categories', 'CategoryController@store'); 
    Route::get('/categories/{category}/edit', 'CategoryController@edit'); 
    Route::post('/categories/{category}/edit', 'CategoryController@update'); 
    Route::delete('/categories/{category}', 'CategoryController@destroy'); 
});