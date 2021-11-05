<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $guarded = ['id', 'created_at', 'update_at'];

    public function bukti_pembayaran()
    {
        return $this->hasOne('App\Model\BuktiPembayaran', 'transaksi_id', 'id');
    }

    public function detail_transaksi()
    {
        return $this->hasOne('App\Model\DetailTransaksi', 'transaksi_id', 'id');
    }
}
