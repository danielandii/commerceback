<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class rekening extends Model
{
    protected $fillable = ['id', 'bank', 'nama', 'rekening'];
}
