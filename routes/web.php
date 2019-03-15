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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/products/{id}', 'ProductController@show');

Route::post('/cart', 'CartDetailController@store');
Route::delete('/cart', 'CartDetailController@destroy');
Route::post('/order', 'CartController@update');

//CR
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
});

//UD