<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\IsiVarian;
use App\Model\Varian;

class IsiVarianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $isivarian = IsiVarian::with('varians')->get();
        

        return view('isivarian.index', compact('isivarian'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list_varian = varian::all();
        return view('isivarian.create', compact('list_varian'));
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
            'varian'=>'required',            
        ]);

        $data = $request->except(['_token', '_method']);
        

        $store = IsiVarian::create($data);

        return redirect('/isivarian')->with('sukses', ' Isi Varian berhasil ditambahkan!');
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
        $isivarian = IsiVarian::find($id);
        $list_jenis_varian = Varian::all();
        return view('isivarian.edit', compact('isivarian', 'list_jenis_varian'));
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

        $isivarian = IsiVarian::find($id);
        $isivarian->update($data);

        return redirect('/isivarian')->with('success', 'isi varian berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $isivarian = IsiVarian::find($id);
        $isivarian->delete();

        return redirect('/isivarian')->with('success', 'isi varian berhasil dihapus!');
    }
}
