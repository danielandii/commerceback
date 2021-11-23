<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Kategori;


class APIKategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori = Kategori::all();

        return response()->json([
            'data' => $kategori
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
        
        $kategori = Kategori::create($data);

        return response()->json([
            'message' => 'kategori berhasil ditambahkan',
            'data' => $kategori
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

        return response()->json([
            'message' => 'kategori berhasil diubah',
            'data' => $kategori
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
        $kategori = Kategori::find($id);
        
        $delete = $kategori->delete();
            if($delete){
                    if(file_exists(public_path($kategori->url_gambar))){
                        \File::delete(public_path($kategori->url_gambar));
                    }
            }

        $kategori->delete();

        return response()->json([
            'message' => 'kategori berhasil dihapus',
            'data' => $kategori
        ], 200);
    }

}
