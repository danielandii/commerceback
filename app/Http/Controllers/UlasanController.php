<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Ulasan;
use App\Model\Produk;
use App\Model\User;
use App\Model\GambarUlasan;


class UlasanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_produk = Produk::all();
        $list_user = User::all();
        $ulasan = Ulasan::all();
        $gambar_ulasan = GambarUlasan::all();

        return view('ulasan.index', compact('ulasan','gambar_ulasan','list_produk','list_user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list_produk = Produk::all();
        $list_user = User::all();
        return view('ulasan.create', compact('list_produk','list_user'));
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
            'produk_id'=>'required',
            'user_id'=>'required',
            'rating'=>'required',
        ]);
       
        $data['produk_id'] = $request->produk_id;
        $data['user_id'] = $request->user_id;
        $data['rating'] = $request->rating;
        $data['deskripsi'] = $request->deskripsi;

        $store = Ulasan::create($data);
        
        if ($store) {
            $id_prim = $store->id;

            $data2 = $request->except(['_token', '_method', 'url_gambar']);
        
            $tujuan_upload = 'attachment/ulasan'; 
            $gambar = $request->file('url_gambar');

            // dd($gambar);
            if ($gambar) {
                $no = 1;
                foreach ($gambar as $item) {
                    $data2 = []; //data yang dimasukkan lebih dari 1
                    $nama_gambar = $no."_".($request->get('produk_id'))."_".date('his').".".$item->getClientOriginalExtension(); //."_".$gambar->getClientOriginalName();
                    $up = $item->move($tujuan_upload,$nama_gambar);
                    if($up){
                        
                        $data2['ulasan_id'] = $id_prim;
                        $data2['url_gambar'] = $tujuan_upload.'/'.$nama_gambar;
                    }
    
                    $store2 = GambarUlasan::create($data2);
                    $no++;
                }
            }
                
            // dd($store2);
        }

        return redirect('/ulasan')->with('success', 'ulasan berhasil disimpan!');
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
        $ulasan = Ulasan::find($id);
        $gamb = GambarUlasan::where('ulasan_id', $id)->get();
        // dd($gamb);
        $list_produk = Produk::all();
        $list_user = User::all();
        return view('ulasan.edit', compact('ulasan','gamb','list_produk','list_user'));
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
        // dd($request);
        $data_utama = $request->except(['_token', '_method', 'url_gambar']);
        $ulasan = Ulasan::find($id);
        if ($data_utama['deskripsi']=="<p><br></p>") {
            $data_utama['deskripsi']=null;
        }

        $tujuan_upload = 'attachment/ulasan';
        $gambar = $request->file('url_gambar');
        // dd($request);
            
        if($gambar != null){
            
            $no = 1;
            foreach ($gambar as $item) {
                $data = []; //data yang dimasukkan lebih dari 1
                $nama_gambar = $no."_".($request->get('produk_id'))."_".date('his').".".$item->getClientOriginalExtension(); //."_".$gambar->getClientOriginalName();
                $up = $item->move($tujuan_upload,$nama_gambar);
                if($up){
                    
                    $data['ulasan_id'] = $ulasan->id;
                    $data['url_gambar'] = $tujuan_upload.'/'.$nama_gambar;
                }

                $store = GambarUlasan::create($data);
                $no++;
            }
                
        }

        $ulasan->update($data_utama);

        return redirect('/ulasan')->with('success', 'ulasan berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ulasan = Ulasan::find($id);

        $gambar = GambarUlasan::where('ulasan_id', $id);
            $list_gambar = $gambar->get();

            if($gambar->delete()){
                foreach($list_gambar as $dgambar){
                    if(file_exists(public_path($dgambar->url_gambar))){
                        \File::delete(public_path($dgambar->url_gambar));
                    }
                }
            }

        $ulasan->delete();

        return redirect('/ulasan')->with('success', 'Ulasan berhasil dihapus!');
    }

    public function detail_gambar($id)
    {
        $halaman = 'gambar_ulasan';
        $ulasan = Ulasan::findOrFail($id);
    
        return view('ulasan.detail_gambar', compact('ulasan', 'halaman'));
    }

    public function detail_deskripsi($id)
    {
        $halaman = 'ulasan';
        $ulasan = Ulasan::findOrFail($id);
    
        return view('ulasan.detail_deskripsi', compact('ulasan', 'halaman'));
    }
}
