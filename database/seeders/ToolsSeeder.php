<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ToolsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tools = [
            "Adobe-xd",
            "Ajax",
            "Atom-Editor",
            "Audacity",
            "Blender",
            "ClickUp",
            "DBeaver",
            "Drawio",
            "Figma",
            "GIMP",
            "Git",
            "Gulp",
            "Inkscape",
            "Jekyll",
            "Kdenlive",
            "Photoshop",
            "Postman",
            "Slack",
            "Trello",
            "VisualStudioCode",
            "WebPack",
            "Sublime",
        ];
        foreach ($tools as $tool) {
            \DB::table("tools")->insert([
                "nama" => str_replace("-", " ", $tool),
                "gambar" => "images/tools/" . strtolower($tool) . ".png",
            ]);
        }
    }
}