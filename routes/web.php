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

Route::get('/','Controller@landing')->middleware('guest')->name('landing');
Route::get('tampil-register','Controller@tampilRegister')->middleware('guest')->name('tampil-register');
Route::post('register','Controller@register')->middleware('guest')->name('register');
Route::get('login','AuthController@login')->middleware('guest')->name('login');
Route::post('storeLogin','AuthController@storeLogin')->middleware('guest')->name('storeLogin');
Route::get('logout', 'AuthController@logout')->name('logout');  


Route::group(['middleware' => ['auth','pj-role']], function(){
    Route::get('/pj/tambahkelompok', 'KelompokController@create')->name('pj.tambahkelompok');
    Route::post('/pj/uploadkelompok', 'KelompokController@store')->name('pj.uploadkelompok');
    Route::get('/pj/tambahketua', 'KetuaController@create')->name('pj.tambahketua');
    Route::post('/pj/uploadketua', 'KetuaController@store')->name('pj.uploadketua');
    Route::get('/pj/daftarkelompok', 'KelompokController@index')->name('pj.listkelompok');
    Route::get('/pj/kelompok/explore/{id}', 'KelompokController@show')->name('pj.kelompok.explore');
    Route::get('/pj/kelompok/delete/{id}', 'KelompokController@destroy')->name('pj.kelompok.delete');
    Route::get('/pj/index', 'KelompokController@highlight')->name('pj.beranda');
    Route::get('/pj/editkelompok/{id}','KelompokController@edit')->name('pj.kelompok.edit');
    Route::post('/pj/updatekelompok/{id}','KelompokController@update')->name('pj.kelompok.update');
});



Route::group(['middleware' => ['auth','ketua-role']], function(){
    Route::get('/ketua/index', 'PeternakController@index')->name('ketua.index');
    Route::get('/ketua/listpeternak', 'PeternakController@daftarPeternak')->name('ketua.listpeternak'); 
    Route::get('/ketua/konfirmasipeternak', 'PeternakController@belumKonfirmasi')->name('ketua.konfirmasipeternak');
    Route::get('/ketua/detailkonfirmasi/{id}', 'PeternakController@detailToConfirm')->name('ketua.detailkonfirmasi');
    Route::post('/ketua/peternak/konfirmasi/{id}', 'KonfirmasiController@updateUser')->name('ketua.peternak.konfirmasi');
    Route::get('/ketua/edit/{id}', 'PeternakController@edit')->name('ketua.edit');
    Route::get('/ketua/explore/{id}', 'PeternakController@explore')->name('ketua.explore');
    Route::get('/ketua/explore/lokasi/{id}', 'KandangController@lokasi')->name('ketua.explore.lokasi');
    Route::get('/ketua/hapus/{id}', 'PeternakController@destroy')->name('ketua.hapus');
    Route::get('/ketua/explore/kandang/{id}','KandangController@explore')->name('ketua.explore.kandang');
    // Route::get('/ketua/explore/kandang/edit/{id}','KandangController@edit');
    // Route::get('/ketua/explore/kandang/delete/{id}','KandangController@destroy');
    // Route::post('/ketua/explore/kandang/update/{id}','KandangController@update');
    // Route::post('/ketua/peternak/kandang/unggah','KandangController@store');

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

