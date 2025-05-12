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
    public function run($params = [])
    {
        return \App\Models\Chapter::create([
            'story_id' => $params['chapter']['story_id'],
            'number' => $params['chapter']['number'],
            'version' => $params['chapter']['version'],
            'text' => $params['chapter']['text'],
        ]);
    }
}
