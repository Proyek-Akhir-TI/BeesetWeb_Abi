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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::auth();
Route::get('/home', function(){
    $user = Auth::user();
        if($user->isKetua()){
            return view('ketua.index');
        }
    if($user->isPj()){
        return view('pj.index');
    }
    // if($user->isPeternak()){
    //     return view('pj.index');
    // }
});

// Route::get('/home', 'HomeController@index')->name('home');


// role : penanggung jawab
Route::get('/pj/tambahkelompok', 'KelompokController@create');
Route::post('/pj/uploadkelompok', 'KelompokController@store');
Route::get('/pj/tambahketua', 'KetuaController@create');
Route::post('/pj/uploadketua', 'KetuaController@store');
Route::get('/pj/index', function () {
    return view('pj.index');
});


// role : ketua
Route::get('/ketua/index', function () {
    return view('ketua.index');
});
Route::get('/ketua/listpeternak', 'PeternakController@index');
Route::get('/ketua/edit/{id}', 'PeternakController@edit');
Route::get('/ketua/explore/{id}', 'PeternakController@explore');
Route::get('/ketua/explore/kandang/{id}','KandangController@explore');
Route::get('/ketua/peternak/kandang/tambah','KandangController@showAdd');
Route::get('/ketua/peternak/kandang/unggah','KandangController@store');
