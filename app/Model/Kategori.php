<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';
    protected $fillable = ['nama','deskripsi','url_logo'];

    public function produk()
    {
        // return $this->hasMany('App\Model\Produk',);
        return $this->hasMany('App\Model\Produk', 'kategori_id', 'id');
    }
}
