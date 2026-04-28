<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Historique Diplôme</title>
</head>
<body>
    <h2>Historique de mon Diplôme</h2>
    <a href="{{ route('etudiant.dashboard') }}">← Retour</a>

    @if ($historiques->count())
        <table border="1" cellpadding="8">
            <tr>
                <th>Diplôme</th>
                <th>Mention</th>
                <th>Date Retrait</th>
            </tr>
            @foreach ($historiques as $historique)
            <tr>
                <td>{{ $historique->diplome->nom_diplome }}</td>
                <td>{{ $historique->mention ?? '—' }}</td>
                <td>{{ $historique->date_retrait ?? '—' }}</td>
            </tr>
            @endforeach
        </table>
    @else
        <p>Aucun historique disponible.</p>
    @endif

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Se déconnecter</button>
    </form>
</body>
</html>