<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class IsiVarian extends Model
{
    protected $table = 'isi_varian';
    protected $fillable = ['varian_id','varian'];

    public function varians()
    {
        return $this->belongsTo('App\Model\Varian', 'varian_id', 'id');
    }

}
