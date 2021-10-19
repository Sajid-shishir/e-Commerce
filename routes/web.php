<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SslCommerzPaymentController;
// use App\Http\Controllers\vendor\Chatify\MessagesController;



Route::get('/', 'FrontendController@index');
Route::get('/contact', 'FrontendController@contact');
Route::get('/about', 'FrontendController@about');
//FAQ
Route::get('/faq', 'FrontendController@faq');
Route::get('/faq_post', 'FrontendController@faq_post')->name('faq_post');
Route::post('/faq_add', 'FrontendController@faq_add')->name('faq_add');
Route::get('/faq_delete/{faq_id}', 'FrontendController@faq_delete');
Route::get('/faq_edit/{faq_id}', 'FrontendController@faq_edit');
Route::post('/faq_edit_post', 'FrontendController@faq_edit_post')->name('faq_edit_post');

Route::get('blog', 'BlogController@index')->name('blog');
Route::get('blog_post', 'BlogController@blog_post')->name('blog_post');
Route::post('blog_add', 'BlogController@blog_add')->name('blog_add');
Route::get('blog_show/{blog_id}', 'BlogController@blog_show')->name('blog_show');
Route::get('blog_delete/{blog_id}', 'BlogController@blog_delete');
Route::get('blog_edit/{blog_id}', 'BlogController@blog_edit');
Route::post('blog_edit_post', 'BlogController@blog_edit_post')->name('blog_edit_post');

Route::get('/shop', 'FrontendController@shop');
Route::get('/search', 'FrontendController@search');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('edit/User/profile', 'HomeController@edit_profile')->name('edit_profile');
Route::post('change/password', 'HomeController@change_password')->name('change_password');

Route::get('report', 'ReportController@report')->name('report');
Route::get('check/report', 'ReportController@checkReport')->name('check.report');
Route::get('check/report/from', 'ReportController@checkReportFrom')->name('check.report.from');


// Route::resource('test','TestController');
Route::resource('category','CategoryController');
Route::resource('product','ProductController');
Route::resource('coupon','CouponController');

Route::get('home/customer','CustomerController@homecustomer')->name('home.customer');
Route::get('order/download/{order_id}','CustomerController@orderdownload');
Route::post('add/review','CustomerController@addreview')->name('add.review');

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
Route::post('get/city', 'SslCommerzPaymentController@getcity');
//Roles
Route::get('manage/role', 'RoleController@managerole')->name('manage.role');
Route::post('manage/role', 'RoleController@roleadd')->name('role.add');
Route::post('role/assign', 'RoleController@roleassign')->name('role.assign');
Route::get('role/permission/edit/{user_id}', 'RoleController@role_permission_edit')->name('role.permission.edit');

Route::post('role/permission/edit/post', 'RoleController@role_permission_edit_post')->name('role.permission.edit.post');
// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::post('/sslPayout', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);
Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
// SSLCOMMERZ End
//Blog

