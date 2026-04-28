<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Diplômes</title>
</head>
<body>
    <h2>Liste des Diplômes</h2>
    <a href="{{ route('administration.dashboard') }}">← Retour</a> |
    <a href="{{ route('administration.diplomes.create') }}">+ Ajouter</a>

    @if (session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="8">
        <tr>
            <th>Nom Diplôme</th>
            <th>Spécialité</th>
            <th>Niveau</th>
            <th>Étudiant</th>
            <th>Actions</th>
        </tr>
        @foreach ($diplomes as $diplome)
        <tr>
            <td>{{ $diplome->nom_diplome }}</td>
            <td>{{ $diplome->specialite }}</td>
            <td>{{ $diplome->niveau }}</td>
            <td>{{ $diplome->etudiant->nom }} {{ $diplome->etudiant->prenom }}</td>
            <td>
                <a href="{{ route('administration.diplomes.edit', $diplome->id_diplome) }}">Modifier</a>
                <form method="POST" action="{{ route('administration.diplomes.destroy', $diplome->id_diplome) }}" style="display:inline">
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