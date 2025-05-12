<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use Illuminate\Http\Request;

use function Pest\Laravel\json;

class ChapterController extends Controller
{
    /**
     * Afficher une liste des chapitres
     */
    public function index()
    {
        $chapters = Chapter::all();
        return response()->json($chapters);
    }

    /**
     * Stocker un nouveau chapitre
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'story_id' => 'required|exists:stories,id',
            'number' => 'required|integer',
            'version' => 'required|string|max:255',
            'text' => 'required|string',
        ]);

        $chapter = Chapter::create($validateData);
        return response()->json($chapter, 201);
    }

    /**
     * Afficher un chapitre 
     */
    public function show(Chapter $chapter)
    {
        return response()->json($chapter);
    }

    /**
     * Mettre à jour un chapitre
     */
    public function update(Request $request, Chapter $chapter)
    {
        $validatedData = $request->validate([
            'story_id' => 'sometimes|required|exists:stories,id',
            'number' => 'sometimes|required|integer',
            'version' => 'sometimes|required|string|max:255',
            'text' => 'sometimes|required|string',
        ]);

        $chapter->update($validatedData);
        return response()->json($chapter);
    }

    /**
     * Supprimer un chapitre
     */
    public function destroy(Chapter $chapter)
    {
        $chapter->delete();
        return response()->json(null, 204);
    }
}
