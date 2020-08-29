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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/peternak/register', 'AuthApiController@register');
Route::post('/peternak/login', 'AuthApiController@login');
Route::get('/kelompok', 'PeternakApiController@kelompok');
Route::post('/peternak/reset', 'AuthApiController@reset');
Route::post('/peternak/firebase', 'AuthApiController@firebase');
Route::get('/peternak/profile', 'AuthApiController@profile')->middleware('auth:api');
Route::get('/peternak/update', 'AuthApiController@update')->middleware('auth:api');


Route::get('/peternak/listkandang', 'PeternakApiController@kandang')->middleware('auth:api');
Route::post('/peternak/tambahkandang', 'PeternakApiController@tambahKandang')->middleware('auth:api');
Route::post('/peternak/hapuskandang', 'PeternakApiController@hapusKandang')->middleware('auth:api');
Route::post('/peternak/updatekandang', 'PeternakApiController@updateKandang')->middleware('auth:api');

Route::get('peternak/kandang/data', 'PeternakApiController@getData');
Route::get('peternak/kandang/aktivitas','PeternakApiController@getAktivitas');
Route::get('peternak/kandang/notif', 'PeternakApiController@notif');
Route::post('peternak/kandang/setberat', 'PeternakApiController@setBerat')->middleware('auth:api');
