<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Utilisateurs</title>
</head>
<body>
    <h2>Gestion des Utilisateurs</h2>
    <a href="{{ route('administrateur.dashboard') }}">← Retour</a> |
    <a href="{{ route('administrateur.utilisateurs.create') }}">+ Ajouter</a>

    @if (session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="8">
        <tr>
            <th>Nom</th>
            <th>Email</th>
            <th>Rôle</th>
            <th>Actions</th>
        </tr>
        @foreach ($utilisateurs as $utilisateur)
        <tr>
            <td>{{ $utilisateur->name }}</td>
            <td>{{ $utilisateur->email }}</td>
            <td>{{ $utilisateur->role }}</td>
            <td>
                <a href="{{ route('administrateur.utilisateurs.edit', $utilisateur->id) }}">Modifier</a>
                <form method="POST" action="{{ route('administrateur.utilisateurs.destroy', $utilisateur->id) }}" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Supprimer?')">Supprimer</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>