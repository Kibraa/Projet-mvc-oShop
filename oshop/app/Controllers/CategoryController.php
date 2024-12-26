<?php
class CategoryController {

    public function index() {
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

        $stmt = $pdo->query('SELECT * FROM category');
        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

        require __DIR__ . '/../Views/categories.php';
    }

    public function show($categoryId) {
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

        $stmt = $pdo->prepare('SELECT * FROM product WHERE category_id = :categoryId');
        $stmt->bindParam(':categoryId', $categoryId, PDO::PARAM_INT);
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        require __DIR__ . '/../Views/products.php';
    }
}