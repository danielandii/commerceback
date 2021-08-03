<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kategori extends Model
{
    protected $table = "kategori";

    protected $fillable = ['id', 'jenis', 'gambar'];

    public function produk()
    {
        return $this->hasMany('App\produk', 'id', 'id_kategori');
    }
}

