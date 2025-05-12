@extends('layouts.vue')

@section('content')
<h1>Bienvenue, {{ Auth::user()->name }} !</h1>

<p>Vous êtes connecté(e) avec l’adresse : {{ Auth::user()->email }}</p>

<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Se déconnecter</button>
</form>
@endsection