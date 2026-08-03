<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerlengkapanRapor extends Model
{
    use HasFactory;

    protected $table = 'perlengkapan_rapor';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id_siswa',
        'id_kelas',
        'id_tahun_ajar',

        'sakit',
        'izin',
        'alpa',

        'catatan_wali_kelas',

        'status_acc',
        'approved_at',
        'approved_by',
    ];

    protected $casts = [
        'approved_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATION
    |--------------------------------------------------------------------------
    */

    public function siswa()
    {
        return $this->belongsTo(
            Siswa::class,
            'id_siswa',
            'id_siswa'
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

    public function tahunAjar()
    {
        return $this->belongsTo(
            TahunAjar::class,
            'id_tahun_ajar',
            'id_tahun_ajar'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | ATTRIBUTE
    |--------------------------------------------------------------------------
    */

    public function getBadgeStatusAttribute()
    {
        return match ($this->status_acc) {
            'disetujui' => 'success',
            'ditolak' => 'danger',
            default => 'warning',
        };
    }

    public function getTextStatusAttribute()
    {
        return match ($this->status_acc) {
            'disetujui' => 'Disetujui',
            'ditolak' => 'Ditolak',
            default => 'Menunggu ACC',
        };
    }

    public function ekskul()
    {
        return $this->hasMany(Ekskul::class, 'perlengkapan_rapor_id', 'id');
    }

    public function prestasi()
    {
        return $this->hasMany(Prestasi::class, 'perlengkapan_rapor_id', 'id');
    }

    public function approver()
    {
        return $this->belongsTo(
            Guru::class,
            'approved_by',
            'id_guru'
        );
    }
}
