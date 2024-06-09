<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKompetensiResultsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kompetensi_results', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nomor');
            $table->string('program');
            $table->string('fakultas');
            $table->string('instansi');
            $table->string('kategori_ujian');
            $table->string('keterangan');
            $table->timestamp('waktu_mulai_ujian')->nullable();
            $table->timestamp('waktu_selesai_ujian')->nullable();
            $table->integer('jumlah_soal_benar');
            $table->integer('jumlah_soal_salah');
            $table->integer('total_questions')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kompetensi_results');
    }
}
