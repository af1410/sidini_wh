<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Guru;
use App\Models\Mapel;
use App\Models\GuruMapel;
use App\Models\KelasMapel;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';
    protected $primaryKey = 'id_kelas';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_kelas',
        'tahun_ajar',
        'kelas',
        'rombel',
        'nama_kelas',
        'id_guru',
    ];

    public function waliKelas()
    {
        return $this->belongsTo(Guru::class, 'id_guru', 'id_guru');
    }

    public function mapels()
    {
        return $this->belongsToMany(Mapel::class, 'kelas_mapel', 'id_kelas', 'id_mapel');
    }

    public function siswas()
    {
        return $this->hasMany(Siswa::class, 'id_kelas', 'id_kelas');
    }

    public function kelasMapel()
    {
        return $this->hasMany(
            KelasMapel::class,
            'id_kelas',
            'id_kelas'
        );
    }
}
