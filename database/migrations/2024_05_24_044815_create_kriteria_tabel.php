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
        Schema::create('kriteria', function (Blueprint $table) {
            $table->increments('id_kriteria');
            $table->string('nama_kriteria', 255);
            $table->text('deskripsi')->nullable();
            $table->float('bobot');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kriteria_tabel');
    }
};
