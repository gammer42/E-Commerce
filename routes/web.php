<?php
//
///*
//|--------------------------------------------------------------------------
//| Web Routes
//|--------------------------------------------------------------------------
//|
//| Here is where you can register web routes for your application. These
//| routes are loaded by the RouteServiceProvider within a group which
//| contains the "web" middleware group. Now create something great!
//|
//*/
//
Auth::routes(['verify' => true]);
//
Route::group(['middleware' => ['web', 'auth', 'verified']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
});
//
//
//
////Frontend.................>
//
//
Route::group(['middleware' => ['web', 'guest']], function () {
    //
    Route::get('/', 'GuestController@index')->name('index');
    Route::get('/404', 'VoidController@un_404')->name('404');
    //    Route::get('/blog', 'blogController@index')->name('blog');
    //    Route::get('/blog-single', 'singleblogController@index')->name('blog-single');
    //    Route::get('/contact-us', 'ContactController@index' )->name('contact-us');
    //    Route::get('/product-details', 'productController@index')->name('product-details');
    //    Route::get('/shop','shopController@index' )->name('shop');
    //    Route::get('unavailable','VoidController@unavailable' )->name('unavailable');
    //
});
//
//Route::group(['middleware' => ['web','auth']], function (){
//
//    Route::get('/dashboard','SuperAdminController@index')->name('admin.dashboard');
//
//});
//
////Admin......................>
//
//
////Category...................>
//
//
//Route::post('category/save_category','CategoryController@save_category')->name('save_category');
//Route::post('category/update_category/{id}','CategoryController@update_category')->name('update_category');
//Route::get('add_category','CategoryController@add_category' )->name('add_category');
//Route::get('category','CategoryController@all_category' )->name('category');
//Route::get('category/edit_category/{id}','CategoryController@edit_category')->name('edit_category');
//Route::get('category/active_category/{id}','CategoryController@active_category')->name('active_category');
//Route::get('category/inactive_category/{id}','CategoryController@inactive_category')->name('inactive_category');
//Route::get('category/delete_category/{id}','CategoryController@delete_category')->name('delete_category');
//
//
////Manufacture................>
//
//Route::post('manufacture/save_manufacture','ManufactureController@save_manufacture')->name('save_manufacture');
//Route::post('manufacture/update_manufacture/{manufacture_id}','ManufactureController@update_manufacture')->name('update_manufacture');
//Route::get('add_manufacture','ManufactureController@add_manufacture')->name('add_manufacture');
//Route::get('manufacture','ManufactureController@all_manufacture')->name('manufacture');
//Route::get('manufacture/inactive_manufacture/{manufacture_id}','ManufactureController@inactive_manufacture')->name('inactive_manufacture');
//Route::get('manufacture/active_manufacture/{manufacture_id}','ManufactureController@active_manufacture')->name('active_manufacture');
//Route::get('manufacture/edit_manufacture/{manufacture_id}','ManufactureController@edit_manufacture')->name('edit_manufacture');
//Route::get('manufacture/delete_manufacture/{manufacture_id}','ManufactureController@delete_manufacture')->name('delete_manufacture');
//
//
//
////Products...................>
//
//Route::get('product','ProductController@all_product')->name('product');
//Route::post('product/save_product','ProductController@store')->name('save_product');
//Route::get('add_product','ProductController@add_product')->name('add_product');
//Route::get('product/deactivate_product/{id}','ProductController@deactivate_product')->name('deactivate_product');
//Route::get('product/deactivate_slider/{id}','ProductController@deactivate_slider')->name('deactivate_slider');
//Route::get('product/activate_product/{id}','ProductController@activate_product')->name('activate_product');
//Route::get('product/activate_slider/{id}','ProductController@activate_slider')->name('activate_slider');
//Route::get('product/edit_product/{id}','ProductController@edit_product')->name('edit_product');
//Route::post('product/update_product/{id}','ProductController@update_product')->name('update_product');
//Route::get('product/delete_product/{id}','ProductController@delete_product')->name('delete_product');
//
////Product >> HomeController................>
//
Route::get('product/view_product/{id}', 'HomeController@view_product')->name('view_product');
//
//
//
////Product via Category & Manufacture........>
Route::get('category/show_category/{id}', 'HomeController@show_category')->name('show_category');
Route::get('manufacture/show_manufacture/{manufacture_id}', 'HomeController@show_manufacture')->name('show_manufacture');
//
//
//
////Cart.......................>
//
//Route::get('/cart','CartController@index')->name('cart');
Route::post('/add_to_cart/{id}', 'CartController@add_to_cart')->name('add_to_cart');
//Route::get('/cart/delete/{rowId}','CartController@delete')->name('delete');
//Route::post('/cart/update','CartController@update')->name('update_cart');
//
////Checkout...................>
//
//Route::post('/log_check/','CheckoutController@log_check')->name('log_check');
//Route::post('/checkout/login/','CheckoutController@newcustomer')->name('newcustomer');
//Route::post('/checkout000/','CheckoutController@save_shipping_address')->name('save_shipping_address');
//Route::get('/checkout','CheckoutController@index')->name('checkout');
//
//
////Payment....................>
//
//Route::get('/payment','CheckoutController@payment')->name('payment');
//
//// 404.....................>
//
