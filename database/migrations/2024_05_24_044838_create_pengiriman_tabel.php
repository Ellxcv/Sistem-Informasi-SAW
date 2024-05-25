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
        Schema::create('pengiriman', function (Blueprint $table) {
            $table->increments('id_pengiriman');
            $table->unsignedInteger('id_barang');
            $table->unsignedInteger('id_gudang');
            $table->date('tanggal_kirim');
            $table->integer('jumlah');
            $table->unsignedInteger('id_toko');
            $table->unsignedInteger('id_kendaraan');
            $table->unsignedInteger('id_supir');
            $table->foreign('id_barang')->references('id_barang')->on('barang');
            $table->foreign('id_gudang')->references('id_gudang')->on('gudang');
            $table->foreign('id_toko')->references('id_toko')->on('toko');
            $table->foreign('id_kendaraan')->references('id_kendaraan')->on('kendaraan');
            $table->foreign('id_supir')->references('id_supir')->on('supir');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengiriman_tabel');
    }
};
