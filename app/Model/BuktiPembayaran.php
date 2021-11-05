<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BuktiPembayaran extends Model
{
    protected $table = 'bukti_pembayaran';
    protected $guarded = ['id', 'created_at', 'update_at'];

    public function transaksi()
    {
        return $this->belongsTo('App\Model\Transaksi', 'transaksi_id', 'id');
        //transaksi hasOne
    }
}
