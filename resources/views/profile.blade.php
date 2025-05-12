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

<section id="edit">
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
</section>

<section id="delete">
    <button id="deleteButton">Supprimer mon compte</button>
    <form id="deleteForm" method="POST" action="{{route('user-delete')}}" style="display: none">
        @csrf
        @method('DELETE')
        <p>Etes vous bien sûr de vouloir supprimer votre compte ? Cette suppression est définitive.</p>
        <input type="checkbox" id="confirm" required>
        <label for="confirm">Je confirme la suppression de mon compte.</label>
        @error('confirm')
        <div class="error">{{ $message }}</div>
        @enderror
        <button type="submit">Supprimer</button>
    </form>
</section>

<section id="disconnect">
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Se déconnecter</button>
    </form>
</section>




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

    // Afficher/masquer le formulaire de suppression
    document.getElementById('deleteButton').addEventListener('click', function() {
        var form = document.getElementById('deleteForm');
        if (form.style.display === 'none') {
            form.style.display = 'block';
        } else {
            form.style.display = 'none';
        }
    });
</script>
@endsection