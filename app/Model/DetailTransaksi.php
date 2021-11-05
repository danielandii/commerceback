<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    protected $table = 'detail_transaksi';
    protected $guarded = ['id', 'created_at', 'update_at'];

    public function transaksi()
    {
        return $this->belongsTo('App\Model\Transaksi', 'transaksi_id', 'id');
    }

    public function produk()
    {
        return $this->belongsTo('App\Model\Produk', 'produk_id', 'id');
    }
}