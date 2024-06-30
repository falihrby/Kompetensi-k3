<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUjianKeBerapaToKompetensiResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kompetensi_results', function (Blueprint $table) {
            $table->integer('ujian_ke_berapa')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kompetensi_results', function (Blueprint $table) {
            $table->dropColumn('ujian_ke_berapa');
        });
    }
}
