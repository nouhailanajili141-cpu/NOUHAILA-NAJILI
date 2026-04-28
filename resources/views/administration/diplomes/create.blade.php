<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter Diplôme</title>
</head>
<body>
    <h2>Ajouter un Diplôme</h2>
    <a href="{{ route('administration.diplomes.index') }}">← Retour</a>

    @if ($errors->any())
        <div style="color:red">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('administration.diplomes.store') }}">
        @csrf
        <div>
            <label>Nom Diplôme :</label>
            <input type="text" name="nom_diplome" value="{{ old('nom_diplome') }}" required>
        </div>
        <div>
            <label>Spécialité :</label>
            <input type="text" name="specialite" value="{{ old('specialite') }}" required>
        </div>
        <div>
            <label>Niveau :</label>
            <input type="text" name="niveau" value="{{ old('niveau') }}" required>
        </div>
        <div>
            <label>Étudiant :</label>
            <select name="id_etudiant" required>
                <option value="">-- Choisir --</option>
                @foreach ($etudiants as $etudiant)
                    <option value="{{ $etudiant->id_etudiant }}">
                        {{ $etudiant->nom }} {{ $etudiant->prenom }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit">Ajouter</button>
    </form>
</body>
</html>