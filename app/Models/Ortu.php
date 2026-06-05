<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Ortu extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'ortu';
    protected $primaryKey = 'id_ortu';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'nik',
        'nama_ortu',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'no_hp',
        'email',
        'username',
        'password',
        'gambar',
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

    protected static function booted()
    {
        static::creating(function ($ortu) {
            // jika username tidak diisi, gunakan no_hp
            if (empty($ortu->username) && !empty($ortu->no_hp)) {
                $ortu->username = $ortu->no_hp;
            }

            // jika password tidak diisi, set dari no_hp (hash)
            if (empty($ortu->password) && !empty($ortu->no_hp)) {
                $ortu->password = bcrypt($ortu->no_hp);
            }
        });

        static::updating(function ($ortu) {
            // sinkron username dengan no_hp jika admin tidak menetapkan username manual
            if (empty($ortu->username) && !empty($ortu->no_hp)) {
                $ortu->username = $ortu->no_hp;
            }
        });
    }
}
