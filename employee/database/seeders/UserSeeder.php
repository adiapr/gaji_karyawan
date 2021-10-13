<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
// prnting
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')-> insert([
            'name'      => 'Adi Apr',
            'email'     => 'da801100@gmail.com',
            'password'  => Hash::make('ac180115'),
            'role'      => 'admin',
            'telp'      => '083896767513',
            'divisi'    => 'maken',
            'bagian'    => 'IT-Developer'
        ]);

        DB::table('users')-> insert([
            'name'      => 'user',
            'email'     => 'adiapr@gmail.com',
            'password'  => Hash::make('ac180115'),
            'role'      => 'user',
            'telp'      => '08389676751',
            'divisi'    => 'maken',
            'bagian'    => 'CS Deal'
        ]);
    }
}
