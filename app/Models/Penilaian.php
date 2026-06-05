<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\NilaiFormatif;
use App\Models\NilaiSumatif;

class Penilaian extends Model
{
    protected $table = 'penilaian';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_guru',
        'id_mapel',
        'id_kelas',
        'semester',
        'jenis_penilaian',
        'bab_ke',
        'judul_bab',
        'tanggal_mulai',
        'tanggal_selesai',
        'status_buka',
        'status_approval',
        'dibuka_oleh',
        'approved_oleh',
        'approved_at',
        'catatan',
    ];

    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'id_mapel', 'id_mapel');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru', 'id_guru');
    }

    public function nilaiFormatif()
    {
        return $this->hasMany(NilaiFormatif::class, 'id_penilaian');
    }

    public function nilaiSumatif()
    {
        return $this->hasMany(NilaiSumatif::class, 'id_penilaian');
    }
}
