@extends('layouts.vue')

@section('content')
<h1>Bienvenue, {{ $user->name }} !</h1>

<p>Nom : {{$user->name}} </p>
<p>Email : {{ $user->email }}</p>

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<button id="editButton">Modifier mes informations</button>

<form id="editForm" method="POST" action="{{ route('user-update') }}" style="display: none;">
    @csrf
    @method('PUT')

    <div>
        <label for="name">Nom :</label>
        <input type="text" name="name" id="name" value="{{ $user->name }}" required>
        @error('name')
        <div class="error">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="email">Email :</label>
        <input type="email" name="email" id="email" value="{{ $user->email }}" required>
        @error('name')
        <div class="error">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="password">Nouveau mot de passe :</label>
        <input type="password" name="password" id="password">
        <small>Si vous ne voulez pas changer votre mot de passe, laissez ce champ vide.</small>
        @error('name')
        <div class="error">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="password-confirmation">Confirmer le mot de passe :</label>
        <input type="password" name="password-confirmation" id="password-confirmation">
    </div>

    <button type="submit">Mettre à jour</button>
</form>


<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Se déconnecter</button>
</form>

<script>
    // Afficher/masquer le formulaire de modification
    document.getElementById('editButton').addEventListener('click', function() {
        var form = document.getElementById('editForm');
        if (form.style.display === 'none') {
            form.style.display = 'block';
        } else {
            form.style.display = 'none';
        }
    });
</script>
@endsection