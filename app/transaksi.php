<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    protected $fillable = ['id', 'id_order', 'id_user', 'invoice', 'alamat', 'total', 'tanggal', 'catatan', 'bukti_tf', 'jumlah_brg', 'gambar'];
}
