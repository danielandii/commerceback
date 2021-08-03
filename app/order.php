<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    // protected $table = "orders";

    protected $fillable = ['id', 'gambar', 'id_user', 'nama_brg', 'harga_brg', 'jumlah_brg', 'catatan'];

    public function user()
    {
        return $this->belongsTo('App\User', 'id_user', 'id');
    }
}
