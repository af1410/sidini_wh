<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Penilaian;
use App\Models\Siswa;

class NilaiSumatif extends Model
{
    protected $table = 'nilai_sumatif';

    protected $fillable = [
        'id_penilaian',
        'id_siswa',
        'nilai_tes_tulis',
        'nilai_kehadiran',
        'bobot_tes_tulis',
        'bobot_tugas',
        'bobot_kehadiran',
        'nilai_bab',
        'status_data',
    ];

    public function penilaian()
    {
        return $this->belongsTo(Penilaian::class, 'id_penilaian');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
    }

    public function tugas()
    {
        return $this->hasMany(NilaiSumatifTugas::class, 'id_sumatif', 'id');
    }
}
