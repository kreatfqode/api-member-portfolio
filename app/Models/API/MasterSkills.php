<?php

namespace App\Models\API;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterSkills extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_programmers',
        'id_skills',
    ];
}