<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NilaiSumatifTugas extends Model
{
    protected $table = 'nilai_sumatif_tugas';

    protected $fillable = [
        'id_sumatif',
        'nama_tugas',
        'nilai',
    ];

    public function sumatif()
    {
        return $this->belongsTo(NilaiSumatif::class, 'id_sumatif', 'id');
    }
}
