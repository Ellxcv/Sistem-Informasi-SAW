<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    use HasFactory;

    protected $table = 'alternatif';
    protected $primaryKey = 'id_alternatif';
    protected $fillable = [
        'nama_alternatif',
        'deskripsi',
        'id_barang',
        'nilai_harga', // Kolom untuk nilai Harga
        'nilai_kualitas', // Kolom untuk nilai Kualitas
        'nilai_pelayanan', // Kolom untuk nilai Pelayanan
        'nilai_lokasi', // Kolom untuk nilai Lokasi
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang', 'id_barang');
    }
}



