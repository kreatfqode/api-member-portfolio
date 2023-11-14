<?php

namespace App\Models\API;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterTools extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_programmers',
        'id_tools',
    ];
}