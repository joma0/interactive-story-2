<?php

namespace Database\Seeders;

use App\Models\Chapter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChaptersTableSeeder extends Seeder
{
    /**
     * Créer un Chapter grâce à des paramètres reçus de DatabaseSeeder
     */
    public function run() {}

    public function seedFromData(array $chapterData)
    {
        return Chapter::create([
            'number' => $chapterData['number'],
            'version' => $chapterData['version'],
            'text' => $chapterData['text'],
            'story_id' => $chapterData['story_id'],
        ]);
    }
}
