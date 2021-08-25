<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class invoice extends Model
{
    protected $fillable = ['id', 'order_id', 'prefix', 'nomor'];
}
