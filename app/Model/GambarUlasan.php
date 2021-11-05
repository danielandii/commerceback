<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GambarUlasan extends Model
{
    protected $table = 'gambar_ulasan';
    protected $guarded = ['id', 'created_at', 'update_at'];

    public function ulasan()
    {
        return $this->belongsTo('App\Model\Ulasan', 'ulasan_id', 'id');
    }
}
