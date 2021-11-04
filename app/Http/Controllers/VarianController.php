<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Varian;
use App\Model\Produk;
use App\Model\IsiVarian;

class VarianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $varian = Varian::all();
        $isi_varian = IsiVarian::all();

        return view('varian.index', compact('varian', 'isi_varian'));
    }

    /**
     * Show the form for creating a new resource.ph
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list_produk = produk::all();
        return view('varian.create', compact('list_produk'));
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
            'jenis_varian'=>'required',            
        ]);

        // $data = $request->except(['_token', '_method']);
        $data = [];
        $isivarian = [];
        // dd($request);

        $data['produk_id'] = $request->produk_id;
        $data['jenis_varian'] = $request->jenis_varian;
        // $data['thubmnail'] = 0;
        
        // dd($data);
        $store = Varian::create($data);

        if ($store) {
            $id_prim = $store->id;

            foreach ($request->isi_varian as $key => $value) {
                // dd($isi);
                if ($value != null) {
                    $isivarian['varian_id'] = $id_prim;
                $isivarian['varian'] = $value;
                // $isivarian['thubmnail'] = 0;

                $store2 = IsiVarian::create($isivarian);
                }
            
            }
        }

        return redirect('/varian')->with('success', 'Varian berhasil ditambahkan!');
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
        $varian = Varian::find($id);
        $list_produk = Produk::all();
        return view('varian.edit', compact('varian', 'list_produk'));
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
        $data = $request->except(['_token', '_method']);

        $varian = Varian::find($id);
        $detail_varian = IsiVarian::where('varian_id', $id)->delete(); //ngambil data isi varian yang mau di hapus
        
        // dd($request);

        $data = [];
        $isivarian = [];
        // dd($request);

        $data['produk_id'] = $request->produk_id;
        $data['jenis_varian'] = $request->jenis_varian;
        
        // dd($data);
        $store = $varian->update($data);

        if ($store) {
            $id_prim = $varian->id;

            foreach ($request->isi_varian as $key => $value) {
                // dd($isi);
                if ($value != null) {
                    $isivarian['varian_id'] = $id_prim;
                $isivarian['varian'] = $value;
                

                $store2 = IsiVarian::create($isivarian);
                }
            
            }
        }

        return redirect('/varian')->with('success', 'Varian berhasil diedit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $varian = Varian::find($id);
        $varian->delete();

        return redirect('/varian')->with('success', 'varian berhasil dihapus!');
    }
}
