<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';
    protected $fillable = ['nama','deskripsi','url_logo'];

    public function peminjam()
    {
        return $this->hasMany('App\Produk', 'kategori_id', 'id');
    }
}
