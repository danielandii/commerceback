<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Kategori;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori = Kategori::all();

        return view('kategori.index', compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kategori.create');
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
            
        ]);

        $data = $request->except(['_token', '_method', 'url_logo']);
    
        $tujuan_upload = 'attachment/kategori'; 
        $gambar = $request->file('url_logo');
        if($gambar){
            $nama_gambar = preg_replace('/[^A-Za-z0-9_\-]/', '_', $request->get('nama'))."_".time().".".$gambar->getClientOriginalExtension(); //."_".$gambar->getClientOriginalName();
            $up1 = $gambar->move($tujuan_upload,$nama_gambar);
            if($up1){
                
                $data['url_logo'] = $tujuan_upload.'/'.$nama_gambar;
            }
        }
        
        $store = Kategori::create($data);

        return redirect('/kategori')->with('success', 'kategori berhasil ditambahkan!');
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
        $kategori = Kategori::find($id);
        return view('kategori.edit', compact('kategori'));
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
        $data = $request->except(['_token', '_method', 'url_logo']);

        $kategori = Kategori::find($id);
        
        $tujuan_upload = 'attachment/kategori';
        $gambar = $request->file('url_logo');
        
        if($gambar){
            $nama_gambar = preg_replace('/[^A-Za-z0-9_\-]/', '_', $request->get('nama'))."_".time().".".$gambar->getClientOriginalExtension(); //."_".$gambar->getClientOriginalName();
            $up1 = $gambar->move($tujuan_upload,$nama_gambar);
            if($up1){
                $data['url_logo'] = $tujuan_upload.'/'.$nama_gambar;
                if($kategori->url_logo){
                    unlink(public_path(str_replace('public/', '', $kategori->url_logo)));
                }
            }
        }

        $kategori->update($data);

        return redirect('/kategori')->with('success', 'kategori berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kategori = Kategori::find($id);

        $gambar = GambarProduk::where('produk_id', $id);
        $list_gambar = $gambar->get();

        if($gambar->delete()){
            foreach($list_gambar as $dgambar){
                if(file_exists(public_path($dgambar->url_gambar))){
                    \File::delete(public_path($dgambar->url_gambar));
                }
            }
        }

        $kategori->delete();

        return redirect('/kategori')->with('success', 'Kategori berhasil dihapus!');
    }

    public function get_kategori()
    {
        $kategori = Kategori::all();
        return response()->json($kategori);
    }

    public function get_kategori_detail($id)
    {
        $kategori = Kategori::find($id);
        return response()->json($kategori);
    }
}
