<?php

namespace App\Models\API;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    use HasFactory;

    /**
     * Memperbolehkan penggunaan timestamps.
     * 
     * @var boolean
     */
    public $timestamps = true;

    /**
     * Atribut atau kolom yang boleh diubah.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_programmers',
        'nama',
        'gambar',
        'tanggal',
        'link',
        'teknologi',
    ];
}
