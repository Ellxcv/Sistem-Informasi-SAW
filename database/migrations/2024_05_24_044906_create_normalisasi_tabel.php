<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('normalisasi', function (Blueprint $table) {
            $table->increments('id_normalisasi');
            $table->unsignedInteger('id_alternatif');
            $table->unsignedInteger('id_kriteria');
            $table->float('nilai_normalisasi');
            $table->foreign('id_alternatif')->references('id_alternatif')->on('alternatif');
            $table->foreign('id_kriteria')->references('id_kriteria')->on('kriteria');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('normalisasi_tabel');
    }
};
