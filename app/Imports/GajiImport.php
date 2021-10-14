<?php

namespace App\Imports;

use App\Models\Gaji;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Validators\Failure;

class GajiImport implements
                    ToModel,
                    WithHeadingRow,
                    SkipsOnError,
                    // WithValidation,
                    SkipsOnFailure
{
    use Importable, SkipsErrors, SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $total_gaji=  $row['gp'] + $row['bonus'] + $row['tunjangan'] + $row['penyesuaian'] + $row['tgl_merah'] + $row['produktivitas'] - $row['pot_hadir'] - $row['pot_telat'];
        return new Gaji([
            //
            'nama_karyawan'     =>$row['nama'],
            'email'             =>$row['email'],
            // 'tanggal'             =>$row['tanggal'],
            'tanggal'           =>date('Y-m-d'),
            'gp'                =>$row['gp'],
            'tunjangan'         =>$row['tunjangan'],
            'bonus'             =>$row['bonus'],
            'pot_hadir'         =>$row['pot_hadir'],
            'pot_telat'         =>$row['pot_telat'],
            'penyesuaian'       =>$row['penyesuaian'],
            'tgl_merah'         =>$row['tgl_merah'],
            'produktivitas'     =>$row['produktivitas'],
            'total_gaji'        =>$total_gaji
        ]);
    }

    public function onError(\Throwable $e){

    }

    // Validasi isi (Akan berhenti saat value)
    public function rules():array{
        return[
            '*.email'       => ['email', 'unique:table_gaji,email']
        ];
    }

    // menghindari berhenti saat salah
    // public function onFailure(Failure ...$failures){

    // }

}
