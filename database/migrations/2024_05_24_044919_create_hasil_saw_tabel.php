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
        Schema::create('hasil_saw', function (Blueprint $table) {
            $table->increments('id_hasil');
            $table->unsignedInteger('id_alternatif');
            $table->float('nilai_saw');
            $table->foreign('id_alternatif')->references('id_alternatif')->on('alternatif');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_saw_tabel');
    }
};
