<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Utilisateur</title>
</head>
<body>
    <h2>Modifier l'Utilisateur</h2>
    <a href="{{ route('administrateur.utilisateurs.index') }}">← Retour</a>

    @if ($errors->any())
        <div style="color:red">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('administrateur.utilisateurs.update', $utilisateur->id) }}">
        @csrf
        @method('PUT')
        <div>
            <label>Nom :</label>
            <input type="text" name="name" value="{{ $utilisateur->name }}" required>
        </div>
        <div>
            <label>Rôle :</label>
            <select name="role" required>
                <option value="etudiant" {{ $utilisateur->role === 'etudiant' ? 'selected' : '' }}>Étudiant</option>
                <option value="administration" {{ $utilisateur->role === 'administration' ? 'selected' : '' }}>Administration</option>
                <option value="administrateur" {{ $utilisateur->role === 'administrateur' ? 'selected' : '' }}>Administrateur</option>
            </select>
        </div>
        <button type="submit">Modifier</button>
    </form>
</body>
</html>