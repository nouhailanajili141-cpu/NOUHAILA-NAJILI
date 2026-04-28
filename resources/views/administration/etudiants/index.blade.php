<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Étudiants</title>
</head>
<body>
    <h2>Liste des Étudiants</h2>
    <a href="{{ route('administration.dashboard') }}">← Retour</a> |
    <a href="{{ route('administration.etudiants.create') }}">+ Ajouter</a>

    @if (session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="8">
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Code Apogée</th>
            <th>CNE</th>
            <th>Filière</th>
            <th>Actions</th>
        </tr>
        @foreach ($etudiants as $etudiant)
        <tr>
            <td>{{ $etudiant->nom }}</td>
            <td>{{ $etudiant->prenom }}</td>
            <td>{{ $etudiant->code_apogee }}</td>
            <td>{{ $etudiant->cne }}</td>
            <td>{{ $etudiant->filiere }}</td>
            <td>
                <a href="{{ route('administration.etudiants.edit', $etudiant->id_etudiant) }}">Modifier</a>
                <form method="POST" action="{{ route('administration.etudiants.destroy', $etudiant->id_etudiant) }}" style="display:inline">
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