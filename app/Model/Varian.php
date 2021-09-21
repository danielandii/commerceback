<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Varian extends Model
{
    protected $table = 'varian';
    protected $fillable = ['produk_id','jenis_varian'];

    public function produk()
    {
        return $this->belongsTo('App\Model\Produk', 'produk_id', 'id');
    }

    public function isi_varian()
    {
        return $this->hasMany('App\Model\IsiVarian','varian_id', 'id');
    }
}
