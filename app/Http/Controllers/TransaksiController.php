<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Transaksi;
use App\Model\Produk;
use App\Model\BuktiPembayaran;
use App\Model\DetailTransaksi;
use Excel;
use App\Exports\PesananExport;
use App\Exports\PenjualanExport;




class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaksi = Transaksi::all();      

        return view('transaksi.index', compact('transaksi'));
    }
    
    public function index1() //belum sampai customer
    {
        $transaksi = Transaksi::where('status', '1')->orWhere('status', '2')->get();

        return view('transaksi.index_pesanan', compact('transaksi'));
    }

    public function index2() //sudah sampai customer
    {
        $transaksi = Transaksi::where('status', '3')->get();

        return view('transaksi.index_penjualan', compact('transaksi'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list_produk = Produk::where('stok', '>', '0')->get();
        // $user = User::all();
        return view('transaksi.create', compact('list_produk'));
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
            'alamat'=>'required',
            'no_telp'=>'required',
            'produk_id'=>'required',
            'jumlah'=>'required',
            'metode_pembayaran'=>'required',
            'status'=>'required',
        ]);

        $huruf = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
        $kodeTransaksi = date('his').strtoupper(substr(str_shuffle($huruf), 0, 7));

        $data['no_pesanan'] = $kodeTransaksi;
        $data['nama'] = $request->nama;
        $data['alamat'] = $request->alamat;
        $data['no_telp'] = $request->no_telp;
        $data['metode_pembayaran'] = $request->metode_pembayaran;
        $data['status'] = $request->status;
        $data['tanggal_transaksi'] = date('Y-m-d');
        
        // dd($data);
        $store = Transaksi::create($data);
        
        
        if ($store) {
            $id_prim = $store->id;
            $produk = Produk::find($request->produk_id);
            

            $produk->stok = $produk->stok - $request->jumlah;
            if ($produk->stok < 0) {
                $produk->stok = 0;
            }
            $produk->update();
            
            $harga = $produk->harga;
            $total = ($harga * ($request->jumlah));
            
            $data2['produk_id'] = $produk->id;
            $data2['transaksi_id'] = $id_prim;
            $data2['jumlah_produk'] = $request->jumlah;
            $data2['harga'] = $harga;
            $data2['total'] = $total;
            
            $store2 = DetailTransaksi::create($data2);
            
    
            
            $gambar = $request->file('url_bukti');
            if ($gambar) {
                // dd($id_prim);


                $data3 = $request->except(['_token', '_method', 'url_bukti']);
            
                $tujuan_upload = 'attachment/bukti_pembayaran'; 
                $gambar = $request->file('url_bukti');
                
                if($gambar){
                    $data3 = [];
                    $nama_gambar = $request->get('nama')."_".$request->get('produk_id')."_".date('his').".".$gambar->getClientOriginalExtension(); //."_".$gambar->getClientOriginalName();
                    $up1 = $gambar->move($tujuan_upload,$nama_gambar);
                    if($up1){
                        
                        $data3['transaksi_id'] = $id_prim;
                        $data3['url_bukti'] = $tujuan_upload.'/'.$nama_gambar;
                    }
                }
            
                $store3 = BuktiPembayaran::create($data3);

            }
        }



        return redirect('/transaksi')->with('success', 'transaksi berhasil disimpan!');
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
        $transaksi = Transaksi::find($id);
        $bukti = BuktiPembayaran::where('transaksi_id', $id)->get();
        $list_produk = Produk::all();
        return view('transaksi.edit', compact('transaksi','bukti','list_produk'));
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
        $data_utama = $request->except(['_token', '_method', 'url_bukti','no_pesanan']);
        $transaksi = Transaksi::find($id);

        $tujuan_upload = 'attachment/bukti_pembayaran';
        $gambar = $request->file('url_bukti');
        
        $data = [];
        if($gambar){
            $hgambar = BuktiPembayaran::where('transaksi_id', $transaksi->id)->delete();
            $nama_gambar = $request->get('nama')."_".$request->get('produk_id')."_".date('his').".".$gambar->getClientOriginalExtension(); //."_".$gambar->getClientOriginalName();
            $up1 = $gambar->move($tujuan_upload,$nama_gambar);
            if($up1){
                
                $data['transaksi_id'] = $transaksi->id;
                $data['url_bukti'] = $tujuan_upload.'/'.$nama_gambar;
    
            }
            $store = BuktiPembayaran::create($data);
        }

        $transaksi->update($data_utama);

        return redirect('/transaksi_pesanan')->with('success', 'transaksi berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaksi = Transaksi::find($id);

        $bukti = BuktiPembayaran::where('transaksi_id', $id);
        $list_bukti = $bukti->get();

        if($bukti->delete()){
            foreach($list_bukti as $tbukti){
                if(file_exists(public_path($tbukti->url_bukti))){
                    \File::delete(public_path($tbukti->url_bukti));
                }
            }
        }

        $transaksi->delete();

        return redirect('/transaksi')->with('success', 'Transaksi berhasil dihapus!');
    }

    public function detail_transaksi($id)
    {
        $halaman = 'transaksi';
        $transaksi = Transaksi::findOrFail($id);
        // $thumb = GambarProduk::where('produk_id', $id)->where('is_thumbnail', 1)->first();
    
        return view('transaksi.detail_transaksi', compact('transaksi', 'halaman'));
    }

    public function PesananExport()
    {
        $pesanan = Transaksi::where('status', '1')->orWhere('status', '2')->get();
        return Excel::download(new PesananExport($pesanan), 'Pesanan.xlsx');
    }

    public function PenjualanExport()
    {
        $penjualan = Transaksi::where('status', '3')->get();
        return Excel::download(new PenjualanExport($penjualan), 'Penjualan.xlsx');
    }
}
