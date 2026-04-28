<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter Étudiant</title>
</head>
<body>
    <h2>Ajouter un Étudiant</h2>
    <a href="{{ route('administration.etudiants.index') }}">← Retour</a>

    @if ($errors->any())
        <div style="color:red">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('administration.etudiants.store') }}">
        @csrf
        <div>
            <label>Nom :</label>
            <input type="text" name="nom" value="{{ old('nom') }}" required>
        </div>
        <div>
            <label>Prénom :</label>
            <input type="text" name="prenom" value="{{ old('prenom') }}" required>
        </div>
        <div>
            <label>Code Apogée :</label>
            <input type="text" name="code_apogee" value="{{ old('code_apogee') }}" required>
        </div>
        <div>
            <label>CNE :</label>
            <input type="text" name="cne" value="{{ old('cne') }}" required>
        </div>
        <div>
            <label>Filière :</label>
            <input type="text" name="filiere" value="{{ old('filiere') }}" required>
        </div>
        <div>
            <label>Email :</label>
            <input type="email" name="email" value="{{ old('email') }}" required>
        </div>
        <button type="submit">Ajouter</button>
    </form>
</body>
</html>