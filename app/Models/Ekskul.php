<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ekskul extends Model
{
    protected $table = 'ekskul';

    protected $fillable = [
        'id',
        'perlengkapan_rapor_id',
        'nama_ekskul',
        'nilai',
        'keterangan',
    ];

    public function rapor()
    {
        return $this->belongsTo(
            PerlengkapanRapor::class,
            'perlengkapan_rapor_id'
        );
    }
}
