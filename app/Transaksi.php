<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $guarded=[]; //yg ngurusi saat kita masukkan data

    public function tiket()
    {
        return $this->belongsTo(Tiket::class, 'id_tiket');
    }

}
