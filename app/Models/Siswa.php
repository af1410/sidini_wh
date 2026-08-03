<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Kelas;

class Siswa extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'siswa';
    protected $primaryKey = 'id_siswa';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'nim',
        'nisn',
        'nik',
        'nama_siswa',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'alamat',
        'no_hp',
        'email',
        'username',
        'uid_kartu',
        'password',
        'gambar',
        'id_kelas',
        'status',
        'angkatan',
        'asal_sekolah'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function dataKelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

    public function nilaiSumatif()
    {
        return $this->hasMany(NilaiSumatif::class, 'id_siswa', 'id_siswa');
    }

    public function nilaiUjian()
    {
        return $this->hasMany(SumatifUjian::class, 'id_siswa', 'id_siswa');
    }

    public function nilaiAkhir()
    {
        return $this->hasMany(
            NilaiAkhir::class,
            'id_siswa',
            'id_siswa'
        );
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

    public function riwayatKelas()
    {
        return $this->hasMany(SiswaKelas::class, 'id_siswa', 'id_siswa');
    }
}
