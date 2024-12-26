<?php
$config = parse_ini_file(__DIR__ . '/../Config/config.ini', true);

try {
    $dsn = "pgsql:host={$config['database']['host']};port={$config['database']['port']};dbname={$config['database']['name']}";
    $pdo = new PDO($dsn, $config['database']['username'], $config['database']['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

session_start();
$successMessage = $_SESSION['success_message'] ?? null;
unset($_SESSION['success_message']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion - oShop</title>
    <link rel="stylesheet" href="/oshop/public/css/style.css">
</head>
<body class="login-page">
    <?php include __DIR__ . '/partials/header.php'; ?>

    <div class="login-container">
        <div class="login-header">
            <h1>Bienvenue sur oShop</h1>
            <p>Connectez-vous pour accéder à votre compte et profiter de nos services exclusifs.</p>
        </div>

        <?php if ($successMessage): ?>
            <div class="alert alert-success">
                <?= htmlspecialchars($successMessage) ?>
            </div>
        <?php endif; ?>

        <form action="/oshop/public/back-office" method="post">
            <div class="form-group">
                <label for="username">Nom d'utilisateur :</label>
                <input type="text" id="username" name="username" placeholder="Entrez votre nom d'utilisateur" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" placeholder="Entrez votre mot de passe" required>
            </div>
            <div class="form-actions">
                <button type="submit">Se connecter</button>
                <p><a href="/oshop/public/forgot-password">Mot de passe oublié ?</a></p>
            </div>
        </form>
        <div class="login-footer">
            <p>Pas encore inscrit ? <a href="/oshop/public/register">Créer un compte</a></p>
        </div>
    </div>

</body>
</html>
<?php 
try {
    $stmt = $pdo->query('SELECT * FROM social_links');
    $socialLinks = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $socialLinks = [];
}
require __DIR__ . '/partials/footer.php'; ?>