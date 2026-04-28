<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Historique</title>
</head>
<body>
    <h2>Historique des Diplômes</h2>
    <a href="{{ route('administration.dashboard') }}">← Retour</a>

    <table border="1" cellpadding="8">
        <tr>
            <th>Étudiant</th>
            <th>Diplôme</th>
            <th>Mention</th>
            <th>Date Retrait</th>
        </tr>
        @foreach ($historiques as $historique)
        <tr>
            <td>{{ $historique->diplome->etudiant->nom }} {{ $historique->diplome->etudiant->prenom }}</td>
            <td>{{ $historique->diplome->nom_diplome }}</td>
            <td>{{ $historique->mention ?? '—' }}</td>
            <td>{{ $historique->date_retrait ?? '—' }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>