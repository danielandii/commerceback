<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\produk;
use App\kategori;
use App\kirim;
use App\rekening;
use App\user;
use App\order;
use App\transaksi;


class APIController extends Controller
{
    public function getproduk()
    {
        $produk = produk::all();
        // dd($produk);
        // if ($produk!=null[]) {
        if ($produk) {
            # code...
            // success json
            return response()->json([
                'code' => 200,
                'message' => 'Success',
                'data' =>  $produk,
            ], 200);
        } else {

            // error json
            return response()->json([
                'code' => 400,
                'message' => 'Error',
                'data' =>  'data not found',
            ], 400);
        }
    }

    public function getkategori()
    {
        $kategori = kategori::all();
        // dd($kategori);
        // if ($kategori!=null[]) {
        if ($kategori) {
            # code...
            // success json
            return response()->json([
                'code' => 200,
                'message' => 'Success',
                'data' =>  $kategori,
            ], 200);
        } else {

            // error json
            return response()->json([
                'code' => 400,
                'message' => 'Error',
                'data' =>  'data not found',
            ], 400);
        }
    }

    public function getkirim()
    {
        $kirim = kirim::all();
        // dd($kirim);
        // if ($kirim!=null[]) {
        if ($kirim) {
            # code...
            // success json
            return response()->json([
                'code' => 200,
                'message' => 'Success',
                'data' =>  $kirim,
            ], 200);
        } else {

            // error json
            return response()->json([
                'code' => 400,
                'message' => 'Error',
                'data' =>  'data not found',
            ], 400);
        }
    }


    public function getrekening()
    {
        $rekening = rekening::all();
        // dd($rekening);
        // if ($rekening!=null[]) {
        if ($rekening) {
            # code...
            // success json
            return response()->json([
                'code' => 200,
                'message' => 'Success',
                'data' =>  $rekening,
            ], 200);
        } else {

            // error json
            return response()->json([
                'code' => 400,
                'message' => 'Error',
                'data' =>  'data not found',
            ], 400);
        }
    }


    public function getuser()
    {
        $user = user::all();
        // dd($user);
        // if ($user!=null[]) {
        if ($user) {
            # code...
            // success json
            return response()->json([
                'code' => 200,
                'message' => 'Success',
                'data' =>  $user,
            ], 200);
        } else {

            // error json
            return response()->json([
                'code' => 400,
                'message' => 'Error',
                'data' =>  'data not found',
            ], 400);
        }
    }


    public function getorder()
    {
        $order = order::all();
        // dd($order);
        // if ($order!=null[]) {
        if ($order) {
            # code...
            // success json
            return response()->json([
                'code' => 200,
                'message' => 'Success',
                'data' =>  $order,
            ], 200);
        } else {

            // error json
            return response()->json([
                'code' => 400,
                'message' => 'Error',
                'data' =>  'data not found',
            ], 400);
        }
    }

    public function gettransaksi()
    {
        $transaksi = transaksi::all();
        // dd($transaksi);
        // if ($transaksi!=null[]) {
        if ($transaksi) {
            # code...
            // success json
            return response()->json([
                'code' => 200,
                'message' => 'Success',
                'data' =>  $transaksi,
            ], 200);
        } else {

            // error json
            return response()->json([
                'code' => 400,
                'message' => 'Error',
                'data' =>  'data not found',
            ], 400);
        }
    }
    //----------------------------------------------------------------------------------------------------------
}
