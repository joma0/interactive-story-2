<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateUserRequest extends FormRequest
{
    /**
     * vérifier si l'utilisateur est authentifié 
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Règles de validation
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::user()->id,
            'password' => 'nullable|string|min:8|confirmed',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Le nom est obligatoire.',
            'name.string' => 'Le nom doit être une chaîne de caractères valide.',
            'name.max' => 'Le nom ne doit pas dépasser 255 caractères.',

            'email.required' => 'L\'email est obligatoire.',
            'email.email' => 'L\'email doit être une adresse valide.',
            'email.unique' => 'Cet email est déjà utilisé par un autre utilisateur.',

            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
            'password.confirmed' => 'Le mot de passe ne correspond pas.',
        ];
    }
}
