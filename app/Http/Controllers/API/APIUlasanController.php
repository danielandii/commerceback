<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Ulasan;
use App\Model\Produk;
use App\Model\User;
use App\Model\GambarUlasan;


class APIUlasanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ulasan = Ulasan::all();

        $result = [];
        $i = 0;
        foreach ($ulasan as $ulas) {
            $result[$i]['id'] = $ulas->id;
            $result[$i]['nama_produk'] = @$ulas->produk->nama;
            $result[$i]['username'] = @$ulas->user->nama;
            $result[$i]['rating'] = $ulas->rating;
            $result[$i]['deskripsi'] = ($ulas->deskripsi) ? ($ulas->deskripsi) : '-';
            $result[$i]['gambar_ulasan'] = @$ulas->gambar_ulasan;
            $i++;
        }

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
            
            if ($gambar) {
                
                $no = 1;
                foreach ($gambar as $item) {
                    $data2 = []; //data yang dimasukkan lebih dari 1
                    $nama_gambar = $no."_".($request->get('produk_id'))."_".date('his').".".$item->getClientOriginalExtension(); //."_".$gambar->getClientOriginalName();
                    // dd($nama_gambar);
                    $up = $item->move($tujuan_upload,$nama_gambar);
                    if($up){
                        
                        $data2['ulasan_id'] = $id_prim;
                        $data2['url_gambar'] = $tujuan_upload.'/'.$nama_gambar;
                    }
    
                    $store2 = GambarUlasan::create($data2);
                    $no++;
                }
            }
        }

        return response()->json([
            'message' => 'Ulasan berhasil ditambahkan'
        ], 200);
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
        $data_utama = $request->except(['_token', '_method', 'url_gambar']);
        $ulasan = Ulasan::find($id);
        if ($data_utama['deskripsi']=="<p><br></p>") {
            $data_utama['deskripsi']=null;
        }

        $tujuan_upload = 'attachment/ulasan';
        $gambar = $request->file('url_gambar');
        
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

        return response()->json([
            'message' => 'Ulasan berhasil diubah',
            'data' => $store
        ], 200);
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

        return response()->json([
            'message' => 'Ulasan berhasil dihapus',
        ], 200);
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
