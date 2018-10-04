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

// Route::get('/home', function () { return view('welcome'); });

Route::get('/', 'AdminsController@index')->name('home');

Route::post('/register', 'AdminsController@register');

Route::get('/register', 'AdminsController@registration');

Route::post('/', 'AdminsController@store');

Route::get('/dashboard', 'AdminsController@dashboard');

Route::get('/show', 'AdminsController@show');

Route::post('/save', 'AdminsController@save');

Route::get('/total', 'AdminsController@total');

Route::post('/showstats', 'AdminsController@display');

Route::get('/logout', 'AdminsController@destroy'); 

Route::get('/addproduct', 'AddProductsController@index');

Route::post('/addproduct', 'AddProductsController@store');

Route::get('/showproducts', 'AddProductsController@show');

Route::get('/manageuser', 'ManageUsersController@show');

Route::get('/manageuser/{id?}/edit', 'ManageUsersController@edit');

Route::post('/manageuser/{id?}/edit', 'ManageUsersController@update');

//Route::post('/', 'AddProduct@store');


//Route::get('/showstats', 'AdminsController@display');
// Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');
