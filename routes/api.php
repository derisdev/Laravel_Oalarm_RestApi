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


Route::group(['prefix' => 'v1'], function() {
    
    Route::resource('datapasien', 'DataPasienController', [
        'except' => ['create', 'edit']
    ]);
    
    Route::resource('jadwalminum', 'JadwalMinumController', [
        'except' => ['create', 'edit']
    ]);

    Route::resource('jadwalobat', 'JadwalObatController', [
        'except' => ['create', 'edit']
    ]);
    
    
    Route::get('/datapasien/datawith/data', [
        'uses' => 'DataPasienController@getall'
    ]);
    
    
    Route::post('/admin/register', [
        'uses' => 'AuthController@store'
    ]);
    

    Route::post('/admin/verify', [
        'uses' => 'AuthController@verify'
    ]);
    
    Route::post('/admin/signin', [
        'uses' => 'AuthController@signin'
    ]);
    
    Route::post('/pasien/signin', [
        'uses' => 'AuthPasienController@signin'
    ]);
    
    
});
