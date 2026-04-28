<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Étudiant</title>
</head>
<body>
    <h2>Connexion Étudiant</h2>

    @if ($errors->any())
        <div style="color:red">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('login.etudiant') }}">
        @csrf
        <div>
            <label>CNE :</label>
            <input type="text" name="cne" value="{{ old('cne') }}" required>
        </div>
        <div>
            <label>Code Apogée :</label>
            <input type="text" name="code_apogee" value="{{ old('code_apogee') }}" required>
        </div>
        <button type="submit">Se connecter</button>
    </form>
</body>
</html>