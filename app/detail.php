<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class detail extends Model
{
    protected $fillable = ['id', 'id_transaksi',  'nama_brg', 'harga_brg', 'jumlah_brg', 'sub_total', 'catatan'];
}
