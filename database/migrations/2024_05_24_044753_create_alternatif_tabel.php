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
        Schema::create('alternatif', function (Blueprint $table) {
            $table->increments('id_alternatif');
            $table->string('nama_alternatif', 255);
            $table->text('deskripsi')->nullable();
            $table->unsignedInteger('id_barang');
            $table->foreign('id_barang')->references('id_barang')->on('barang');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alternatif_tabel');
    }
};
