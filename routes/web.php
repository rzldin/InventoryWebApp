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

// Kategori
Route::get('/produk/kategori', 'Produk\KategoriController@index')->name('produk.kategori');
Route::post('/produk/kategori_doAdd', 'Produk\KategoriController@kategori_doAdd')->name('produk.kategori_doAdd');
Route::post('/produk/cek_kategori', 'Produk\KategoriController@cek_kategori')->name('produk.cek_kategori');
Route::post('/produk/kategori_doEdit', 'Produk\KategoriController@kategori_doEdit')->name('produk.kategori_doEdit');
Route::get('/produk/kategori_delete/{id}', 'Produk\KategoriController@kategori_delete')->name('produk.kategori_delete');
Route::post('/produk/kategori_get', 'Produk\KategoriController@kategori_get')->name('produk.kategori_get');
