<?php
$config = parse_ini_file(__DIR__ . '/../Config/config.ini', true);

if (!$config) {
    die("Erreur : Impossible de charger la configuration.");
}

try {
    $dsn = "pgsql:host={$config['database']['host']};port={$config['database']['port']};dbname={$config['database']['name']}";
    $pdo = new PDO($dsn, $config['database']['username'], $config['database']['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

$categories = [
    ['id' => 1, 'name' => 'Détente', 'description' => 'Chaussures décontractées pour vos moments de repos.', 'product_id' => 1],
    ['id' => 2, 'name' => 'En ville', 'description' => 'Pour un style parfait dans la vie quotidienne.', 'product_id' => 2],
    ['id' => 3, 'name' => 'Au travail', 'description' => 'Chaussures élégantes et professionnelles.', 'product_id' => 3],
];
?>

<?php require __DIR__ . '/partials/header.php'; ?>

<main style="padding: 20px; font-family: Arial, sans-serif;">
    <h1 style="text-align: center; color: #333;">Nos chaussures!</h1>
    <p style="text-align: center; margin-bottom: 40px; color: #555;">
        Découvrez les catégories mises en avant pour répondre à tous vos besoins :
    </p>
    
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px;">
        <?php foreach ($categories as $category): ?>
            <div style="border: 1px solid #ddd; border-radius: 10px; overflow: hidden; text-align: center; background: #fff; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                <img src="/oshop/public/assets/images/chaussure<?= htmlspecialchars($category['id']) ?>.jpg" 
                     alt="<?= htmlspecialchars($category['name']) ?>" 
                     style="width: 100%; height: auto;">
                <div style="padding: 15px;">
                    <a href="/oshop/public/catalogue/product/<?= $category['product_id'] ?>" 
                       style="font-size: 18px; font-weight: bold; color: #007BFF; text-decoration: none;">
                        <?= htmlspecialchars($category['name']) ?>
                    </a>
                    <p style="margin: 10px 0; font-size: 14px; color: #666;">
                        <?= htmlspecialchars($category['description']) ?>
                    </p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
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