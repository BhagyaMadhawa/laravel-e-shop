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

Route::get('/', function () {
    return view('welcome');
});

Route::get('products', ['uses' => 'ProductsController@index', 'as'=>'allProducts']);

Route::get('product/addToCart/{id}', ['uses' => 'ProductsController@addProductToCart','as'=>'AddToCartProduct']);

Route::get('cart', ['uses' => 'ProductsController@showCart', 'as'=>'cartproducts']);

Route::get('product/deleteItemFromCart/{id}', ['uses' => 'ProductsController@deleteItemFromCart','as'=>'DeleteItemFromCart']);

Route::post('product/createNewOrder/', ['uses' => 'ProductsController@createNewOrder', 'as'=>'createNewOrder']);

Route::get('checkoutProducts/', ['uses' => 'ProductsController@checkoutProducts', 'as'=>'checkoutProducts']);

Route::get('showPaymentPage/', ['uses' => 'PaymentsController@showPaymentPage', 'as'=>'showPaymentPage']);

Route::post('paymentReceipt/{order_id}', ['uses' => 'PaymentsController@paymentReceipt', 'as'=>'paymentReceipt']);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//Admin Panel
Route::get('admin/products', ['uses' => 'Admin\AdminProductsController@index', 'as'=>'adminDisplayProducts'])->middleware('restrictToAdmin');

Route::get('admin/users', ['uses' => 'Admin\AdminUsersController@index', 'as'=>'viewUsers'])->middleware('restrictToAdmin');

Route::get('admin/orders', ['uses' => 'Admin\AdminProductsController@orders', 'as'=>'viewOrders'])->middleware('restrictToAdmin');

Route::get('admin/logout', ['uses' => 'Admin\AdminUsersController@logout', 'as'=>'logout']);

Route::get('admin/editProductForm/{id}', ['uses' => 'Admin\AdminProductsController@editProductForm', 'as'=>'adminEditProductForm']);

Route::get('admin/editProductImageForm/{id}', ['uses' => 'Admin\AdminProductsController@editProductImageForm', 'as'=>'adminEditProductImageForm']);

Route::post('admin/updateProductImage/{id}', ['uses' => 'Admin\AdminProductsController@updateProductImage', 'as'=>'adminUpdateProductImage']);

Route::post('admin/updateProduct/{id}', ['uses' => 'Admin\AdminProductsController@updateProduct', 'as'=>'adminUpdateProduct']);

Route::get('admin/createProductForm', ['uses' => 'Admin\AdminProductsController@createProductForm', 'as'=>'adminCreateProductForm']);

Route::post('admin/insertProduct/', ['uses' => 'Admin\AdminProductsController@insertProduct', 'as'=>'adminInsertProduct']);

Route::get('admin/deleteProduct/{id}', ['uses' => 'Admin\AdminProductsController@deleteProduct', 'as'=>'adminDeleteProduct']);
