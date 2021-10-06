<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';
    // protected $fillable = ['nama','deskripsi','url_logo'];
    protected $guarded = ['id', 'created_at', 'update_at'];

    public function kategori()
    {
        // return $this->belongsTo('App\Model\Produk');
        return $this->belongsTo('App\Model\Kategori', 'kategori_id', 'id');
    }

    public function varian()
    {
        return $this->hasMany('App\Model\Varian', 'produk_id', 'id');
    }

    public function isivarian()
    {
        return $this->hasMany('App\Model\IsiVarian', 'produk_id', 'id');
    }

    public function gambar()
    {
        return $this->hasMany('App\Model\GambarProduk', 'produk_id', 'id');
    }
}
