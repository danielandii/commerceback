<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produk;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produk = Produk::all();
    
        return view('produk.index', compact('produk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('produk.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'kategori_id'=>'required',
            'nama'=>'required',
            'deskripsi'=>'required',
            'harga'=>'required',
            'stok'=>'required',
            'rating'=>'required',
            'total_penjualan'=>'required',
        ]);

        // $produk = new produk;
        // $produk->id = $request->id;
        // $produk->nama = $request->nama;
        // $produk->deskripsi = $request->deskripsi;
        // $produk->alamat = $request->alamat;
        // $produk->id_jenis_produk = $request->id_jenis_produk;
        // $produk->foto_produk=$nama_file;
        // $produk->id_user = $request->id_user;
        // $produk->save();

        return redirect('/produk')->with('success', 'produk saved!');
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
    public function update(Request $request, $id)
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
