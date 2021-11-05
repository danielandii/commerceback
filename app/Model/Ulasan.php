<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ulasan extends Model
{
    protected $table = 'ulasan';
       protected $guarded = ['id', 'created_at', 'update_at'];

    // use SoftDeletes;

    public function produk()
    {
        return $this->belongsTo('App\Model\Produk', 'produk_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\Model\User', 'user_id', 'id');
    }

    public function gambar_ulasan()
    {
        return $this->hasMany('App\Model\GambarUlasan', 'ulasan_id', 'id');
    }
}
