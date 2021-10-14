<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    use HasFactory; 

    protected $table = 'table_gaji';

    protected $fillable =[
        'nama_karyawan',
        'email',
        'tanggal',
        'gp',
        'tunjangan',
        'bonus',
        'pot_hadir',
        'pot_telat',
        'penyesuaian',
        'tgl_merah',
        'produktivitas',
        'total_gaji'
    ];
}
