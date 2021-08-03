<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\produk;

class APIController extends Controller
{
    public function getproduk()
    {
        $produk = produk::all();
        // if ($produk!=null[]) {
        if ($produk) {
            # code...
            // success json
            return response()->json([
                'code' => 200,
                'message' => 'Success',
                'data' =>  $produk,
            ], 200);
        }
        else {
            
            // error json
                    return response()->json([
                        'code' => 400,
                        'message' => 'Error',
                        'data' =>  'data not found',
                    ], 400);
                }
        }
}


