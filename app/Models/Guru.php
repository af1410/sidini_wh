<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Guru extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'guru';
    protected $primaryKey = 'id_guru';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'nip',
        'nik',
        'nama_guru',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'no_hp',
        'email',
        'username',
        'password',
        'gambar',
        'jabatan',
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

    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'id_guru', 'id_guru');
    }
}
