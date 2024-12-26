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

$productId = $_GET['id'] ?? null;

if (!$productId || !is_numeric($productId)) {
    die("Produit non trouvé.");
}

try {
    $stmt = $pdo->prepare('SELECT * FROM product WHERE id = :id');
    $stmt->execute(['id' => $productId]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$product) {
        die("Produit non trouvé.");
    }
} catch (PDOException $e) {
    die("Erreur lors de la récupération du produit : " . $e->getMessage());
}
?>

<?php require __DIR__ . '/partials/header.php'; ?>

<main style="padding: 20px; font-family: Arial, sans-serif;">
    <h1 style="text-align: center; color: #333;"><?= htmlspecialchars($product['name']) ?></h1>
    <div style="display: flex; flex-wrap: wrap; justify-content: center; margin-top: 20px;">
        <div style="max-width: 300px; margin: 20px;">
            <img src="/oshop/public/assets/images/chaussure<?= htmlspecialchars($product['id']) ?>.jpg" 
                 alt="<?= htmlspecialchars($product['name']) ?>" 
                 style="width: 100%; border-radius: 10px;">
        </div>
        <div style="max-width: 400px; margin: 20px;">
            <p><strong>Description :</strong> <?= htmlspecialchars($product['description']) ?></p>
            <p><strong>Prix :</strong> <?= htmlspecialchars($product['price']) ?> €</p>
            
            <form action="/oshop/public/cart/add" method="post">
                <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['id']) ?>">
                <button type="submit" style="padding: 10px 20px; background-color: #007BFF; color: #fff; border: none; border-radius: 5px; cursor: pointer;">
                    Ajouter au panier
                </button>
            </form>
        </div>
    </div>
</main>

<?php 
try {
    $stmt = $pdo->query('SELECT * FROM social_links');
    $socialLinks = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $socialLinks = [];
}
require __DIR__ . '/partials/footer.php'; ?>