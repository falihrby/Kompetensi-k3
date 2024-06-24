<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporansTable extends Migration
{
    public function up()
    {
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nomor_ujian');
            $table->string('program_studi');
            $table->string('fakultas');
            $table->string('instansi');
            $table->string('kategori_ujian');
            $table->string('keterangan');
            $table->timestamp('waktu_mulai')->nullable();
            $table->timestamp('waktu_selesai')->nullable();
            $table->integer('total_soal');
            $table->integer('jumlah_soal_benar');
            $table->integer('jumlah_soal_salah');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('laporans');
    }
}
