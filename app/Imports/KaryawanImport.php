<?php

namespace App\Imports;

use App\Models\Karyawan;
use Maatwebsite\Excel\Concerns\ToModel;

class KaryawanImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Karyawan([
            'nama' => $row[1],
            'jeniskelamin' => $row[2],
            'notelpon' => $row[3],
            'foto' => $row[4]
        ]);
    }
}
