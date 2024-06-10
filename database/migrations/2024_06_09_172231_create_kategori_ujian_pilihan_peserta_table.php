<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKategoriUjianPilihanPesertaTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Disable foreign key checks
        Schema::disableForeignKeyConstraints();

        Schema::create('kategori_ujian_pilihan_peserta', function (Blueprint $table) {
            $table->id();
            $table->foreignId('peserta_id')->constrained('pesertas')->onDelete('cascade');
            $table->string('kategori_ujian_pilihan');
            $table->string('nama'); // Adding nama column
            $table->timestamps();
        });

        // Enable foreign key checks
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Disable foreign key checks
        Schema::disableForeignKeyConstraints();

        Schema::dropIfExists('kategori_ujian_pilihan_peserta');

        // Enable foreign key checks
        Schema::enableForeignKeyConstraints();
    }
}
