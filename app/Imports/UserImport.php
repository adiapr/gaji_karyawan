<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Validators\Failure;

class UserImport implements
    ToModel,
    WithHeadingRow,
    SkipsOnError,
    WithValidation,
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
        return new User([
            'name'      => $row['nama'],
            'email'     => $row['email'],
            'password'  => Hash::make($row['password']),
            'role'      => $row['role'],
            'telp'      => $row['telp'],
            'divisi'    => $row['divisi'],
            'bagian'    => $row['bagian'],
        ]);
    }

    public function onError(\Throwable $e){

    }

    // Validasi isi (Akan berhenti saat value)
    public function rules():array{
        return[
            '*.email'       => ['email', 'unique:users,email']
        ];
    }

    // menghindari berhenti saat salah
    // public function onFailure(Failure ...$failure){

    // }
}
