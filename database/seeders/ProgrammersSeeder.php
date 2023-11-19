<?php

namespace Database\Seeders;

use App\Models\API\Programmers;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProgrammersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Programmers::create([
            'email' => 'muhamadoskhar@gmail.com',
            'password' => Hash::make('123456'),
        ]);
        Programmers::create([
            'email' => 'dmalikakram@gmail.com',
            'password' => Hash::make('123456'),
        ]);
        Programmers::create([
            'email' => 'aidilriansyahmanaf@gmail.com',
            'password' => Hash::make('123456'),
        ]);
        Programmers::create([
            'email' => 'haidarhalwi22@gmail.com',
            'password' => Hash::make('123456'),
        ]);
        Programmers::create([
            'email' => 'fariedm334@gmail.com',
            'password' => Hash::make('123456'),
        ]);
        Programmers::create([
            'email' => 'mfajarganevi@gmail.com',
            'password' => Hash::make('123456'),
        ]);
    }
}