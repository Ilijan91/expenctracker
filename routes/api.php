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

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::get('me', 'AuthController@me');

});

Route::resource('buyers', 'Buyer\BuyerController', ['only'=>['index','show']]);
Route::resource('buyer.transactions', 'Buyer\BuyerTransactionController', ['only'=>['index']]);
Route::resource('buyer.vendors', 'Buyer\BuyerVendorController', ['only'=>['index']]);
Route::resource('buyer.sellers', 'Buyer\BuyerSellerController', ['only'=>['index']]);
Route::resource('buyer.categories', 'Buyer\BuyerCategoryController', ['only'=>['index']]);

Route::resource('categories', 'Category\CategoryController', ['except'=>['create','edit']]);
Route::resource('category.vendors', 'Category\CategoryVendorController', ['only'=>['index']]);
Route::resource('category.sellers', 'Category\CategorySellerController', ['only'=>['index']]);
Route::resource('category.transactions', 'Category\CategoryTransactionController', ['only'=>['index']]);
Route::resource('category.buyers', 'Category\CategoryBuyerController', ['only'=>['index']]);

Route::resource('vendors', 'Vendor\VendorController', ['only'=>['index','show']]);
Route::resource('vendor.transactions', 'Vendor\VendorTransactionController', ['only'=>['index']]);
Route::resource('vendor.buyers', 'Vendor\VendorBuyerController', ['only'=>['index']]);
Route::resource('vendor.categories', 'Vendor\VendorCategoryController', ['except'=>['create','edit']]);
Route::resource('vendor.buyer.transactions', 'Vendor\VendorBuyerTransactionController', ['only'=>['store']]);

Route::resource('sellers', 'Seller\SellerController', ['only'=>['index','show']]);
Route::resource('seller.transactions', 'Seller\SellerTransactionController', ['only'=>['index']]);
Route::resource('seller.categories', 'Seller\SellerCategoryController', ['only'=>['index']]);
Route::resource('seller.buyers', 'Seller\SellerBuyerController', ['only'=>['index']]);
Route::resource('seller.vendors', 'Seller\SellerVendorController', ['except'=>['create','edit','show']]);

Route::resource('transactions', 'Transaction\TransactionController', ['only'=>['index','show']]);
Route::resource('transactions.categories', 'Transaction\TransactionCategoryController', ['only'=>['index']]);
Route::resource('transactions.seller', 'Transaction\TransactionSellerController', ['only'=>['index']]);


Route::resource('users', 'User\UserController', ['except'=>['create','edit']]);
Route::get('users/verify/{token}', 'User\UserController@verify')->name('verify');
Route::get('users/{user}/resend', 'User\UserController@resend')->name('resend');