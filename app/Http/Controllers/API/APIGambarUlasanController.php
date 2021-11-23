<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\GambarUlasan;
use Illuminate\Http\Request;

class APIGambarUlasanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gambar = GambarUlasan::all();

        return response()->json([
            'data' => $gambar
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gambar = GambarUlasan::find($id);
        $delete = $gambar->delete();
            if($delete){
                    if(file_exists(public_path($gambar->url_gambar))){
                        \File::delete(public_path($gambar->url_gambar));
                    }
            }
            return response()->json([
                'message' => 'gambar ulasaan berhasail dihapus',
                'data' => $gambar
            ], 200);
    }
}
