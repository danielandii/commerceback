<?php

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

use App\Http\Controllers\KategoriController;

Route::get('/', function () {
    return view('login');
});

//all
Route::get('/login',  'LoginController@index')->name('login');
Route::post('/login',  'LoginController@login');
Route::get('/logout',  'LoginController@logout');


Route::group(['middleware' => ['auth']], function() {
    Route::get('toko.index',  'TokoController@index');
	Route::get('/changepass',  'UserController@changePass');
	Route::post('/changepass/{id}',  'UserController@changePassSubmit')->name('changepass');

	//admin
    Route::group(['middleware' => ['role:1']], function() {
		Route::resource('users', 'UserController');
		Route::get('users/detail_user/{id}',  'UserController@detail_user')->name('users.detail_user');
		Route::resource('transaksi', 'TransaksiController');
		Route::get('transaksi/detail_transaksi/{id}',  'TransaksiController@detail_transaksi')->name('transaksi.detail_transaksi');
		Route::any('transaksidestroygambar/{gambar_id}', 'BuktiPembayaranController@destroy');
		Route::get('transaksi_pesanan', 'TransaksiController@index1');
		Route::get('transaksi_penjualan', 'TransaksiController@index2');
		Route::get('transaksiexport', 'TransaksiController@pesananexport')->name('transaksi.cetak_pesanan');
		Route::get('penjualanexport', 'TransaksiController@penjualanexport')->name('transaksi.cetak_penjualan');

		
		Route::get('toko',  'TokoController@index');
		Route::get('toko/create',  'TokoController@create')->name('toko.create');
		Route::post('toko',  'TokoController@store')->name('toko.store');

		Route::resource('produk', 'ProdukController');
		Route::get('produk/detail_gambar/{id}',  'ProdukController@detail_gambar')->name('produk.detail_gambar');
		Route::get('produk/detail_deskripsi/{id}',  'ProdukController@detail_deskripsi')->name('produk.detail_deskripsi');
		Route::any('produkdestroygambar/{gambar_id}', 'GambarProdukController@destroy');

		Route::resource('kategori', 'KategoriController');

		Route::resource('varian', 'VarianController');

		Route::resource('ulasan', 'UlasanController');
		Route::get('ulasan/detail_gambar/{id}',  'UlasanController@detail_gambar')->name('ulasan.detail_gambar');
		Route::get('ulasan/detail_deskripsi/{id}',  'UlasanController@detail_deskripsi')->name('ulasan.detail_deskripsi');
		Route::any('ulasandestroygambar/{gambar_id}', 'GambarUlasanController@destroy');
	});
});

