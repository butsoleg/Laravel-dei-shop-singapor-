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
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/select/experience/{id}', 'HomeController@select_experience')->name('select_experience');
Route::get('/', function ()
{
    return redirect('/home');
});

Route::get('/privacy-policy', 'HomeController@privacy')->name('privacy');
Route::get('/terms-and-conditions', 'HomeController@terms')->name('terms');

Route::get('/myprofile', 'HomeController@get_profile')->name('myprofile');
Route::get('/about_us', 'HomeController@about_us')->name('about_us');
Route::get('/contact_us', 'HomeController@contact_us')->name('contact_us');
Route::get('/gift_certificates', 'HomeController@gift_certificates')->name('gift_certificates');
Route::get('/faq', 'HomeController@faq')->name('faq');
Route::get('/vendor_register', 'HomeController@vendor_register')->name('vendor_register');

Route::post('/email_send', 'HomeController@email_send')->name('email_send');
Route::post('/newsletter_signup', 'HomeController@newsletter_signup')->name('newsletter_signup');

Route::get('/faq/registration', 'HomeController@faq_registration')->name('faq.registration');
Route::get('/faq/account_related', 'HomeController@faq_account_related')->name('faq.account_related');
Route::get('/faq/payment', 'HomeController@faq_payment')->name('faq.payment');
Route::get('/faq/delivery_related', 'HomeController@faq_delivery_related')->name('faq.delivery_related');
Route::get('/faq/order_related', 'HomeController@faq_order_related')->name('faq.order_related');
Route::get('/faq/customer_related', 'HomeController@faq_customer_related')->name('faq.customer_related');
Route::get('/faq/how_does_it_work', 'HomeController@faq_how_does_it_work')->name('faq.how_does_it_work');
Route::get('/faq/others', 'HomeController@faq_others')->name('faq.others');

// Route::get('/change_password', function () {
//     return view('change_password');
// });
Route::get('/product/{id}', 'ProductController@index')->name('product_detail');
Route::get('/get_products', 'ProductController@get_products')->name('get_products');
Route::get('/cart', 'CartController@index')->name('cart');
Route::post('cart/add', 'CartController@add_product')->name('add_product');
Route::post('/cart/add', 'CartController@add_product')->name('add_product');
Route::post('/cart/update', 'CartController@update_product')->name('update_product');
Route::post('/cart/delete', 'CartController@delete_product')->name('delete_product');
// Route::get('/my_address', function () {
//     return view('my_address');
// });
// Route::get('/saved_cards', function () {
//     return view('saved_cards');
// });

Route::get('/order_list/', 'OrderController@index')->name('order_list');
Route::get('/search', 'ProductController@search')->name('search');
Route::get('/checkout', 'CheckoutController@index')->name('checkout');
Route::post('/checkout/run', 'CheckoutController@do_checkout')->name('do_checkout');
Route::get('/checkout/success', 'CheckoutController@success')->name('success');
Route::post('/apply/promocode', 'CheckoutController@promotion')->name('promotion');
Route::get('/get_cards', 'CheckoutController@get_cards')->name('get_cards');
Route::get('/get_addresses', 'CheckoutController@get_addresses')->name('get_addresses');
Route::post('/product/pagination', 'ProductController@ajax_pagination')->name('ajax_pagination');

Route::get('/merchant/{id}', 'HomeController@merchant')->name('merchant');
Route::get('/category/{id}', 'CategoryController@index')->name('category');
Route::get('/brand/{id}', 'BrandController@index')->name('brand');

Route::post('/autocomplete', 'SearchController@index')->name('autocomplete');
Route::post('autocomplete', 'SearchController@index')->name('autocomplete');

Auth::routes();

// Route::group(['middleware' => ['web', 'custom_auth']], function () {
    Route::get('/get_card', 'HomeController@get_card')->name('get_card');
    Route::get('/get_profile', 'HomeController@get_profile')->name('get_profile');
    Route::get('/change_password', 'HomeController@change_password')->name('change_password');
    Route::post('/change_userpassword', 'HomeController@change_userpassword')->name('change_userpassword');
    Route::post('/update_profile', 'HomeController@update_profile')->name('update_profile');
    Route::post('/upload_image', 'HomeController@upload_image')->name('upload_image');
    Route::get('/logoutuser', 'Auth\LoginController@logoutuser')->name('logoutuser');
    Route::get('/logout', 'Auth\LoginController@logoutuser')->name('logoutuser');
    Route::post('/reset_password', 'Auth\ResetPasswordController@reset_password')->name('reset_password');


   Route::get('/saved_cards', 'CardController@index')->name('saved_cards');
    Route::post('/create_card', 'CardController@create')->name('create_card');
    Route::get('/edit_card/{id}', 'CardController@edit')->name('edit_card');
    Route::post('/update_card', 'CardController@update')->name('update_card');
    Route::get('/delete_card/{id}', 'CardController@delete')->name('delete_card');


    Route::get('/my_address', 'AddressController@index')->name('my_address');
    Route::post('/create_address', 'AddressController@create')->name('create_address');
    Route::get('/edit_address/{id}', 'AddressController@edit')->name('edit_address');
    Route::post('/update_address', 'AddressController@update')->name('update_address');
    Route::get('/delete_address/{id}', 'AddressController@delete')->name('delete_address');


    Route::get('/login/facebook', 'Auth\LoginController@redirectToProvider'); // Login with facebook
    Route::get('/login/facebook/callback', 'Auth\LoginController@handleProviderCallback'); // facebook return
    Route::get('/login/google', 'Auth\LoginController@redirectToProvider'); // Login with facebook
    Route::get('/login/google/callback', 'Auth\LoginController@handleProviderCallback'); // facebook return
// });
