<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register', 'API\APIUserController@register');
Route::post('/login', 'API\APIUserController@login');

Route::middleware('auth:api')->group( function () {
	Route::get('users', 'API\APIUserController@index');
	Route::post('/users/store', 'API\APIUserController@store');
	Route::post('users/update/{id}', 'API\APIUserController@update');
	Route::delete('users/delete/{id}', 'API\APIUserController@destroy');
	Route::get('users/detail_user/{id}',  'API\APIUserController@detail_user')->name('users.detail_user');
	
	Route::get('transaksi', 'API\APITransaksiController@index');
	Route::post('transaksi/store', 'API\APITransaksiController@store');
	Route::post('transaksi/update/{id}', 'API\APITransaksiController@update');
	Route::delete('transaksi/delete/{id}', 'API\APITransaksiController@destroy');
	Route::get('transaksi/detail_transaksi/{id}',  'API\APITransaksiController@detail_transaksi');
	Route::any('transaksidestroygambar/{gambar_id}', 'API\APIBuktiPembayaranController@destroy');
	Route::get('transaksi_pesanan', 'API\APITransaksiController@index1');
	Route::get('transaksi_penjualan', 'API\APITransaksiController@index2');
	Route::get('transaksi/metode_pembayaran', 'API\APITransaksiController@metode_pembayaran');
	Route::get('transaksi/cek_status/{no_pesanan}',  'API\APITransaksiController@cek_status');
		
	Route::get('toko',  'API\APITokoController@index');
	Route::post('toko/create',  'API\APITokoController@create');
	Route::post('toko/store',  'API\APITokoController@store');

	Route::get('produk', 'API\APIProdukController@index');
	Route::post('produk/store', 'API\APIProdukController@store');
	Route::post('produk/update/{id}', 'API\APIProdukController@update');
	Route::delete('produk/delete/{id}', 'API\APIProdukController@destroy');
	Route::get('produk/detail_gambar/{id}',  'API\APIProdukController@detail_gambar')->name('produk.detail_gambar');
	Route::get('produk/detail_deskripsi/{id}',  'API\APIProdukController@detail_deskripsi')->name('produk.detail_deskripsi');
	Route::any('produkdestroygambar/{gambar_id}', 'API\APIGambarProdukController@destroy');
	Route::get('produk/produk_kategori/{kategori_id}',  'API\APIProdukController@produk_kategori');
	Route::get('produk/search',  'API\APIProdukController@produk_search');


	Route::get('kategori', 'API\APIKategoriController@index');
	Route::post('/kategori/store', 'API\APIKategoriController@store');
	Route::post('kategori/update/{id}', 'API\APIKategoriController@update');
	Route::delete('kategori/delete/{id}', 'API\APIKategoriController@destroy');


	Route::get('varian', 'API\APIVarianController@index');
	Route::post('varian/store', 'API\APIVarianController@store');
	Route::patch('varian/update/{id}', 'API\APIVarianController@update');
	Route::delete('varian/delete/{id}', 'API\APIVarianController@destroy');
	Route::get('varian/show/{id}', 'API\APIVarianController@show');

	Route::get('ulasan', 'API\APIUlasanController@index');
	Route::post('ulasan/store', 'API\APIUlasanController@store');
	Route::post('ulasan/update/{id}', 'API\APIUlasanController@update');
	Route::delete('ulasan/delete/{id}', 'API\APIUlasanController@destroy');
	Route::get('ulasan/detail_gambar/{id}',  'API\APIUlasanController@detail_gambar');
	Route::get('ulasan/detail_deskripsi/{id}',  'API\APIUlasanController@detail_deskripsi');
	Route::any('ulasandestroygambar/{gambar_id}', 'API\APIGambarUlasanController@destroy');
});