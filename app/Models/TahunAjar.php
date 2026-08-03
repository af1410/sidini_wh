<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAjar extends Model
{
    use HasFactory;

    protected $table = 'tahun_ajar';
    protected $primaryKey = 'id_tahun_ajar';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'tahun_ajar',
        'tahun_mulai',
        'tahun_selesai',
        'status',
        'tanggal_mulai',
        'tanggal_selesai',
        'keterangan',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'tahun_mulai' => 'integer',
        'tahun_selesai' => 'integer',
    ];

    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'id_tahun_ajar', 'id_tahun_ajar');
    }

    public function mapels()
    {
        return $this->hasMany(Mapel::class, 'id_tahun_ajar', 'id_tahun_ajar');
    }

    public function penilaians()
    {
        return $this->hasMany(Penilaian::class, 'id_tahun_ajar', 'id_tahun_ajar');
    }

    public static function getTahunAjarAktif()
    {
        return self::where('status', 'aktif')->first();
    }

    public static function getAllTahunAjar()
    {
        return self::orderBy('tahun_mulai', 'desc')->get();
    }
}
