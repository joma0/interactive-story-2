<?php

namespace Database\Seeders;

use App\Models\Story;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use function Pest\Laravel\call;

class StoriesTableSeeder extends Seeder
{
    /**
     * Créer une Story grâce à des paramètres reçus de DatabaseSeeder
     */
    public function run($params = []): void
    {
        $storyData = $params['story'];
        $story = Story::create([
            'title' => $storyData['title'],
            'location' => $storyData['location']
        ]);

        $chaptersMap = [];

        // Créer les chapitres
        foreach ($storyData['chapters'] as $chapterData) {
            $chapterData['story_id'] = $story->id;
            $chapter = app(ChaptersTableSeeder::class)->run(['chapter' => $chapterData]);
            $key = $chapter->number . '_' . $chapter->version;
            $chapterMap[$key] = $chapter->id;
        }

        // Créer les choix
        foreach ($storyData['chapters'] as $chapterData) {
            $originKey = $chapterData['number'] . '_' . $chapterData['version'];
            $originId = $chapterMap[$originKey];

            foreach ($chapterData['choices'] as $choiceData) {
                $targetKey = $choiceData['result_chapter']['numero'] . '_' . $choiceData['result_chapter']['version'];
                $targetId = $chapterMap[$targetKey] ?? null;

                if ($targetId) {
                    app(ChoicesTableSeeder::class)->run([
                        'choice' => [
                            'origin_chapter_id' => $originId,
                            'result_chapter_id' => $targetId,
                            'text' => $choiceData['text']
                        ]
                    ]);
                }
            }
        }
    }
}
