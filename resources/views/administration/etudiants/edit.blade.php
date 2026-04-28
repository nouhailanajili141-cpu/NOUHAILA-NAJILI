<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Étudiant</title>
</head>
<body>
    <h2>Modifier l'Étudiant</h2>
    <a href="{{ route('administration.etudiants.index') }}">← Retour</a>

    @if ($errors->any())
        <div style="color:red">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('administration.etudiants.update', $etudiant->id_etudiant) }}">
        @csrf
        @method('PUT')
        <div>
            <label>Nom :</label>
            <input type="text" name="nom" value="{{ $etudiant->nom }}" required>
        </div>
        <div>
            <label>Prénom :</label>
            <input type="text" name="prenom" value="{{ $etudiant->prenom }}" required>
        </div>
        <div>
            <label>Code Apogée :</label>
            <input type="text" name="code_apogee" value="{{ $etudiant->code_apogee }}" required>
        </div>
        <div>
            <label>CNE :</label>
            <input type="text" name="cne" value="{{ $etudiant->cne }}" required>
        </div>
        <div>
            <label>Filière :</label>
            <input type="text" name="filiere" value="{{ $etudiant->filiere }}" required>
        </div>
        <div>
            <label>Email :</label>
            <input type="email" name="email" value="{{ $etudiant->user->email }}" required>
        </div>
        <button type="submit">Modifier</button>
    </form>
</body>
</html>