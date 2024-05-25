<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeNilaiToDoubleInRatingKriteriaTable extends Migration
{
    public function up()
    {
        Schema::table('rating_kriteria', function (Blueprint $table) {
            $table->double('nilai')->change();
        });
    }

    public function down()
    {
        Schema::table('rating_kriteria', function (Blueprint $table) {
            $table->float('nilai')->change();
        });
    }
}

