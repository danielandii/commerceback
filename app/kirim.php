<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kirim extends Model
{
    protected $fillable = ['id', 'jenis', 'waktu', 'harga'];
}
