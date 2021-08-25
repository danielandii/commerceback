<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\produk;
use App\kategori;
use App\User;
use App\order;
use App\kirim;
use App\transaksi;



class AdminController extends Controller
{
                                           //CONTROLLER INTI


    public function index()
    {
        return view('Admin/Admin');
    }

                                            //USSERACCOUNT
    public function useracc()
    {
        $user = User::all();
    //  dd($user);
        return view('admin.useracc', ['user' => $user]);
    }

   
                                               //PRODUK
    public function produk()
    {
        $produk = produk::all();
        // dd($produk);
        return view('Admin.produk', ['produk' => $produk ]);
    }

    public function produkadd()
    {
        $produk = produk::all();
        $kategori = kategori::all();
        return view('Admin/produkadd', ['produk' => $produk, 'kategori' => $kategori]);
    }

    public function produk_process(Request $request)
    {
        // dd($request);

        $this->validate($request, [
            // 'id_kategori' => 'required',
            'nama_brg' => 'required',
            'stok_brg' => 'required',
            'harga_brg' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
            
        ]);

        // menyimpan data file yang diupload ke variabel $file
        $produk = $request->file('gambar');

        $nama_file = time() . "_" . $produk->getClientOriginalName();

        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'images';
        $produk->move($tujuan_upload, $nama_file);

        produk::create([
            
            'gambar' => $nama_file,
            'nama_brg' => $request->nama_brg,
            'stok_brg' => $request->stok_brg,
            'harga_brg' => $request->harga_brg,
            'deskripsi' => $request->deskripsi,
            'id_kategori'=> $request->id_kategori,
            
            
        ]);

        return redirect('/produk');
    }

    public function produk_delete($gambar)
    {
        produk::where('gambar', $gambar)
            ->delete();
        return redirect()->action('AdminController@produk');
    }


    public function editproduk($id_kategori)
    {
        $produk = DB::table('produk')->where('id_kategori',$id_kategori)->get();
        return view('Admin.editproduk', ['produk' => $produk]);
    }

    public function update(Request $request)
    {
	DB::table('produk')->where('id_kategori',$request->id)->update([
		'nama_brg' => $request->nama,
		'stok_brg' => $request->stok,
		'harga_brg' => $request->harga,
		'deskripsi' => $request->deskripsi,
        
	]);
	return redirect('/produk');
    }

    
                                                // KATEGORI
     public function kategori()
     {
         $kategori = kategori::get();
         return view('Admin.kategori', ['kategori' => $kategori]);
     }

     public function kategoriadd()
    {
        $kategori = kategori::get();
        return view('Admin/kategoriadd', ['kategori' => $kategori]);
    }

    public function kategori_process(Request $request)
    {
        $this->validate($request, [
            
            'jenis' => 'required',
            'gambar' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
            
        ]);

        // menyimpan data file yang diupload ke variabel $file
        $kategori = $request->file('gambar');

        $nama_file = time() . "_" . $kategori->getClientOriginalName();

        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'images';
        $kategori->move($tujuan_upload, $nama_file);

        kategori::create([
            
            'jenis' => $request->jenis,
            'gambar' => $nama_file,
            
        ]);

        return redirect('/kategori');
    }

    public function kategori_delete($gambar)
    {
        kategori::where('gambar', $gambar)
            ->delete();
        return redirect()->action('AdminController@kategori');
    }

    public function editkategori($id)
    {
        $kategori = DB::table('kategori')->where('id',$id)->get();
        return view('Admin.editkategori', ['kategori' => $kategori]);
    }

    public function updatekategori(Request $request)
    {
	DB::table('kategori')->where('id',$request->id)->update([
		'jenis' => $request->jenis,
		
	]);
	return redirect('/kategori');
    }


                                                  //kirim

     public function kirim()
     {  
         $kirim = kirim::all();                                           
     return view('Admin.kirim', ['kirim' => $kirim]);
     }
 
     
     public function kirimadd()
     {
         $kirim = kirim::all();
         return view('Admin/kirimadd', ['kirim' => $kirim]);
     }
 
     public function kirim_process(Request $request)
     {
         $this->validate($request, [
             
             'jenis' => 'required',
             'waktu' => 'required',
             'harga' => 'required',
             
         ]);
 
         
         kirim::create([
             
             'jenis' => $request->jenis,
             'waktu' => $request->waktu,
             'harga' => $request->harga,
            
             
         ]);
 
         return redirect('/kirim');
     }
 
     public function kirim_delete($jenis)
     {
         kirim::where('jenis', $jenis)
             ->delete();
         return redirect()->action('AdminController@kirim');
     }
 
     public function editkirim($id)
     {
         
         $kirim = DB::table('kirims')->where('id',$id)->get();
         
         return view('Admin.editkirim', ['kirims' => $kirim]);
     }
 
     public function updatekirim(Request $request)
     {
     DB::table('kirims')->where('id',$request->id)->update([
         'jenis' => $request->jenis,
         'waktu' => $request->waktu,
         'harga' => $request->harga,
         
     ]);
     return redirect('/kirim');
     }
                                                    //TES
                                                
public function tes()
{
//     $produk = produk::all();
//     return view('tes.tes',['produk' =>$produk]);
//     dd($produk);
// }

$user = User::all();
//  dd($user);
    return view('tes.tes', compact('user'));
}

// public function create()
// {
//     $groups = Hotel_group::all();

//     return view('hotels.create', compact('groups'));
// }

    

    
                                                //KERANJANG
public function order()
{
    
    $order = order::all();
    return view('admin.order', ['order' => $order]);
}

public function orderadd()
{
    $order = order::all();
    $User = User::all();
    $produk = produk::all();
    return view('admin/orderadd', ['order' => $order, 'User' => $User, 'produk' => $produk]);
}



public function order_process(Request $request)
{
    // dd($request);

    // $this->validate($request, [
    
    //     'nama_brg' => 'required',
    //     // 'harga_brg' => 'required',
    //     'jumlah_brg' => 'required',
    //     'catatan' => 'required'
        
        
    // ]);
//ambil database dr tabel lain


$produk=produk::find($request->nama_brg);
// dd($produk);

    // menyimpan data file yang diupload ke variabel $file
    // $order = $request->file('gambar');

    // $nama_file = time() . "_" . $order->getClientOriginalName();

    // isi dengan nama folder tempat kemana file diupload
    // $tujuan_upload = 'images';
    // $order->move($tujuan_upload, $nama_file);

    order::create([
        
        'gambar' => $produk->gambar,
        'id_user' => $request->id_user,
        'nama_brg' => $produk->nama_brg,
        'harga_brg' => $produk->harga_brg,
        'jumlah_brg' => $request->jumlah_brg,
        'catatan' => $request->catatan,
        
        
        
    ]);

    return redirect('/order');
}
        
public function order_delete($gambar)
    {
        order::where('gambar', $gambar)
            ->delete();
        return redirect()->action('AdminController@order');
    }



                                            //TRANSAKSI
// public function transaksi()
// {                                             
//    return view('Admin.transaksi');
// }

public function transaksi()
    {
        $transaksi = transaksi::all();
        $User = User::all();
    //  dd($user);
        return view('Admin.transaksi', ['transaksi' => $transaksi , 'User' => $User ]);
    }

    public function transaksiadd()
    {
        $transaksi = transaksi::get();
        $kirim = kirim::all();
        $order = order::select('id_user')->groupBy('id_user')->get();
        return view('Admin/transaksiadd', ['transaksi' => $transaksi, 'order' => $order, 'kirim' =>$kirim]);
    }

    public function transaksi_process(request $request)
    
    {

        $id_user = $request->id_user;

        $kirim = kirim::all();
        $order = order::where('id_user', $id_user)->get();
        $max = transaksi::max('id');

        return view('/admin.detailtransaksi', ['order' => $order, 'kirim' => $kirim, 'max' => $max]);
    }
 
    // public function detailtransaksi()
    // {
       
    //     $order = order::get();
    //     return view('Admin.detailtransaksi', ['order', $order]);
    // }



    //DETAIL TRANSAKSI 1
    public function detailtransaksi1()
    {
        $transaksi = transaksi::all();
        $kirim = kirim::all();
        
        return view('/admin.detailtransaksi1', ['kirim' => $kirim, 'transaksi' => $transaksi]);
    }

    public function detailtransaksi1process (Request $request)
    {
       dd($request);
        $this->validate($request, [
             
            'alamat' => 'required',
            'catatan' => 'required',
            'tanggal' => 'required',
            'invoice' => 'invoice',
            
        ]);

        
        transaksi::create([
            
            'alamat' => $request->alamat,
            'catatan' => $request->catatan,
            'tanggal' => $request->tanggal,
            'invoice' => $request->invoice,
            
        ]);

        return redirect('/transaksi');
    }
    
    //-------------------------------------------------------------------------------------------------------------
}

//-------------------------------------------------------------------------------------------------------------------


   

    


