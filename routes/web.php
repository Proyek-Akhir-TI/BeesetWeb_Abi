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
    // if($user->isKetua()){
    //     return view('ketua.index');
    // }
    if($user->isPj()){
        return view('pj.index');
    }
    // if($user->isPeternak()){
    //     return view('pj.index');
    // }
});

// Route::get('/home', 'HomeController@index')->name('home');
