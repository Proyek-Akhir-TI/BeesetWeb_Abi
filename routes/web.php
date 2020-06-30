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
    if($user->isSu()){
        return view('administrator.index');
    }
});

// Route::get('/home', 'HomeController@index')->name('home');


// role : penanggung jawab
Route::get('/pj/tambahkelompok', 'KelompokController@create');
Route::post('/pj/uploadkelompok', 'KelompokController@store');
Route::get('/pj/tambahketua', 'KetuaController@create');
Route::post('/pj/uploadketua', 'KetuaController@store');
Route::get('/pj/daftarkelompok', 'KelompokController@index');
Route::get('/pj/kelompok/explore/{id}', 'KelompokController@show');
Route::get('/pj/kelompok/delete/{id}', 'KelompokController@destroy');
Route::get('/pj/index', function () {
    return view('pj.index');

});


// role : ketua
Route::get('/ketua/index', function () {
    return view('ketua.index');
});
Route::get('/ketua/listpeternak', 'PeternakController@index');
Route::get('/ketua/konfirmasipeternak', 'PeternakController@needToConfirm');
Route::get('/ketua/detalverifikasi/{id}', 'PeternakController@detailToConfirm');


Route::post('/ketua/peternak/konfirmasi/{id}', 'KonfirmasiController@updateUser');

Route::get('/ketua/edit/{id}', 'PeternakController@edit');
Route::get('/ketua/explore/{id}', 'PeternakController@explore');
Route::get('/ketua/hapus/{id}', 'PeternakController@destroy');
Route::get('/ketua/explore/kandang/{id}','KandangController@explore');
Route::get('/ketua/explore/kandang/edit/{id}','KandangController@edit');
Route::get('/ketua/explore/kandang/delete/{id}','KandangController@destroy');
Route::post('/ketua/explore/kandang/update/{id}','KandangController@update');
Route::post('/ketua/peternak/kandang/unggah','KandangController@store');
Route::post('/ketua/peternak/kandang/aktivitas/unggah','KandangController@storeAktivitas'); 

// role : super user
Route::get('/administrator/tambahuser', 'AdministratorController@tambahUser');
Route::get('/administrator/kelompok', 'AdministratorController@tambahKelompok');
Route::post('/administrator/buatuser', 'AdministratorController@userToConfirm');
Route::post('/administrator/buatkelompok', 'AdministratorController@buatKelompok');
Route::get('/administrator/index', function () {
    return view('administrator.index');

});

