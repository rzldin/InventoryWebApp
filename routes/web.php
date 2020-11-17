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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Produk
Route::get('/produk/produk', 'Produk\ProdukController@index')->name('produk.index');
Route::post('/produk/produk_doAdd', 'Produk\ProdukController@produk_doAdd')->name('produk.produk_doAdd');
Route::post('/produk/cek_produk', 'Produk\ProdukController@cek_produk')->name('produk.cek_produk');
Route::post('/produk/produk_doEdit', 'Produk\ProdukController@produk_doEdit')->name('produk.produk_doEdit');
Route::get('/produk/produk_delete/{id}', 'Produk\ProdukController@produk_delete')->name('produk.produk_delete');
Route::post('/produk/produk_get', 'Produk\ProdukController@produk_get')->name('produk.produk_get');

// Kategori
Route::get('/produk/kategori', 'Produk\KategoriController@index')->name('produk.kategori');
Route::post('/produk/kategori_doAdd', 'Produk\KategoriController@kategori_doAdd')->name('produk.kategori_doAdd');
Route::post('/produk/cek_kategori', 'Produk\KategoriController@cek_kategori')->name('produk.cek_kategori');
Route::post('/produk/kategori_doEdit', 'Produk\KategoriController@kategori_doEdit')->name('produk.kategori_doEdit');
Route::get('/produk/kategori_delete/{id}', 'Produk\KategoriController@kategori_delete')->name('produk.kategori_delete');
Route::post('/produk/kategori_get', 'Produk\KategoriController@kategori_get')->name('produk.kategori_get');

// Stok
Route::get('/produk/stok', 'Produk\StokController@index')->name('produk.stok');
Route::post('/produk/stok_doAdd', 'Produk\StokController@stok_doAdd')->name('produk.stok_doAdd');
Route::post('/produk/stok_doEdit', 'Produk\StokController@stok_doEdit')->name('produk.stok_doEdit');
Route::get('/produk/stok_delete/{id}', 'Produk\StokController@stok_delete')->name('produk.stok_delete');
Route::post('/produk/stok_get', 'Produk\StokController@stok_get')->name('produk.stok_get');

// Laporan
Route::get('/produk/laporan_cetak_pdf', 'Produk\LaporanController@cetak_pdf')->name('produk.laporan_pdf');
Route::get('/produk/laporan_cetak_excel', 'Produk\LaporanController@export_excel')->name('produk.laporan_excel');
Route::get('produk/produk_excel', 'Produk\LaporanController@laporan_excel')->name('produk.cetak_excel');

// User
Route::get('/master/user', 'Master\UserController@index')->name('master.user');
Route::post('/master/user_doAdd', 'Master\UserController@user_doAdd')->name('master.user_doAdd');
Route::post('/master/cek_user', 'Master\UserController@cek_user')->name('master.cek_nama_user');
Route::post('/master/user_doEdit', 'Master\UserController@users_doEdit')->name('master.user_doEdit');
Route::get('/master/users_delete/{id}', 'Master\UserController@users_delete')->name('master.user_delete');
Route::post('/master/user_get', 'Master\UserController@user_get')->name('master.user_get');

