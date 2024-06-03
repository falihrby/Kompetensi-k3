<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoalKompetensiTable extends Migration
{
    public function up()
    {
        Schema::create('soal_kompetensi', function (Blueprint $table) {
            $table->id();
            $table->string('kategori');
            $table->text('pertanyaan');
            $table->text('opsi_a');
            $table->text('opsi_b');
            $table->text('opsi_c');
            $table->text('opsi_d');
            $table->string('kunci_jawaban');
            $table->string('gambar')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('soal_kompetensi');
    }
}
