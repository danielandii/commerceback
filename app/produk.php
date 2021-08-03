<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class produk extends Model
{
    protected $table = "produk";

    protected $fillable = ['id_kategori', 'nama_brg', 'stok_brg', 'harga_brg', 'deskripsi', 'gambar'];

    public function kategori()
    {
        return $this->belongsTo('App\kategori', 'id_kategori', 'id');
    }

    
}

