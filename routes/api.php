<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\StoryController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\ChoiceController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('v1/stories', StoryController::class);

Route::apiResource('v1/chapters', ChapterController::class);

Route::apiResource('v1/choices', ChoiceController::class);

Route::get('v1/stories/{story}/chapters', function (App\Models\Story $story) {
    return response()->json($story->chapters);
});

Route::get('v1/chapters/{chapter}/choices', function (\App\Models\Chapter $chapter) {
    return response()->json($chapter->originChoices);
});
