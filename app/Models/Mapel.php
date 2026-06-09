<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Kelas;
use App\Models\Guru;

class Mapel extends Model
{
    protected $table = 'mapel';
    protected $primaryKey = 'id_mapel';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id_mapel',
        'nama_mapel',
        'jenis_mapel',
        'tahun_ajaran',
        'id_guru',
    ];

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru', 'id_guru');
    }

    public function guruMapels()
    {
        return $this->hasMany(
            GuruMapel::class,
            'id_mapel',
            'id_mapel'
        );
    }

    public function Penilaian()
    {
        return $this->hasMany(Penilaian::class, 'id_mapel', 'id_mapel');
    }

    public function nilaiAkhir()
    {
        return $this->hasMany(NilaiAkhir::class, 'id_mapel', 'id_mapel');
    }

    public function kelas()
    {
        return $this->belongsToMany(Kelas::class, 'kelas_mapel', 'id_mapel', 'id_kelas');
    }

    public function kelasMapel()
    {
        return $this->hasMany(
            KelasMapel::class,
            'id_mapel',
            'id_mapel'
        );
    }
}
