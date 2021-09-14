<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Toko extends Model
{
    protected $table = 'toko';
    protected $fillable = ['id','nama','alamat','deskripsi','url_logo'];
    // protected $guarded = ['id'];
}
