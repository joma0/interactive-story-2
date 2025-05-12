<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>

<body>
    @if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
            <li style="color: red">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <label for="name">Nom</label>
        <input type="text" name="name" value="{{ old('name') }}" required>
        <label for="email">Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required>
        <label for="password">Mot de passe</label>
        <input type="password" name="password" required>
        <label for="password_confirmation">Confirmer le mot de passe</label>
        <input type="password" name="password_confirmation" required>
        <button type="submit">S'inscrire</button>
    </form>
</body>

</html>