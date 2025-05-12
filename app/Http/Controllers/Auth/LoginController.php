<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    // Afficher le formulaire de connexion
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Gérer la soumission du formulaire de connexion
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Redirection vers la page profil après une connexion réussie
            return redirect()->intended('user');
        }

        // Message après échec d'authentification
        return back()->withErrors([
            'email' => 'Les informations d\'identification sont incorrectes.',
        ])->withInput();
    }
}
