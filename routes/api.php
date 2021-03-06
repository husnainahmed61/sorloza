<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersApiController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', 'UsersApiController@store'); // Signup
Route::post('/order','OrderController@placeOrder');  // order placing
Route::post('/userContact','UsersApiController@userContactStore');  // user contacts saving
Route::post('/allUserContact','UsersApiController@allUserContacts');  // user contacts fetch
Route::post('/userOrders','OrderController@userOrders');  // user orders fetch
Route::post('/userNotifications','UsersApiController@getUserNotifications');  // user orders fetch
Route::get('/postCardPrice','UsersApiController@getPostCardPrice');  // user orders fetch



