<?php

namespace App\Imports;

use App\Kategori;
use Maatwebsite\Excel\Concerns\ToModel;

class KategoriImport implements ToModel
{
    /**
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Kategori([
            'nama_kategori'=>$row[0] //0 artinya kita ambil baris A yg ada di file excel
        ]);
    }
}
