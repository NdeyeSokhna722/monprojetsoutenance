<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Gestion Scolaire' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="/">Gestion Scolaire</a>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a href="/etudiants" class="nav-link">Étudiants</a></li>
            <li class="nav-item"><a href="/enseignants" class="nav-link">Enseignants</a></li>
            <li class="nav-item"><a href="/cours" class="nav-link">Cours</a></li>
            <li class="nav-item"><a href="/notes" class="nav-link">Notes</a></li>
            <li class="nav-item"><a href="/emplois" class="nav-link">Emploi du temps</a></li>
        </ul>
    </div>
</nav>

<div class="container">
    @yield('content')
</div>

</body>
</html>
