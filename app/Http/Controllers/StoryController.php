<?php

namespace App\Http\Controllers;

use App\Models\Story;
use Illuminate\Http\Request;

class StoryController extends Controller
{
    /**
     * Afficher une liste d'histoires
     */
    public function index()
    {
        $stories = Story::all();
        return response()->json($stories);
    }

    /**
     * Stocker une histoire dans la base de données
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'title' => 'required|string|max:225'
        ]);

        $story = Story::create($validateData);
        return response()->json($story, 201);
    }

    /**
     * Afficher une histoire
     */
    public function show(Story $story)
    {
        return response()->json($story);
    }

    /**
     * Mettre à jour une histoire
     */
    public function update(Request $request, Story $story)
    {
        $validateData = $request->validate([
            'title' => 'required|string|max:255'
        ]);

        $story->update($validateData);
        return response()->json($story);
    }

    /**
     * Supprimer une histoire
     */
    public function destroy(Story $story)
    {
        $story->delete();
        return response()->json(null, 204);
    }
}
