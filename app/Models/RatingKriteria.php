<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RatingKriteria extends Model
{
    use HasFactory;

    protected $table = 'rating_kriteria';
    protected $primaryKey = 'id_rating';
    protected $fillable = [
        'id_alternatif',
        'id_kriteria',
        'nilai'
    ];

    public function alternatif()
    {
        return $this->belongsTo(Alternatif::class, 'id_alternatif', 'id_alternatif');
    }

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'id_kriteria', 'id_kriteria');
    }
}
