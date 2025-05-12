<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\StoryController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\ChoiceController;

// Obtenir toutes les histoires
Route::get('v1/stories', [StoryController::class, 'index']);

// Obtenir une histoire spécifique
Route::get('v1/stories/{story}', [StoryController::class, 'show']);

// Obtenir tous les chapitres
Route::get('v1/chapters', [ChapterController::class, 'index']);

// Obtenir un chapitre spécifique
Route::get('v1/chapters/{chapter}', [ChapterController::class, 'show']);

// Obtenir tous les choix
Route::get('v1/choices', [ChoiceController::class, 'index']);

// Obtenir un choix spécifique
Route::get('v1/choices/{choice}', [ChoiceController::class, 'show']);

// Obtenir tous les chapitres d'une histoire
Route::get('v1/stories/{story}/chapters', function (App\Models\Story $story) {
    return response()->json($story->chapters);
});

// Obtenir tous les choix originaires d'un chapitre
Route::get('v1/chapters/{chapter}/choices', function (\App\Models\Chapter $chapter) {
    return response()->json($chapter->originChoices);
});
