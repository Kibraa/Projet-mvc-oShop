<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($title ?? 'oShop') ?></title>
    <link rel="stylesheet" href="/oshop/public/css/style.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="/oshop/public/">Accueil</a></li>
                <li><a href="/oshop/public/categories">Catégories</a></li>
                <li><a href="/oshop/app/views/login.php">Se connecter</a></li>
            </ul>
        </nav>
    </header>
