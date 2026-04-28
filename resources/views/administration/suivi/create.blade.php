<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Validation Diplôme</title>
</head>
<body>
    <h2>Validation du Diplôme</h2>
    <a href="{{ route('administration.suivi.index') }}">← Retour</a>

    @if ($errors->any())
        <div style="color:red">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    @if ($diplomes->count())
        <form method="POST" action="{{ route('administration.suivi.store') }}">
            @csrf
            <div>
                <label>Étudiant / Diplôme :</label>
                <select name="id_diplome" required>
                    <option value="">-- Choisir --</option>
                    @foreach ($diplomes as $diplome)
                        <option value="{{ $diplome->id_diplome }}">
                            {{ $diplome->etudiant->nom }} {{ $diplome->etudiant->prenom }}
                            — {{ $diplome->nom_diplome }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label>Date Demande :</label>
                <input type="date" name="date_demande" required>
            </div>
            <div>
                <label>Date Validation :</label>
                <input type="date" name="date_validation" required>
            </div>
            <div>
                <label>Décision :</label>
                <select name="decision" required>
                    <option value="valide">Valider ✅</option>
                    <option value="annule">Annuler ❌</option>
                </select>
            </div>
            <div>
                <label>Mention (si validé) :</label>
                <input type="text" name="mention" placeholder="Bien / Très Bien / Passable">
            </div>
            <button type="submit">Confirmer</button>
        </form>
    @else
        <p>Aucun diplôme disponible pour validation.</p>
    @endif
</body>
</html>