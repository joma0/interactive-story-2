<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    /**
     * Afficher le profil de l'utilisateur
     */
    public function show()
    {
        if (Auth::check()) {
            return view('profile', ['user' => Auth::user()]);
        }

        return redirect()->route('login')->withErrors('Non authentifié');
    }

    /**
     * Mettre à jour les informations de l'utilisateur
     */
    public function update(UpdateUserRequest $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $user->update($request->only('name', 'email'));

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
            $user->save();
        }

        return redirect()->route('user-show')->with('success', 'Votre profil a été mis à jour avec succès.');
    }

    /**
     * Supprimer le compte de l'utilisateur
     */
    public function destroy()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->delete();

        return redirect()->route('user-show')->with('success', 'Votre compte a été supprimé avec succès.');
    }
}
