<?php
$config = parse_ini_file(__DIR__ . '/../Config/config.ini', true);

try {
    $dsn = "pgsql:host={$config['database']['host']};port={$config['database']['port']};dbname={$config['database']['name']}";
    $pdo = new PDO($dsn, $config['database']['username'], $config['database']['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer un compte - oShop</title>
    <link rel="stylesheet" href="/oshop/public/css/style.css">
</head>
<body class="register-page">
    <?php include __DIR__ . '/partials/header.php'; ?>

    <div class="register-container">
        <div class="register-header">
            <h1>Créer un compte</h1>
            <p>Rejoignez notre communauté et profitez de nos services exclusifs.</p>
        </div>
        <form action="/oshop/public/register" method="post">
            <div class="form-group">
                <label for="username">Nom d'utilisateur :</label>
                <input type="text" id="username" name="username" placeholder="Entrez votre nom d'utilisateur" required>
            </div>
            <div class="form-group">
                <label for="email">Adresse email :</label>
                <input type="email" id="email" name="email" placeholder="Entrez votre adresse email" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" placeholder="Créez un mot de passe" required>
            </div>
            <div class="form-actions">
                <button type="submit">Créer un compte</button>
            </div>
        </form>
    </div>

    <?php 
try {
    $stmt = $pdo->query('SELECT * FROM social_links');
    $socialLinks = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $socialLinks = [];
}
require __DIR__ . '/partials/footer.php'; ?></body>
</html>