<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCriteriaColumnsToAlternatifTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('alternatif', function (Blueprint $table) {
            $table->decimal('nilai_harga', 8, 2)->after('nilai')->nullable();
            $table->decimal('nilai_kualitas', 8, 2)->after('nilai_harga')->nullable();
            $table->decimal('nilai_pelayanan', 8, 2)->after('nilai_kualitas')->nullable();
            $table->decimal('nilai_lokasi', 8, 2)->after('nilai_pelayanan')->nullable();

            // Drop kolom nilai
            $table->dropColumn('nilai');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('alternatif', function (Blueprint $table) {
            // Tambahkan kembali kolom nilai
            $table->decimal('nilai', 8, 2)->nullable()->after('id_barang');

            // Drop kolom-kolom baru yang telah ditambahkan
            $table->dropColumn('nilai_harga');
            $table->dropColumn('nilai_kualitas');
            $table->dropColumn('nilai_pelayanan');
            $table->dropColumn('nilai_lokasi');
        });
    }
}

