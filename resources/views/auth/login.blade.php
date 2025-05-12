<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
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

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <label for="email">Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required>
        <label for="password">Mot de passe</label>
        <input type="password" name="password" required>
        <button type="submit">Se connecter</button>
    </form>
</body>

</html>