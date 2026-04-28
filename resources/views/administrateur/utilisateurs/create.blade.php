<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter Utilisateur</title>
</head>
<body>
    <h2>Ajouter un Utilisateur</h2>
    <a href="{{ route('administrateur.utilisateurs.index') }}">← Retour</a>

    @if ($errors->any())
        <div style="color:red">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('administrateur.utilisateurs.store') }}">
        @csrf
        <div>
            <label>Nom :</label>
            <input type="text" name="name" value="{{ old('name') }}" required>
        </div>
        <div>
            <label>Email :</label>
            <input type="email" name="email" value="{{ old('email') }}" required>
        </div>
        <div>
            <label>Mot de passe :</label>
            <input type="password" name="password" required>
        </div>
        <div>
            <label>Rôle :</label>
            <select name="role" required>
                <option value="etudiant">Étudiant</option>
                <option value="administration">Administration</option>
                <option value="administrateur">Administrateur</option>
            </select>
        </div>
        <button type="submit">Ajouter</button>
    </form>
</body>
</html>