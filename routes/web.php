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

Route::get('/', function () {
    return view('welcome');
});

//login

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
route::group(['middleware' => [ 'role:1']], function() {
    
    route::get('/admin', 'AdminController@index');
    route::get('/kategori', 'AdminController@kategori');
    route::get('/produk', 'AdminController@produk');

});
route::group(['middleware' => [ 'role:2']], function() {
    
    
    // route::get('/kategori', 'AdminController@kategori');
    // route::get('/produk', 'AdminController@produk');

});

route::group(['middleware' => [ 'role:3']], function() {
    
    Route::get('/user', 'UserController@index')->name('user');
    
});



                                                //USER
route::get('/user', 'UserController@index');

                                                //PRODUK
// route::get('/produk', 'AdminController@produk');
Route::get('/produkadd', 'AdminController@produkadd')->name('produkadd');
Route::post('/produk_process', 'AdminController@produk_process');
Route::get('/produk_delete/{gambar}', 'AdminController@produk_delete')->name('produk_delete');
// Route::get('/editproduk','AdminController@editproduk');
//gamuncul css
Route::get('/editproduk/{id_kategori}','AdminController@editproduk');
Route::post('/produk/update','AdminController@update');

                                            //KATEGORI
// route::get('/kategori', 'AdminController@kategori');
Route::get('/kategoriadd', 'AdminController@kategoriadd')->name('kategoriadd');
Route::post('/kategori_process', 'AdminController@kategori_process');
Route::get('/kategori_delete/{gambar}', 'AdminController@kategori_delete')->name('kategori_delete');
Route::get('/editkategori/{id}','AdminController@editkategori');
Route::post('/kategori/updatekategori','AdminController@updatekategori');

                                            //KERANJANG
route::get('/order', 'AdminController@order');
Route::get('/orderadd', 'AdminController@orderadd')->name('orderadd');
Route::post('/order_process', 'AdminController@order_process');
Route::get('/order_delete/{gambar}', 'AdminController@order_delete')->name('order_delete');

                                            //USER ACC
route::get('/useracc', 'AdminController@useracc');

                                            //TES
route::get('/tes', 'AdminController@tes');

                                            //TRANSAKSI
route::get('/transaksi', 'AdminController@transaksi');


Route::get('/transaksiadd', 'AdminController@transaksiadd')->name('transaksiadd');
Route::get('/transaksi_process', 'AdminController@transaksi_process');
route::get('/detailtransaksi', 'AdminController@detailtransaksi')->name('detailtransaksi');

                                        //detaitransaksi1
route::get('/detailtransaksi1', 'AdminController@detailtransaksi1')->name('detailtransaksi1');
Route::post('/detailtransaksi1process', 'AdminController@detailtransaksi1process');

route::get('/histori/{id_transaksi}', 'AdminController@histori');




                                            //kirim
route::get('/kirim', 'AdminController@kirim');
Route::get('/kirimadd', 'AdminController@kirimadd')->name('kirimadd');
Route::post('/kirim_process', 'AdminController@kirim_process');
Route::get('/kirim_delete/{jenis}', 'AdminController@kirim_delete')->name('kirim_delete');
Route::get('/editkirim/{id}','AdminController@editkirim');
Route::post('/kirim/updatekirim','AdminController@updatekirim');

                                            //REKENING
route::get('/rekening', 'AdminController@rekening');
Route::get('/rekeningadd', 'AdminController@rekeningadd')->name('rekeningadd');
Route::post('/rekening_process', 'AdminController@rekening_process');
Route::get('/rekening_delete/{id}', 'AdminController@rekening_delete')->name('rekening_delete');

