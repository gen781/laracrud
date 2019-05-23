<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => 'api',], function () {
    Route::get('customer', 'CustomerController@apiIndex')->name('customer.apiIndex');
    Route::post('customer', 'CustomerController@apiStore')->name('customer.apiStore');
    Route::get('customer/{id}', 'CustomerController@apiShow')->name('customer.apiShow');
    Route::patch('customer/{id}', 'CustomerController@apiUpdate')->name('customer.apiUpdate');
    Route::delete('customer/{id}', 'CustomerController@apiDestroy')->name('customer.apiDestroy');
});
