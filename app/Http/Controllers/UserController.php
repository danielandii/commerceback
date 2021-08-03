<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //          CONTROLLER BUAT HALAMAN USER
    public function index()
    {
       
        $produk = DB::table('pegawai')->get();
        return view('user/user',['produk' =>$produk]);
    }

}
