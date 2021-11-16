<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Toko;
use App\Model\Produk;
use App\Model\Ulasan;
use App\Model\Transaksi;
use App\Model\DetailTransaksi;

class APITokoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $toko = Toko::first();
        $jumlah_produk = Produk::count();
        $ulasan = Ulasan::avg('rating');
        $total_penjualan = Transaksi::where('status', '3')->count();

        $pendapatan = Transaksi::where('status', '3')->get();
        $total_pendapatan = 0;
        foreach ($pendapatan as $transaksi) {
                $total_pendapatan += $transaksi->detail_transaksi->total;
        }
        $result = [];
        $result['id'] = $toko->id;
        $result['nama'] = $toko->nama;
        $result['alamat'] = $toko->alamat;
        $result['deskripsi'] = $toko->deskripsi;
        $result['logo'] = @$toko->url_logo;
        $result['penilaian_toko'] = number_format(@$ulasan, 2, '.', ',');
        $result['total_penjualan'] = @$total_penjualan;
        $result['total_pendapatan'] = number_format(@$total_pendapatan, 0, ',', '.');
        $result['jumlah_produk'] = @$jumlah_produk;

        return response()->json([
            'data' => $result
        ], 200);
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

        $data = $request->except(['_token', '_method', 'url_logo']);
        $tujuan_upload = 'attachment/toko'; 
        $gambar = $request->file('url_logo');
        if($gambar){
            $nama_gambar = preg_replace('/[^A-Za-z0-9_\-]/', '_', $request->get('nama'))."_".time().".".$gambar->getClientOriginalExtension(); //."_".$gambar->getClientOriginalName();
            $up1 = $gambar->move($tujuan_upload,$nama_gambar); //nyimpan gmbar lokal
            if($up1){
                $toko = Toko::updateOrCreate(
                    [ 'id' => '1' ],
                    [ 'nama' => $request->nama , 'alamat' => $request->alamat, 'deskripsi' => $request->deskripsi, 'url_logo' => $tujuan_upload.'/'.$nama_gambar ] //nyimpan db
                );
                return response()->json([
                    'message' => 'Toko berhasil disimpan'
                ]);
            }
        }

        $toko = Toko::updateOrCreate(
            [ 'id' => '1' ],
            [ 'nama' => $request->nama , 'alamat' => $request->alamat, 'deskripsi' => $request->deskripsi ] 
        );        

        return response()->json([
            'message' => 'Toko berhasil disimpan'
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) //masih perlu dipelajari lagi
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
