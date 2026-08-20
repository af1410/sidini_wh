<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NilaiFormatif extends Model
{
    protected $table = 'nilai_formatif';

    protected $fillable = [
        'id_penilaian',
        'id_siswa',
        'bab_ke',
        'pertemuan_ke',
        'tanggal_input',
        'nilai_bab',
        'nilai_formatif',
        'status_data',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
    }

    public function penilaian()
    {
        return $this->belongsTo(Penilaian::class, 'id_penilaian', 'id_penilaian');
    }
}
