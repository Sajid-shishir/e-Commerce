<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
Route::get('report', 'HomeController@report')->name('report');
// Route::resource('test','TestController');
Route::resource('category','CategoryController');
Route::resource('product','ProductController');
Route::resource('coupon','CouponController');

Route::get('home/customer','CustomerController@homecustomer')->name('home.customer');
Route::get('order/download/{order_id}','CustomerController@orderdownload');
Route::post('add/review','CustomerController@addreview');

Route::get('register/github','GithubController@redirectToProvider');
Route::get('register/github/callback','GithubController@handleProviderCallback');
Route::get('register/google','GoogleController@redirectToProvider');
Route::get('register/google/callback','GoogleController@handleProviderCallback');

Route::post('add/to/cart','CartController@addtocart');
Route::get('delete/from/cart/{cart_id}','CartController@deletefromcart');
Route::get('cart','CartController@cart');
Route::post('update/cart','CartController@updatecart');
Route::get('cart/{coupon_name}','CartController@cart');

Route::post('checkout','CheckoutController@index');
Route::get('checkout','CheckoutController@index');
Route::post('checkout/post','CheckoutController@checkoutpost');
//payments
Route::get('stripe','StripePaymentController@stripe');
Route::post('stripe','StripePaymentController@stripePost')->name('stripe.post');
// Route::get('payment','CheckoutController@checkout');
// Route::post('payment','CheckoutController@afterpayment')->name('frontend.onlinepayment');

//ajax Request
Route::post('get/city/list', 'CheckoutController@getcitylist');
//Roles
Route::get('manage/role', 'RoleController@managerole')->name('manage.role');
Route::post('manage/role', 'RoleController@roleadd')->name('role.add');
Route::post('role/assign', 'RoleController@roleassign')->name('role.assign');
Route::get('role/permission/edit/{user_id}', 'RoleController@role_permission_edit')->name('role.permission.edit');
Route::post('role/permission/edit/post', 'RoleController@role_permission_edit_post')->name('role.permission.edit.post');
//Bkash Payment


