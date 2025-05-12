<?php

namespace App\Http\Controllers;

use App\Models\Choice;
use Illuminate\Http\Request;

class ChoiceController extends Controller
{
    /**
     * Afficher une liste des choix
     */
    public function index()
    {
        $choices = Choice::all();
        return response()->json($choices);
    }

    /**
     * Stocker un nouveau choix 
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'origin_chapter_id' => 'required|exists:chapters,id',
            'result_chapter_id' => 'required|exists:chapters,id',
            'text' => 'required|string',
        ]);

        $choice = Choice::create($validateData);
        return response()->json($choice, 201);
    }

    /**
     * Afficher un choix
     */
    public function show(Choice $choice)
    {
        return response()->json($choice);
    }

    /**
     * Mettre à jour un choix 
     */
    public function update(Request $request, Choice $choice)
    {
        $validateData = $request->validate([
            'origin_chapter_id' => 'sometimes|required|exists:chapters,id',
            'result_chapter_id' => 'sometimes|required|exists:chapters,id',
            'text' => 'sometimes|required|string',
        ]);

        $choice->update($validateData);
        return response()->json($choice);
    }

    /**
     * Supprimer un choix 
     */
    public function destroy(Choice $choice)
    {
        $choice->delete();
        return response()->json(null, 204);
    }
}
