<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Suivi Diplôme</title>
</head>
<body>
    <h2>Suivi des Diplômes</h2>
    <a href="{{ route('administration.dashboard') }}">← Retour</a> |
    <a href="{{ route('administration.suivi.create') }}">+ Valider un Diplôme</a>

    @if (session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="8">
        <tr>
            <th>Étudiant</th>
            <th>Diplôme</th>
            <th>État</th>
            <th>Date Demande</th>
            <th>Date Validation</th>
            <th>Date Remise</th>
            <th>Actions</th>
        </tr>
        @foreach ($suivis as $suivi)
        <tr>
            <td>{{ $suivi->diplome->etudiant->nom }} {{ $suivi->diplome->etudiant->prenom }}</td>
            <td>{{ $suivi->diplome->nom_diplome }}</td>
            <td>{{ $suivi->etat_diplome }}</td>
            <td>{{ $suivi->date_demande ?? '—' }}</td>
            <td>{{ $suivi->date_validation ?? '—' }}</td>
            <td>{{ $suivi->date_remise ?? '—' }}</td>
            <td>
                @if ($suivi->etat_diplome === 'valide')
                    <form method="POST" action="{{ route('administration.suivi.livrer', $suivi->id_suivi) }}">
                        @csrf
                        <input type="date" name="date_remise" required>
                        <button type="submit">Livrer</button>
                    </form>
                @elseif ($suivi->etat_diplome === 'delivre')
                    <span style="color:green">✅ Livré</span>
                @elseif ($suivi->etat_diplome === 'annule')
                    <span style="color:red">❌ Annulé</span>
                @endif
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>