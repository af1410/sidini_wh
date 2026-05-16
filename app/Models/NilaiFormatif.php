<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Penilaian;
use App\Models\Siswa;

class NilaiFormatif extends Model
{
    protected $table = 'nilai_formatif';

    protected $fillable = [
        'id_penilaian',
        'id_siswa',
        'nilai_uas',
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
}
