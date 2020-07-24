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
    return view('auth/login'); //auth/login>>>>> agar saat akses pertama kali langsung ke halaman login
});

/*
Auth::routes();
*/
Auth::routes(['verify' => true]);
Route::group(['middleware'=>'auth'], function() { //utk memcegah akses paksa pd url halaman fitur2 aplikasi sebelem login dan di ubah ke halaman login

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
Route::resource('kategori', 'KategoriController'); //tampilan urlny /kategori
Route::resource('tiket', 'TiketController');
Route::get('/upload/kategori/excel', 'KategoriController@excel')->name('kategori.excel');
Route::post('/upload/kategori/excel', 'KategoriController@upload')->name('kategori.upload.excel');
Route::get('transaksi', 'TransaksiController@index')->name('transaksi.index');
Route::post('transaksi', 'TransaksiController@store')->name('transaksi.store');
Route::delete('transaksi/{id}', 'TransaksiController@destroy')->name('transaksi.destroy');
Route::get('transaksi/update', 'TransaksiController@update')->name('transaksi.update');
Route::get('transaksi/pdf', 'TransaksiController@laporan')->name('transaksi.laporan');
Route::get('/excel', 'TransaksiController@excel')->name('laporan.excel');
});
