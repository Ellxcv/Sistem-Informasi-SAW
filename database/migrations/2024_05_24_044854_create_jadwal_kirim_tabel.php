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
        Schema::create('jadwal_kirim', function (Blueprint $table) {
            $table->increments('id_jadwal');
            $table->unsignedInteger('id_pengiriman');
            $table->date('tanggal_kirim');
            $table->string('status', 50);
            $table->foreign('id_pengiriman')->references('id_pengiriman')->on('pengiriman');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_kirim_tabel');
    }
};
