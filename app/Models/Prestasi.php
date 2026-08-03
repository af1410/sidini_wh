<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    protected $table = 'prestasi';

    protected $fillable = [
        'perlengkapan_rapor_id',
        'prestasi',
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
