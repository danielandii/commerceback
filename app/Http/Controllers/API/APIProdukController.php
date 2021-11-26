<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\IsiVarian;
use Illuminate\Http\Request;
use App\Model\Produk;
use App\Model\Kategori;
use App\Model\Varian;
use App\Model\GambarProduk;
use App\Model\Ulasan;


class APIProdukController extends Controller
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
        
        $result = [];
        $i = 0;
        foreach ($produk as $produk) {
            $result[$i]['id'] = $produk->id;
            $result[$i]['nama_kategori'] = @$produk->kategori->nama;
            $result[$i]['nama_produk'] = $produk->nama;
            $result[$i]['deskripsi'] = $produk->deskripsi;
            
            $result_jenis_varian = [];
            $j = 0;
            foreach($produk->varian as $varian) {

                $result_varian = [];
                $k = 0;
                foreach($varian->isi_varian as $isi) {
                    $result_varian[$k] = $isi->varian;
                    $k++;
                }
                
                $result_jenis_varian[$j][$varian->jenis_varian] = $result_varian;
                
                $j++;
            }
            $result[$i]['jenis_varian'] = $result_jenis_varian;

            $l = 0;
            foreach ($produk->gambar as $gambar) {
                if ($gambar->is_thumbnail==1) {
                    $result[$i]['thumbnail'][$gambar->id] = $gambar->url_gambar;
                }
                $l++;
            }
           
            $m = 0;
            foreach ($produk->gambar as $gambar) {
                if ($gambar->is_thumbnail==0) {
                    $result[$i]['gambar_lainnya'][$gambar->id] = $gambar->url_gambar;
                }
                $m++;
            }
            
            $result[$i]['harga'] = "Rp. ".format_uang($produk->harga);
            $result[$i]['stok'] = $produk->stok;
            $result[$i]['rating'] = number_format(@$produk->ulasan->avg('rating'), 2, '.', ',');
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
            'kategori_id'=>'required',
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
        $store1 = Produk::create($data);
        // $return_data['produk'] = $store;

        if ($store1) {
            $id_prim = $store1->id;

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
        
            $store2 = GambarProduk::create($data);
            // $return_data['gambar'] = $store;

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

                $store3 = GambarProduk::create($data2);
                $no++;
            }
                
            }
            // dd($store2);
        }


        return response()->json([
            'message' => 'produk berhasil ditambahkan',
            'data' => [$store1, $store2, $store3]
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
        $data_utama = $request->except(['_token', '_method', 'gambar_thumbnail', 'url_gambar']);
        $produk = Produk::find($id);

        $tujuan_upload = 'attachment/produk';
        $gambar = $request->file('gambar_thumbnail');
        
        $data = [];
        if($gambar){
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
            
        if($gambar2){
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

        return response()->json([
            'message' => 'produk berhasil diubah'
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

        return response()->json([
            'message' => 'produk berhasil dihapus',
            'data' => $produk
        ], 200);
    }

    public function produk_kategori($kategori_id)
    {
        $produks = Produk::where('kategori_id', $kategori_id)->get();
        
        $varian = Varian::all();
        
        $result = [];
        $i = 0;
        foreach ($produks as $produk) {
            $result[$i]['id'] = $produk->id;
            $result[$i]['nama_kategori'] = @$produk->kategori->nama;
            $result[$i]['nama_produk'] = $produk->nama;
            $result[$i]['deskripsi'] = $produk->deskripsi;
            
            $result_jenis_varian = [];
            $j = 0;
            foreach($produk->varian as $varian) {

                $result_varian = [];
                $k = 0;
                foreach($varian->isi_varian as $isi) {
                    $result_varian[$k] = $isi->varian;
                    $k++;
                }
                
                $result_jenis_varian[$j][$varian->jenis_varian] = $result_varian;
                
                $j++;
            }
            $result[$i]['jenis_varian'] = $result_jenis_varian;

            $l = 0;
            foreach ($produk->gambar as $gambar) {
                if ($gambar->is_thumbnail==1) {
                    $result[$i]['thumbnail'][$gambar->id] = $gambar->url_gambar;
                }
                $l++;
            }
           
            $m = 0;
            foreach ($produk->gambar as $gambar) {
                if ($gambar->is_thumbnail==0) {
                    $result[$i]['gambar_lainnya'][$gambar->id] = $gambar->url_gambar;
                }
                $m++;
            }
            
            $result[$i]['harga'] = "Rp. ".format_uang($produk->harga);
            $result[$i]['stok'] = $produk->stok;
            $result[$i]['rating'] = number_format(@$produk->ulasan->avg('rating'), 2, '.', ',');
            $i++;
        }

        return response()->json([
            'data' => $result
        ], 200);
    }

    public function produk_search(Request $request)
    {
        $nama = $request->nama;
        $deskripsi = $request->deskripsi;
        $produks = Produk::where('id', '>', 0);
        if ($deskripsi) {
            $produks = $produks->where('deskripsi','LIKE',"%$deskripsi%");
        }        
        $produks = $produks->where('nama','LIKE',"%$nama%");
        $produks = $produks->get();
        $varian = Varian::all();
        
        $result = [];
        $i = 0;
        foreach ($produks as $produk) {
            $result[$i]['id'] = $produk->id;
            $result[$i]['nama_kategori'] = @$produk->kategori->nama;
            $result[$i]['nama_produk'] = $produk->nama;
            $result[$i]['deskripsi'] = $produk->deskripsi;
            
            $result_jenis_varian = [];
            $j = 0;
            foreach($produk->varian as $varian) {

                $result_varian = [];
                $k = 0;
                foreach($varian->isi_varian as $isi) {
                    $result_varian[$k] = $isi->varian;
                    $k++;
                }
                
                $result_jenis_varian[$j][$varian->jenis_varian] = $result_varian;
                
                $j++;
            }
            $result[$i]['jenis_varian'] = $result_jenis_varian;

            $l = 0;
            foreach ($produk->gambar as $gambar) {
                if ($gambar->is_thumbnail==1) {
                    $result[$i]['thumbnail'][$gambar->id] = $gambar->url_gambar;
                }
                $l++;
            }
           
            $m = 0;
            foreach ($produk->gambar as $gambar) {
                if ($gambar->is_thumbnail==0) {
                    $result[$i]['gambar_lainnya'][$gambar->id] = $gambar->url_gambar;
                }
                $m++;
            }
            
            $result[$i]['harga'] = "Rp. ".format_uang($produk->harga);
            $result[$i]['stok'] = $produk->stok;
            $result[$i]['rating'] = number_format(@$produk->ulasan->avg('rating'), 2, '.', ',');
            $i++;
        }

        return response()->json([
            'code' => 200,
            'message' => 'ketemu:)',
            'data' => $result
        ], 200);
    }
}
