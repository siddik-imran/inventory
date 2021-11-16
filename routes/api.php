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

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

Route::apiResource('/employee', 'Api\EmployeeController');
Route::apiResource('/supplier', 'Api\SupplierController');
Route::apiResource('/category', 'Api\CategoryController');
Route::apiResource('/product', 'Api\ProductController');
Route::apiResource('/customer', 'Api\CustomerController');
Route::apiResource('/expense', 'Api\ExpenseController');

// salary payment route
Route::get('/salary', 'Api\SalaryController@allSalary');
Route::post('/salary/paid/{id}', 'Api\SalaryController@paidSalary');
Route::get('/salary/view/{id}', 'Api\SalaryController@viewSalary');
Route::get('/salary/edit/{id}', 'Api\SalaryController@editSalary');
Route::post('/salary/update/{id}', 'Api\SalaryController@updateSalary');

//stock update route
Route::post('/stock/update/{id}', 'Api\ProductController@stockUpdate');

Route::get('/getting/product/{id}', 'Api\PosController@getProduct');

//add to cart
Route::get('/add-to-cart/{id}', 'Api\CartController@cart');
Route::get('/cart/product', 'Api\CartController@cartProduct');
Route::get('/remove-cart/{id}', 'Api\CartController@removeCartProduct');
Route::get('/increment/{id}', 'Api\CartController@incrementCartItem');
Route::get('/decrement/{id}', 'Api\CartController@decrementCartItem');

// extra
Route::get('/vat', 'Api\CartController@getVat');

//order
Route::post('/order', 'Api\PosController@order');
Route::get('/orders', 'Api\OrderController@latestOrder');
Route::get('/order/orders/{id}', 'Api\OrderController@viewOrder');
Route::get('/order/order-details/{id}', 'Api\OrderController@orderDetails');
Route::post('/search-order', 'Api\OrderController@search');
