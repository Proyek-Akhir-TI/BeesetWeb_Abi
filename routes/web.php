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

Route::get('/foo', function () {
    Artisan::call('storage:link');
});

Route::get('/','Controller@landing')->middleware('guest')->name('landing');
Route::get('tampil-register','Controller@tampilRegister')->middleware('guest')->name('tampil-register');
Route::post('register','Controller@register')->middleware('guest')->name('register');
Route::get('login','AuthController@login')->middleware('guest')->name('login');
Route::post('storeLogin','AuthController@storeLogin')->middleware('guest')->name('storeLogin');
Route::get('logout', 'AuthController@logout')->name('logout');
Route::get('/ketua/edit/{id}', 'KetuaController@profil')->name('ketua.edit');  


Route::group(['middleware' => ['auth','pj-role']], function(){
    Route::get('/pj/tambahkelompok', 'KelompokController@create')->name('pj.tambahkelompok');
    Route::post('/pj/uploadkelompok', 'KelompokController@store')->name('pj.uploadkelompok');
    Route::get('/pj/tambahketua', 'KetuaController@create')->name('pj.tambahketua');
    Route::post('/pj/uploadketua', 'KetuaController@store')->name('pj.uploadketua');
    Route::get('/pj/listkelompok', 'KelompokController@index')->name('pj.listkelompok');
    Route::get('/pj/kelompok/explore/{id}', 'KelompokController@show')->name('pj.kelompok.explore');
    Route::get('/pj/kelompok/delete/{id}', 'KelompokController@destroy')->name('pj.kelompok.delete');
    Route::get('/pj/index', 'KelompokController@highlight')->name('pj.beranda');
    Route::get('/pj/editkelompok/{id}','KelompokController@edit')->name('pj.kelompok.edit');
    Route::post('/pj/updatekelompok/{id}','KelompokController@update')->name('pj.kelompok.update');
    Route::post('/pj/update/{id}','PjController@update')->name('pj.update');
    Route::get('/pj/profil/{id}','PjController@profil')->name('pj.profil');
    
});



Route::group(['middleware' => ['auth','ketua-role']], function(){
    Route::get('/ketua/index', 'KetuaController@profil')->name('ketua.index');
    Route::get('/ketua/edit/{id}', 'KetuaController@edit')->name('ketua.edit');
    Route::post('/ketua/update/{id}', 'KetuaController@update')->name('ketua.update');
    Route::get('/ketua/listpeternak', 'PeternakController@daftarPeternak')->name('ketua.listpeternak');
    Route::get('/ketua/konfirmasipeternak', 'PeternakController@belumKonfirmasi')->name('ketua.konfirmasipeternak');
    Route::get('/ketua/detailkonfirmasi/{id}', 'PeternakController@detailToConfirm')->name('ketua.detailkonfirmasi');
    Route::post('/ketua/peternak/konfirmasi/{id}', 'KonfirmasiController@updateUser')->name('ketua.peternak.konfirmasi');
    Route::get('/ketua/explore/{id}', 'PeternakController@explore')->name('ketua.explore');
    Route::get('/ketua/tinjauan/{id}','PeternakController@tinjauan')->name('ketua.tinjauan'); 
    Route::get('/ketua/explore/lokasi/{id}', 'KandangController@lokasi')->name('ketua.explore.lokasi');
    Route::get('/ketua/hapus/{id}', 'PeternakController@destroy')->name('ketua.hapus');
    Route::get('/ketua/explore/kandang/{id}','KandangController@explore')->name('ketua.explore.kandang');
}); 

Route::group(['middleware' => ['auth','super-role']], function(){
    Route::get('/administrator/tambahuser', 'AdministratorController@tambahUser')->name('administrator.tambahuser');
    Route::get('/administrator/kelompok', 'AdministratorController@tambahKelompok')->name('administrator.kelompok');
    Route::post('/administrator/buatuser', 'AdministratorController@buatUser')->name('administrator.buatuser');
    Route::post('/administrator/buatkelompok', 'AdministratorController@buatKelompok')->name('administrator.buatkelompok');
}); 

