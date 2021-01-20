<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'FrontendController@index');
Route::get('/contact', 'FrontendController@contact');
Route::get('/about', 'FrontendController@about');
Route::get('/faq', 'FrontendController@faq');
Route::get('/shop', 'FrontendController@shop');
Route::get('/search', 'FrontendController@search');

Auth::routes(['verify' => true]);


Route::get('/home', 'HomeController@index')->name('home');
Route::get('edit/User/profile', 'HomeController@edit_profile')->name('edit_profile');
Route::post('change/password', 'HomeController@change_password')->name('change_password');


Route::resource('test','TestController');
Route::resource('category','CategoryController');
Route::resource('product','ProductController');
Route::resource('coupon','CouponController');

Route::get('home/customer', 'CustomerController@homecustomer');
Route::get('order/download/{order_id}', 'CustomerController@orderdownload');
Route::post('add/review', 'CustomerController@addreview');

Route::get('register/github', 'GithubController@redirectToProvider');
Route::get('register/github/callback', 'GithubController@handleProviderCallback');
Route::get('register/google', 'GoogleController@redirectToProvider');
Route::get('register/google/callback', 'GoogleController@handleProviderCallback');
Route::post('add/to/cart', 'CartController@addtocart');
Route::get('delete/from/cart/{cart_id}', 'CartController@deletefromcart');
Route::get('cart', 'CartController@cart');
Route::post('update/cart', 'CartController@updatecart');
Route::get('cart/{coupon_name}', 'CartController@cart');
Route::post('checkout', 'CheckoutController@index');
Route::post('checkout/post', 'CheckoutController@checkoutpost');


// Route::get('stripe', 'StripePaymentController@stripe');
// Route::post('stripe', 'StripePaymentController@stripePost')->name('stripe.post');
Route::get('stripe','StripePaymentController@stripe');
Route::post('stripe','StripePaymentController@stripePost')->name('stripe.post');

// Route::get('payment','CheckoutController@checkout');
// Route::post('payment','CheckoutController@afterpayment')->name('frontend.onlinepayment');

//ajax Request
Route::post('get/city/list', 'CheckoutController@getcitylist');



