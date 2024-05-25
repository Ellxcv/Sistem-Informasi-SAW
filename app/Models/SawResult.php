<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SawResult extends Model
{
    use HasFactory;

    protected $table = 'hasil_saw';
    protected $primaryKey = 'id_hasil_saw';
    protected $fillable = [
        'id_alternatif',
        'nilai_saw',
    ];

    public function alternatif()
    {
        return $this->belongsTo(Alternatif::class, 'id_alternatif', 'id_alternatif');
    }
}
