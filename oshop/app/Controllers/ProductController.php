<?php
class ProductController {

    public function show($id) {
        $config = parse_ini_file(__DIR__ . '/../Config/config.ini', true);

        try {
            $dsn = "pgsql:host={$config['database']['host']};port={$config['database']['port']};dbname={$config['database']['name']}";
            $pdo = new PDO($dsn, $config['database']['username'], $config['database']['password']);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }

        $stmt = $pdo->prepare('SELECT * FROM product WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$product) {
            die("Produit introuvable.");
        }

        require __DIR__ . '/../Views/product.php';
    }
}