<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Diplôme</title>
</head>
<body>
    <h2>Modifier le Diplôme</h2>
    <a href="{{ route('administration.diplomes.index') }}">← Retour</a>

    @if ($errors->any())
        <div style="color:red">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('administration.diplomes.update', $diplome->id_diplome) }}">
        @csrf
        @method('PUT')
        <div>
            <label>Nom Diplôme :</label>
            <input type="text" name="nom_diplome" value="{{ $diplome->nom_diplome }}" required>
        </div>
        <div>
            <label>Spécialité :</label>
            <input type="text" name="specialite" value="{{ $diplome->specialite }}" required>
        </div>
        <div>
            <label>Niveau :</label>
            <input type="text" name="niveau" value="{{ $diplome->niveau }}" required>
        </div>
        <button type="submit">Modifier</button>
    </form>
</body>
</html>