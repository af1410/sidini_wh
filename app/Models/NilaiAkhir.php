<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Mapel;

class NilaiAkhir extends Model
{
    protected $table = 'nilai_akhir';

    protected $fillable = [
        'id_siswa',
        'id_mapel',
        'semester',
        'bobot_formatif',
        'bobot_sumatif',
        'nilai_formatif',
        'nilai_sumatif',
        'nilai_akhir',
    ];

    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'id_mapel', 'id_mapel');
    }
}
