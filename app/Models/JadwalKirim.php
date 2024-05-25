<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalKirim extends Model
{
    use HasFactory;

    protected $table = 'jadwal_kirim';
    protected $primaryKey = 'id_jadwal';
    protected $fillable = [
        'id_pengiriman',
        'tanggal_kirim',
        'status'
    ];

    public function pengiriman()
    {
        return $this->belongsTo(Pengiriman::class, 'id_pengiriman', 'id_pengiriman');
    }
}

