<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Toko;

class TokoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $toko = Toko::first();

        //$total_penjualan = Pesanan::count(); //buat total penjualan
        //$user->ratings()->avg('rating_for_user'); buat rating
        //$jumlah_produk = Produk::count();
        
        
        return view('toko.index', compact('toko'));
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $toko = Toko::first();
        return view('toko.create', compact('toko'));
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
        // dd($data);    
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
                return redirect('/toko')->with('success', 'toko berhasil disimpan!');
                // $data['url_logo'] = $tujuan_upload.'/'.$nama_gambar;
            }
        }

        $toko = Toko::updateOrCreate(
            [ 'id' => '1' ],
            [ 'nama' => $request->nama , 'alamat' => $request->alamat, 'deskripsi' => $request->deskripsi ] 
        );

        

        return redirect('/toko')->with('success', 'toko berhasil disimpan!');

        // $request->validate([
        //     // 'toko_id'=>'required',
        //     'nama'=>'required',
        //     'alamat'=>'required',
        //     'deskripsi'=>'required',
        //     'rating'=>'required',
        //     'url_logo'=>'required',
        // ]);
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
        $user = User::find($id);
        return view('toko.edit', compact('toko'));
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
        $data = $request->except(['_token', '_method', 'url_logo']);

        $toko = Toko::find($id);

        $tujuan_upload = 'attachment/toko';
        $gambar = $request->file('url_logo');
        if($gambar){

            $nama_gambar = preg_replace('/[^A-Za-z0-9_\-]/', '_', $request->get('nama'))."_".time().".".$gambar->getClientOriginalExtension(); //."_".$gambar->getClientOriginalName();
            $up1 = $gambar->move($tujuan_upload,$nama_gambar);
            if($up1){
                $data['url_logo'] = $tujuan_upload.'/'.$nama_gambar;
                if($toko->url_logo){
                    unlink(public_path(str_replace('public/', '', $toko->url_logo)));
                }
            }
        }

        $toko->update($data);

        return redirect('/toko')->with('success', 'toko berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}