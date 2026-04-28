<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard — Administrateur</title>
</head>
<body>
    <h2>Dashboard Administrateur</h2>

    <nav>
        <a href="{{ route('administrateur.utilisateurs.index') }}">Utilisateurs</a>
    </nav>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Se déconnecter</button>
    </form>
</body>
</html>