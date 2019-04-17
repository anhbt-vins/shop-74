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

/**
 * Client Zone
 */
Route::group(['namespace' => 'Client'], function() {
	Route::get('gioi-thieu', 'HomeController@about');
	Route::get('/', 'HomeController@index');
	Route::get('lien-he', 'HomeController@contact');
	Route::get('gio-hang', 'CartController@index');
	Route::get('gio-hang/thanh-toan', 'CartController@checkout');
	Route::get('gio-hang/thanh-cong', 'CartController@complete');	
	Route::get('san-pham/{id}', 'ProductController@detail');	
	Route::get('san-pham', 'ProductController@shop');
});

/**
 * Admin Zone
 */
Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function() {
	Route::group(['middleware' => 'guest'], function() {
		Route::get('/login', 'LoginController@showLoginForm');
		Route::post('/login', 'LoginController@login');
	});
	Route::group(['middleware' => 'auth'], function() {
		Route::post('/logout', 'LoginController@logout');
		 Route::get('/', 'DashboardController@index')->name('dashboard');
	//categories route
	Route::group(['prefix' => 'categories'], function() {
		Route::get('/', 'CategoryController@index')->name('category');	
		Route::get('/{category}/edit', 'CategoryController@edit');
	});
	//user route
	Route::group(['prefix' => 'user'], function() {
		Route::get('/', 'UserController@index')->name('user');
		Route::get('/create', 'UserController@create');
		Route::get('/{user}/edit', 'UserController@edit');	
	});
	//products route
	Route::group(['prefix' => 'products'], function() {
		Route::get('/', 'ProductController@index')->name('product');
		Route::get('/create', 'ProductController@create');
		Route::get('/{product}/edit', 'ProductController@edit');
	});
	//order route
	Route::group(['prefix' => 'orders'], function() {
		Route::get('/', 'OrderController@index')->name('order');
		Route::get('/processed', 'OrderController@processed');
		Route::get('/{order}/edit', 'OrderController@edit');
	});
	});
	
	//Route::post('/login', 'LoginController@postLoginForm');
});

// Route::get('time', function() {
    // $value = config(['app.timezone' => 'America/Chicago']);
    //     dd($value);
      // $a = env('DB_CONNECTION');
      // echo $a;
// });