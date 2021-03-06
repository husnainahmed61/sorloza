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
Route::get('logout','Auth\LoginController@logout');
Route::get('/signin','Auth\LoginController@loginForm');

Route::get('/dashboard', 'PagesController@index')->middleware('admin');
Route::get('/users','UsersController@show')->middleware('admin');
Route::get('/create-user','UsersController@createNewUser')->name('create-user')->middleware('admin');
Route::post('store-user','UsersController@storeNewUser')->name('store-user')->middleware('admin');
Route::get('/paid-orders','OrderController@showPaidOrders');
Route::get('/pending-payment','OrderController@showPendingPaymentOrders');
Route::get('/notifications','HomeController@addNotification');
Route::post('submitNotification','HomeController@storeNotification')->name('submitNotification');
Route::get('/orders-chart','HomeController@ordersChart')->name('orders-chart');
Route::get('/users-chart','HomeController@usersChart')->name('users-chart');
Route::get('/card','OrderController@testCreatePDF');
Route::get('/postCardPrice','HomeController@postCardPriceForm')->name('postCardPrice');
Route::post('submitPostCardPrice','HomeController@submitPostCardPrice')->name('submitPostCardPrice');

//Route::get('registerform','Auth\RegisterController@registerForm');
//Route::post('/create-user','Auth\RegisterController@create');
// Demo routes
Route::get('/datatables', 'PagesController@datatables');
Route::get('/ktdatatables', 'PagesController@ktDatatables');
Route::get('/select2', 'PagesController@select2');
Route::get('/jquerymask', 'PagesController@jQueryMask');
Route::get('/icons/custom-icons', 'PagesController@customIcons');
Route::get('/icons/flaticon', 'PagesController@flaticon');
Route::get('/icons/fontawesome', 'PagesController@fontawesome');
Route::get('/icons/lineawesome', 'PagesController@lineawesome');
Route::get('/icons/socicons', 'PagesController@socicons');
Route::get('/icons/svg', 'PagesController@svg');

// Quick search dummy route to display html elements in search dropdown (header search)
Route::get('/quick-search', 'PagesController@quickSearch')->name('quick-search');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
