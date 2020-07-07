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
    return view('landing');
});


Route::get('login','AuthController@login')->middleware('guest')->name('login');
Route::post('storeLogin','AuthController@storeLogin')->middleware('guest')->name('storeLogin');
Route::get('logout', 'AuthController@logout')->name('logout');  

Route::group(['middleware' => ['auth','pj-role']], function(){
    Route::get('/pj/tambahkelompok', 'KelompokController@create');
    Route::post('/pj/uploadkelompok', 'KelompokController@store');
    Route::get('/pj/tambahketua', 'KetuaController@create');
    Route::post('/pj/uploadketua', 'KetuaController@store');
    Route::get('/pj/daftarkelompok', 'KelompokController@index')->name('pj.listkelompok');
    Route::get('/pj/kelompok/explore/{id}', 'KelompokController@show');
    Route::get('/pj/kelompok/delete/{id}', 'KelompokController@destroy');
    Route::get('/pj/index', 'KelompokController@highlight')->name('pj.highlight');
    Route::get('/pj/editkelompok/{id}','KelompokController@edit');
    Route::post('/pj/updatekelompok/{id}','KelompokController@update');
});



Route::group(['middleware' => ['auth','ketua-role']], function(){
    Route::get('/ketua/index', function () { return view('ketua.index'); });
    Route::get('/ketua/listpeternak', 'PeternakController@index')->name('ketua.listpeternak');
    Route::get('/ketua/konfirmasipeternak', 'PeternakController@needToConfirm')->name('ketua.konfirmasipeternak');
    Route::get('/ketua/detailkonfirmasi/{id}', 'PeternakController@detailToConfirm');
    Route::post('/ketua/peternak/konfirmasi/{id}', 'KonfirmasiController@updateUser');
    Route::get('/ketua/edit/{id}', 'PeternakController@edit');
    Route::get('/ketua/explore/{id}', 'PeternakController@explore');
    Route::get('/ketua/explore/{id}/lokasi', 'PeternakController@lokasi');
    Route::get('/ketua/hapus/{id}', 'PeternakController@destroy');
    Route::get('/ketua/explore/kandang/{id}','KandangController@explore');
    Route::get('/ketua/explore/kandang/{id}/lokasi','KandangController@lokasi');
    Route::get('/ketua/explore/kandang/edit/{id}','KandangController@edit');
    Route::get('/ketua/explore/kandang/delete/{id}','KandangController@destroy');
    Route::post('/ketua/explore/kandang/update/{id}','KandangController@update');
    Route::post('/ketua/peternak/kandang/unggah','KandangController@store');

    Route::post('/ketua/peternak/kandang/aktivitas/unggah','KandangController@storeAktivitas');

    //coba
    Route::get('/ketua/coba/curl', 'PeternakApiController@inputaktivitas');
}); 

Route::group(['middleware' => ['auth','super-role']], function(){
    Route::get('/administrator/tambahuser', 'AdministratorController@tambahUser');
    Route::get('/administrator/kelompok', 'AdministratorController@tambahKelompok')->name('administrator.kelompok');
    Route::post('/administrator/buatuser', 'AdministratorController@userToConfirm');
    Route::post('/administrator/buatkelompok', 'AdministratorController@buatKelompok');
    Route::get('/administrator/index', function () { return view('administrator.index'); });
}); 

