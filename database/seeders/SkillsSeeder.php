<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkillsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $skills = [
            "Angular",
            "Assembly",
            "Azure",
            "Bootstrap",
            "Coala",
            "Cobol",
            "cpp",
            "csharp",
            "CSS3",
            "Dart",
            "Django",
            "Docker",
            "elixir",
            "Go",
            "Graphql",
            "h",
            "hpp",
            "HTML5",
            "Java",
            "JavaScript",
            "JQuery",
            "Kotlin",
            "Laravel",
            "NodeJS",
            "Numpy",
            "OpenCV",
            "Pandas",
            "php",
            "PugJS",
            "Python",
            "Rails",
            "Reactivex",
            "React",
            "Replit",
            "Ruby",
            "Rust",
            "SASS",
            "Solidity",
            "Spring",
            "TensorFlow",
            "ThreeJS",
            "TypeScript",
            "Vue",
        ];
        foreach ($skills as $skill) {
            \DB::table("skills")->insert([
                "nama" => $skill,
                "gambar" => "images/skills/" . strtolower($skill) . ".png",
            ]);
        }
    }
}