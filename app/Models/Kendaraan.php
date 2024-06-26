<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    use HasFactory;

    protected $table = 'kendaraan';
    protected $primaryKey = 'id_kendaraan';
    protected $fillable = [
        'nama_kendaraan',
        'nomor_plat',
        'kapasitas'
    ];
}

