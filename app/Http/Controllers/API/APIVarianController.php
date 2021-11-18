<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Varian;
use App\Model\Produk;
use App\Model\IsiVarian;

class APIVarianController extends Controller
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

        $result = [];
        $i = 0;
        foreach ($varian as $var) {
            $result[$i]['id'] = $var->id;
            $result[$i]['Nama Produk'] = @$var->produk->nama;
            $result[$i]['Jenis Varian'] = $var->jenis_varian;
            $j = 0;
            foreach ($var->isi_varian as $isivn) {
                $result[$i]['Varian'][$j] =$isivn->varian;
                $j++;
            }
            $i++;
        }

        return response()->json([
            'data' => $result
        ]);
    }

    /**
     * Show the form for creating a new resource.ph
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
            'jenis_varian'=>'required',            
        ]);

        $data = [];
        $isivarian = [];

        $data['produk_id'] = $request->produk_id;
        $data['jenis_varian'] = $request->jenis_varian;
        
        $store = Varian::create($data);

        if ($store) {
            $id_prim = $store->id;

            foreach ($request->isi_varian as $key => $value) {
                if ($value != null) {
                    $isivarian['varian_id'] = $id_prim;
                    $isivarian['varian'] = $value;

                    $store2 = IsiVarian::create($isivarian);
                }
            
            }
        }

        return response()->json([
            'message' => 'varian berhasil ditambahkan'
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
        $data = $request->except(['_token', '_method']);

        $varian = Varian::find($id);
        $detail_varian = IsiVarian::where('varian_id', $id)->delete(); //ngambil data isi varian yang mau di hapus
        
        $data = [];
        $isivarian = [];

        $data['produk_id'] = $request->produk_id;
        $data['jenis_varian'] = $request->jenis_varian;
        
        $store = $varian->update($data);

        if ($store) {
            $id_prim = $varian->id;

            foreach ($request->isi_varian as $key => $value) {
                if ($value != null) {
                    $isivarian['varian_id'] = $id_prim;
                $isivarian['varian'] = $value;
                

                $store2 = IsiVarian::create($isivarian);
                }
            
            }
        }

        return response()->json([
            'message' => 'varian berhasil diubah'
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
        $varian = Varian::find($id);
        $varian->delete();

        return response()->json([
            'message' => 'varian berhasil dihapus'
        ], 200);
    }
}
