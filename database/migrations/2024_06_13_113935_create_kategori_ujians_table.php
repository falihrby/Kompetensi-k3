<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKategoriUjiansTable extends Migration
{
    public function up()
    {
        Schema::create('kategori_ujians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('kategori');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kategori_ujians');
    }
}
