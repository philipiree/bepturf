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

use Gloudemans\Shoppingcart\Facades\Cart;

Route::get('/', function () {
    return view('welcome');
});


Route::group(['middleware' => ['auth','admin']], function () {

    Route::get('/dashboard', function () {
    return view('admin.dashboard');
    });

    //registered users & role assignments
    Route::get('/role-register', 'Admin\DashboardController@registered');
    Route::get('/role-edit/{id}','Admin\DashboardController@edit');
    Route::put('/role-register-update/{id}','Admin\DashboardController@update');
    Route::delete('/role-delete/{id}','Admin\DashboardController@delete');
    //product routes resources
    Route::get('/listedproducts', 'ProductsController@index');
    Route::get('/create-product','ProductsController@create');
    Route::get('/edit-product/{id}','ProductsController@edit');
    Route::delete('/delete-product/{id}','ProductsController@destroy');
    Route::resource('product', 'ProductsController');
    Route::get('/listedproducts/{id}', 'ProductsController@show');
    //categories routes
    Route::get('/categories-create','CategoriesController@create');
    Route::delete('/categories-delete/{id}','CategoriesController@destroy');
    Route::put('/categories-update/{id}','CategoriesController@update');
    Route::get('/categories', 'CategoriesController@index');
    Route::get('/categories-edit/{id}','CategoriesController@edit');
    Route::resource('category', 'CategoriesController');
    //order routes
    Route::get('/orders', 'OrdersController@index');
    Route::get('/orders-edit/{id}','OrdersController@edit');
    /*examples*/

    //Route::resource('category', 'CategoryController', ['except' => ['create']]);
    //Route::resource('category', 'CategoryController', ['only' => ['create', 'index']]);
});

    //Route::get('/listedproducts/{id}', 'ProductsController@show');

    //route for products display
    Route::get('/collections', 'ProductsController@viewer')->name('pages.collections');
    Route::get('/collections/{id}', 'ProductsController@display')->name('pages.display');
    //Route::get('/collections/categories/{categories}', 'CategoriesController@index');
    Auth::routes();
    Route::get('/home', 'HomeController@index')->name('home');

    /** cart controllers */
    Route::get('/cart', 'CartController@index')->name('cart.index')->middleware();
    Route::post('/cart', 'CartController@store')->name('cart.store');
    Route::delete('/cart/{id}', 'CartController@destroy')->name('cart.destroy');
    Route::patch('/cart/{id}', 'CartController@update')->name('cart.update');

    /**checkout controllers */
    Route::get('/checkout', 'CheckoutController@index')->name('checkout.index');
    Route::post('/checkout', 'CheckoutController@store')->name('checkout.store');

    /*Route::get('empty', function(){
        Cart::destroy();
    });*/

