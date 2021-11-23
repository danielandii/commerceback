<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Transaksi;
use App\Model\Produk;
use App\Model\BuktiPembayaran;
use App\Model\DetailTransaksi;



class APITransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }
    
    public function index1() //belum sampai customer
    {
        $transaksi = Transaksi::where('status', '1')->orWhere('status', '2')->get();
        $result = [];
        $i = 0;
        foreach ($transaksi as $trans) {
            $result[$i]['id'] = $trans->id;
            $result[$i]['no_pesanan'] = $trans->no_pesanan;
            $result[$i]['nama'] = $trans->nama;
            $result[$i]['alamat'] = $trans->alamat;
            $result[$i]['no_telp'] = $trans->no_telp;
            $result[$i]['nama_produk'] = @$trans->detail_transaksi->produk->nama;
            $result[$i]['total'] = "Rp. ".format_uang(@$trans->detail_transaksi->total);
            $result[$i]['metode_pembayaran'] = config('custom.metode_pembayaran.'.$trans->metode_pembayaran);
            $result[$i]['tanggal_transaksi'] = $trans->tanggal_transaksi;
            $result[$i]['status'] = config('custom.status.'.$trans->status);
            $i++;
        }

        return response()->json([
            'data' => $result
        ], 200);
    }

    public function index2() //sudah sampai customer
    {
        $transaksi = Transaksi::where('status', '3')->get();
        $result = [];
        $i = 0;
        foreach ($transaksi as $trans) {
            $result[$i]['id'] = $trans->id;
            $result[$i]['no_pesanan'] = $trans->no_pesanan;
            $result[$i]['nama'] = $trans->nama;
            $result[$i]['alamat'] = $trans->alamat;
            $result[$i]['no_telp'] = $trans->no_telp;
            $result[$i]['nama_produk'] = @$trans->detail_transaksi->produk->nama;
            $result[$i]['total'] = "Rp. ".format_uang(@$trans->detail_transaksi->total);
            $result[$i]['metode_pembayaran'] = config('custom.metode_pembayaran.'.$trans->metode_pembayaran);
            $result[$i]['tanggal_transaksi'] = $trans->tanggal_transaksi;
            $result[$i]['status'] = config('custom.status.'.$trans->status);
            $i++;
        }

        return response()->json([
            'data' => $result
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



        return response()->json([
            'message' => 'transaksi berhasil ditambahkan'
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

        return response()->json([
            'message' => 'transaksi berhasil diubah'
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

        return response()->json([
            'message' => 'transaksi berhasil dihapus'
        ], 200);
    }

    public function detail_transaksi($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        $result = [];
            $result['id'] = $transaksi->id;
            $result['no_pesanan'] = $transaksi->no_pesanan;
            $result['nama'] = $transaksi->nama;
            $result['alamat'] = $transaksi->alamat;
            $result['no_telp'] = $transaksi->no_telp;
            $result['nama_produk'] = @$transaksi->detail_transaksi->produk->nama;
            $result['harga_produk'] = "Rp. ".format_uang(@$transaksi->detail_transaksi->harga);
            $result['jumlah_produk'] = @$transaksi->detail_transaksi->jumlah_produk;
            $result['total'] = "Rp. ".format_uang(@$transaksi->detail_transaksi->total);
            $result['metode_pembayaran'] = config('custom.metode_pembayaran.'.$transaksi->metode_pembayaran);
            $result['bukti_pembayaran'] = (@$transaksi->bukti_pembayaran->url_bukti) ? (@$transaksi->bukti_pembayaran->url_bukti) : '-';
            $result['tanggal_transaksi'] = $transaksi->tanggal_transaksi;
            $result['status'] = config('custom.status.'.$transaksi->status);

        return response()->json([
            'data' => $result
        ], 200);
    }

    public function metode_pembayaran()
    {
        $result['metode_pembayaran'] = config('custom.metode_pembayaran');
        return response()->json([
            'data' => $result
        ], 200);
    }

    public function cek_status($no_pesanan)
    {
        $transaksi = Transaksi::where('no_pesanan', $no_pesanan)->get();

        $result = [];
        $i = 0;
        foreach ($transaksi as $trans) {
            $result['no_pesanan'] = $trans->no_pesanan;
            $result['nama'] = $trans->nama;
            $result['alamat'] = $trans->alamat;
            $result['no_telp'] = $trans->no_telp;
            $result['nama_produk'] = @$trans->detail_transaksi->produk->nama;
            $result['harga_produk'] = "Rp. ".format_uang(@$trans->detail_transaksi->harga);
            $result['jumlah_produk'] = @$trans->detail_transaksi->jumlah_produk;
            $result['total'] = "Rp. ".format_uang(@$trans->detail_transaksi->total);
            $result['metode_pembayaran'] = config('custom.metode_pembayaran.'.$trans->metode_pembayaran);
            $result['bukti_pembayaran'] = (@$trans->bukti_pembayaran->url_bukti) ? (@$trans->bukti_pembayaran->url_bukti) : '-';
            $result['tanggal_transaksi'] = $trans->tanggal_transaksi;
            $result['status'] = config('custom.status.'.$trans->status);
            $i++;
        }

        return response()->json([
            'data' => $result
        ], 200);
    }
}
