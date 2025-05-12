<?php

namespace Database\Seeders;

use App\Models\Story;
use App\Models\Chapter;
use App\Models\Choice;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;


class DatabaseSeeder extends Seeder
{
    /**
     * Remplir les tables Story, Chapter et Choice d'après les données JSON
     */
    public function run(): void
    {
        $json = File::get(database_path('stories.json'));
        $stories = json_decode($json, true);

        foreach ($stories as $storyData) {
            app(StoriesTableSeeder::class)->seedFromData($storyData);
        }
    }
}
