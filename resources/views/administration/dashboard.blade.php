<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard — Administration</title>
</head>
<body>
    <h2>Dashboard Administration</h2>

    <nav>
        <a href="{{ route('administration.etudiants.index') }}">Étudiants</a> |
        <a href="{{ route('administration.diplomes.index') }}">Diplômes</a> |
        <a href="{{ route('administration.suivi.index') }}">Suivi Diplôme</a> |
        <a href="{{ route('administration.historique.index') }}">Historique</a>
    </nav>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Se déconnecter</button>
    </form>
</body>
</html>