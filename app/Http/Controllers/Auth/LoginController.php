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
            // Rediriger l'utilisateur vers la page protégée après une connexion réussie
            return redirect()->intended('profile');
        }

        // Si l'authentification échoue
        return back()->withErrors([
            'email' => 'Les informations d\'identification sont incorrectes.',
        ])->withInput();
    }
}
