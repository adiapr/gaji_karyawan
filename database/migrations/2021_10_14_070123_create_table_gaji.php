<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableGaji extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_gaji', function (Blueprint $table) {
            $table->id();
            $table->string('nama_karyawan');
            $table->string('email');
            $table->date('tanggal');
            $table->integer('gp');
            $table->integer('tunjangan');
            $table->integer('bonus');
            $table->integer('pot_hadir');
            $table->integer('pot_telat');
            $table->integer('penyesuaian');
            $table->integer('tgl_merah');
            $table->integer('produktivitas');
            $table->integer('total_gaji');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_gaji');
    }
}
