<?php

namespace Database\Seeders;

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
        DB::table('programmers')->insert([
            'email' => 'muhamadoskhar@gmail.com',
            'password' => Hash::make('123456'),
        ]);
        DB::table('programmers')->insert([
            'email' => 'dmalikakram@gmail.com',
            'password' => Hash::make('123456'),
        ]);
        DB::table('programmers')->insert([
            'email' => 'aidilriansyahmanaf@gmail.com',
            'password' => Hash::make('123456'),
        ]);
        DB::table('programmers')->insert([
            'email' => 'haidarhalwi22@gmail.com',
            'password' => Hash::make('123456'),
        ]);
        DB::table('programmers')->insert([
            'email' => 'fariedm334@gmail.com',
            'password' => Hash::make('123456'),
        ]);
        DB::table('programmers')->insert([
            'email' => 'mfajarganevi@gmail.com',
            'password' => Hash::make('123456'),
        ]);
    }
}