<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Varian;
use App\Model\Produk;

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
        $produk = Produk::all();

        return view('varian.index', compact('varian'));
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

        $data = $request->except(['_token', '_method']);
        $store = Varian::create($data);

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
        $list_produk = produk::all();
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

        $varian->update($data);

        return redirect('/varian')->with('success', 'varian berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $varian = varian::find($id);
        $varian->delete();

        return redirect('/varian')->with('success', 'varian berhasil dihapus!');
    }
}
