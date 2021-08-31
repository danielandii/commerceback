<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    protected $fillable = ['id', 'id_user', 'invoice', 'alamat', 'totalharga', 'tanggal', 'catatan', 'bukti_tf', 'jenis'];

    public function user()
    {
        return $this->belongsTo('App\User', 'id_user', 'id');
    }
}


