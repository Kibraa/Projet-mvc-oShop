<?php
$config = parse_ini_file(__DIR__ . '/../Config/config.ini', true);

try {
    $dsn = "pgsql:host={$config['database']['host']};port={$config['database']['port']};dbname={$config['database']['name']}";
    $pdo = new PDO($dsn, $config['database']['username'], $config['database']['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

$stmt = $pdo->query('SELECT * FROM category LIMIT 5');
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php require __DIR__ . '/partials/header.php'; ?>

<main>
    <section class="banner">
        <h1>Bienvenue sur oShop !</h1>
        <p>Trouvez les meilleures chaussures pour chaque occasion. Profitez de nos offres exclusives !</p>
        <a href="/oshop/public/categories" class="btn-primary">Explorer nos catégories</a>
    </section>

    <section class="categories-section">
        <h2>Catégories populaires</h2>
        <ul class="categories-list">
            <?php foreach ($categories as $category): ?>
                <li>
                    <img src="/oshop/public/assets/images/chaussure<?= $category['id'] ?>.jpg" alt="<?= htmlspecialchars($category['name']) ?>">
                    <p><?= htmlspecialchars($category['name']) ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>

    <section class="about-section">
        <h2>À propos de nous</h2>
        <p>oShop est votre boutique de chaussures en ligne de confiance, offrant une grande variété de styles pour toutes les occasions. Que vous cherchiez des chaussures élégantes pour le travail, des chaussures confortables pour la détente, ou des chaussures robustes pour l'extérieur, nous avons ce qu'il vous faut.</p>
    </section>

    <section class="advantages-section">
        <h2>Pourquoi choisir oShop ?</h2>
        <ul class="advantages-list">
            <li>Livraison rapide et gratuite</li>
            <li>Retour gratuit sous 30 jours</li>
            <li>Chaussures de haute qualité</li>
            <li>Service client disponible 7j/7</li>
        </ul>
    </section>
</main>

<?php 
try {
    $stmt = $pdo->query('SELECT * FROM social_links');
    $socialLinks = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $socialLinks = [];
}
require __DIR__ . '/partials/footer.php'; 
?>