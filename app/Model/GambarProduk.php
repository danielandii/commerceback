<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GambarProduk extends Model
{
    protected $table = 'gambar_produk';
    protected $guarded = ['id', 'created_at', 'update_at'];

    public function produk()
    {
        return $this->belongsTo('App\Model\Produk', 'produk_id', 'id');
    }
}
