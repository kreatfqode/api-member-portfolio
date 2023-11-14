<?php

namespace App\Models\API;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Programmers extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $fillable = [
        'email',
        'password',
        'nama_panggilan',
        'nama_lengkap',
        'warna_primary',
        'warna_secondary',
        'foto_utama',
        'foto_tentang',
        'tentang_diri',
        'tentang_skill',
        'tentang_pengalaman',
        'tentang_project',
        'alamat',
        'no_telp',
        'mulai_karir',
        'moto_project',
        'pdf_cv',
    ];

    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
