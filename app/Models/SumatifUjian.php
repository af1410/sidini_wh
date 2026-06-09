<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SumatifUjian extends Model
{
    protected $table = 'nilai_sumatif_ujian';

    protected $fillable = [
        'id_penilaian',
        'id_siswa',
        'nilai_ujian',
    ];

    public function penilaian()
    {
        return $this->belongsTo(
            Penilaian::class,
            'id_penilaian'
        );
    }

    public function siswa()
    {
        return $this->belongsTo(
            Siswa::class,
            'id_siswa'
        );
    }
}
