<?php

namespace App\Http\Controllers;

use App\Model\IsiVarian;
use Illuminate\Http\Request;
use App\Model\Produk;
use App\Model\Kategori;
use App\Model\Varian;
use App\Model\GambarProduk;


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
        $varian = Varian::all();
        $isivarian = IsiVarian::all();
        $gambarproduk = GambarProduk::all();
        // $thumb = GambarProduk::where('produk_id', $id)->where('is_thumbnail', 1)->first();
    
        return view('produk.index', compact('produk', 'varian', 'isivarian','gambarproduk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list_kategori = Kategori::all();
        return view('produk.create', compact('list_kategori'));
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
            'nama'=>'required',
            'deskripsi'=>'required',
            'harga'=>'required',
            'stok'=>'required',
        ]);
       
        $data['kategori_id'] = $request->kategori_id;
        $data['nama'] = $request->nama;
        $data['deskripsi'] = $request->deskripsi;
        $data['harga'] = $request->harga;
        $data['stok'] = $request->stok;
        
        // dd($data);
        $store = Produk::create($data);

        if ($store) {
            $id_prim = $store->id;

            $data = $request->except(['_token', '_method', 'gambar_thumbnail', 'url_gambar']);
        
            $tujuan_upload = 'attachment/produk'; 
            $gambar = $request->file('gambar_thumbnail');
            
           
        
            if($gambar){
                $data = [];
                $nama_gambar = 'thumb_'.preg_replace('/[^A-Za-z0-9_\-]/', '_', $request->get('nama'))."_".date('his').".".$gambar->getClientOriginalExtension(); //."_".$gambar->getClientOriginalName();
                $up1 = $gambar->move($tujuan_upload,$nama_gambar);
                if($up1){
                    
                    $data['produk_id'] = $id_prim;
                    $data['url_gambar'] = $tujuan_upload.'/'.$nama_gambar;
                    $data['is_thumbnail'] = 1;
                }
            }
        
            $store = GambarProduk::create($data);

            //menyimpan gambar produk
            
            $tujuan_upload = 'attachment/produk'; 
            $gambar2 = $request->file('url_gambar');
            
            if($gambar2){
                $no = 1;
            foreach ($gambar2 as $item) {
                $data2 = []; //data yang dimasukkan lebih dari 1
                $nama_gambar2 = $no.preg_replace('/[^A-Za-z0-9_\-]/', '_', $request->get('nama'))."_".date('his').".".$item->getClientOriginalExtension(); //."_".$gambar->getClientOriginalName();
                $up2 = $item->move($tujuan_upload,$nama_gambar2);
                if($up2){
                    
                    $data2['produk_id'] = $id_prim;
                    $data2['url_gambar'] = $tujuan_upload.'/'.$nama_gambar2;
                    $data2['is_thumbnail'] = 0;
                }

                $store2 = GambarProduk::create($data2);
                $no++;
            }
                
            }
            // dd($store2);
        }


        return redirect('/produk')->with('success', 'produk berhasil disimpan!');
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
        $produk = Produk::find($id);
        $thumb = GambarProduk::where('produk_id', $id)->where('is_thumbnail', 1)->first();
        $gamb = GambarProduk::where('produk_id', $id)->where('is_thumbnail', 0)->get();
        // dd($gamb);
        $list_kategori = Kategori::all();
        return view('produk.edit', compact('produk','thumb','gamb','list_kategori'));
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
        $data_utama = $request->except(['_token', '_method', 'gambar_thumbnail', 'url_gambar']);
        $produk = produk::find($id);

        $tujuan_upload = 'attachment/produk';
        $gambar = $request->file('gambar_thumbnail');
        
        $data = [];
        if($gambar != null){
            $hgambar = GambarProduk::where('produk_id', $produk->id)->where('is_thumbnail', 1)->delete();
            $nama_gambar = 'thumb_'.preg_replace('/[^A-Za-z0-9_\-]/', '_', $request->get('nama'))."_".date('his').".".$gambar->getClientOriginalExtension(); //."_".$gambar->getClientOriginalName();
            $up1 = $gambar->move($tujuan_upload,$nama_gambar);
            if($up1){
                
                $data['produk_id'] = $produk->id;
                $data['url_gambar'] = $tujuan_upload.'/'.$nama_gambar;
                $data['is_thumbnail'] = 1;
            }
            $store = GambarProduk::create($data);
        }
        
        //menyimpan gambar produk
            
        $tujuan_upload = 'attachment/produk'; 
        $gambar2 = $request->file('url_gambar');
        // dd($request);
            
        if($gambar2 != null){
            $no = 1;
            foreach ($gambar2 as $item) {
                $data2 = []; //data yang dimasukkan lebih dari 1
                $nama_gambar2 = $no.preg_replace('/[^A-Za-z0-9_\-]/', '_', $request->get('nama'))."_".date('his').".".$item->getClientOriginalExtension(); //."_".$gambar->getClientOriginalName();
                $up2 = $item->move($tujuan_upload,$nama_gambar2);
                if($up2){
                    
                    $data2['produk_id'] = $produk->id;
                    $data2['url_gambar'] = $tujuan_upload.'/'.$nama_gambar2;
                    $data2['is_thumbnail'] = 0;
                }

                $store2 = GambarProduk::create($data2);
                $no++;
            }
                
        }

        $produk->update($data_utama);

        return redirect('/produk')->with('success', 'produk berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produk = produk::find($id);

        $gambar = GambarProduk::where('produk_id', $id);
            $list_gambar = $gambar->get();

            if($gambar->delete()){
                foreach($list_gambar as $dgambar){
                    if(file_exists(public_path($dgambar->url_gambar))){
                        \File::delete(public_path($dgambar->url_gambar));
                    }
                }
            }

        $produk->delete();

        return redirect('/produk')->with('success', 'produk berhasil dihapus!');
    }
}
