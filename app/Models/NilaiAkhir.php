<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NilaiAkhir extends Model
{
    protected $table = 'nilai_akhir';

    protected $fillable = [
        'id_siswa',
        'id_mapel',
        'id_kelas',
        'semester',

        'bobot_bab',
        'bobot_psts',
        'bobot_psas',

        'rata_bab',
        'rata_bab_formatif',
        'nilai_psts',
        'nilai_psas',

        'nilai_akhir',
        'keterangan',
    ];

    public function siswa()
    {
        return $this->belongsTo(
            Siswa::class,
            'id_siswa',
            'id_siswa'
        );
    }

    public function mapel()
    {
        return $this->belongsTo(
            Mapel::class,
            'id_mapel',
            'id_mapel'
        );
    }

    public function kelas()
    {
        return $this->belongsTo(
            Kelas::class,
            'id_kelas',
            'id_kelas'
        );
    }
}
