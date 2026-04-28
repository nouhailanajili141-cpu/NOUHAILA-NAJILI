<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard — Étudiant</title>
</head>
<body>
    <h2>Bienvenue, {{ Auth::user()->name }}</h2>

    <nav>
        <a href="{{ route('etudiant.suivi') }}">Mon Suivi Diplôme</a> |
        <a href="{{ route('etudiant.historique') }}">Mon Historique</a>
    </nav>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Se déconnecter</button>
    </form>
</body>
</html>