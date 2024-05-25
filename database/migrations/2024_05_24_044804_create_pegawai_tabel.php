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
        Schema::create('pegawai', function (Blueprint $table) {
            $table->increments('id_pegawai');
            $table->string('nama_pegawai', 255);
            $table->string('jabatan', 50);
            $table->string('nomor_telepon', 20);
            $table->unsignedInteger('id_toko');
            $table->foreign('id_toko')->references('id_toko')->on('toko');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai_tabel');
    }
};
