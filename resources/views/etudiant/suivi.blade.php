<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Suivi Diplôme</title>
</head>
<body>
    <h2>Suivi de mon Diplôme</h2>
    <a href="{{ route('etudiant.dashboard') }}">← Retour</a>

    @if ($suivi)
        <table border="1" cellpadding="8">
            <tr>
                <th>Diplôme</th>
                <th>État</th>
                <th>Date Demande</th>
                <th>Date Validation</th>
                <th>Date Remise</th>
            </tr>
            <tr>
                <td>{{ $suivi->diplome->nom_diplome }}</td>
                <td>{{ $suivi->etat_diplome }}</td>
                <td>{{ $suivi->date_demande ?? '—' }}</td>
                <td>{{ $suivi->date_validation ?? '—' }}</td>
                <td>{{ $suivi->date_remise ?? '—' }}</td>
            </tr>
        </table>
    @else
        <p>Aucun suivi disponible pour le moment.</p>
    @endif

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Se déconnecter</button>
    </form>
</body>
</html>