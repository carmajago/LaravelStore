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

Route::get('/', 'HomeController@home')->name('home');;



Route::get('/users', 'UserController@index')->name('users.index');
Route::get('/users/create', 'UserController@create')->name('users.create');
Route::post('/users', 'UserController@store')->name('users.store');
Route::get('/users/{id}', 'UserController@show')->name('users.show');
Route::get('/users/edit/{id}', 'UserController@edit')->name('users.edit');
Route::patch('/users/update/{id}', 'UserController@update')->name('users.update');
Route::delete('/users/{id}', 'UserController@destroy')->name('users.destroy');

Route::get('login', 'Auth\LoginController@showLoginForm')
       ->name('login');

Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');


//Products

Route::get('/products', 'ProductController@index')->name('products.index');
Route::get('/products/create', 'ProductController@create')->name('products.create');
Route::post('/products', 'ProductController@store')->name('products.store');
Route::get('/products/{id}', 'ProductController@show')->name('products.show');
Route::get('/products/edit/{id}', 'ProductController@edit')->name('products.edit');
Route::patch('/products/update/{id}', 'ProductController@update')->name('products.update');
Route::delete('/products/{id}', 'ProductController@destroy')->name('products.destroy');

// providers
Route::get('/providers', 'ProviderController@index')->name('providers.index');
Route::get('/providers/create', 'ProviderController@create')->name('providers.create');
Route::get('/providers/{id}', 'ProviderController@show')->name('providers.show');
Route::post('/providers', 'ProviderController@store')->name('providers.store');
Route::delete('/providers/{id}', 'ProviderController@destroy')->name('providers.destroy');


// clients
Route::get('/clients', 'ClientController@index')->name('clients.index');
Route::get('/clients/create', 'ClientController@create')->name('clients.create');
Route::post('/clients', 'ClientController@store')->name('clients.store');
Route::get('/clients/{id}', 'ClientController@show')->name('clients.show');
Route::get('/clients/edit/{id}', 'ClientController@edit')->name('clients.edit');
Route::patch('/clients/update/{id}', 'ClientController@update')->name('clients.update');
Route::delete('/clients/{id}', 'ClientController@destroy')->name('clients.destroy');


// clients
Route::get('/sales', 'SaleController@index')->name('sales.index');
Route::post('/sales', 'SaleController@store')->name('sales.store');
Route::get('/sales/edit/{id}', 'SaleController@edit')->name('sales.edit');
Route::patch('/sales/update/{id}', 'SaleController@update')->name('sales.update');
Route::delete('/sales/{id}', 'SaleController@destroy')->name('sales.destroy');

Route::get('/sales/create/1', 'SaleController@findClient')->name('sales.create1');
Route::post('/sales/create/2', 'SaleController@newclient')->name('sales.create2');
Route::post('/sales/create/3', 'SaleController@store')->name('sales.store');
Route::get('/sales/{id}', 'SaleController@show')->name('sales.show');
Route::get('/sales/create/3/{id}', 'SaleController@create')->name('sales.create');
Route::get('/sales/add_product/{id}', 'SaleController@addProduct')->name('sales.addProduct');
Route::post('/sales/store_product', 'SaleController@storeProductDetail')->name('sales.storeProduct');

Route::get('/provider_payment/create/{id}', 'ProviderPaymentController@create')->name('providerPayment.create');
Route::post('/provider_payment/store', 'ProviderPaymentController@store')->name('providerPayment.store');

Route::get('/client_payment/create/{id}', 'ClientPaymentController@create')->name('clientPayment.create');
Route::post('/client_payment/store', 'ClientPaymentController@store')->name('clientPayment.store');
Route::post('/sales/update_credit', 'SaleController@updateCredit')->name('sales.updateCredit');

Route::get('/sales_return/create/{id}', 'SalesReturnController@create')->name('salesReturn.create');
Route::post('/sales_return/store', 'SalesReturnController@store')->name('salesReturn.store');

Route::get('/low_products/create/{id}', 'LowProductController@create')->name('lowProducts.create');
Route::get('/low_products', 'LowProductController@index')->name('lowProducts.index');
Route::post('/low_products/store', 'LowProductController@store')->name('lowProducts.store');
