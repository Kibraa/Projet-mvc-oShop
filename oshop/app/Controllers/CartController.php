<?php

class CartController {
    private $pdo;

    public function __construct() {
        $config = parse_ini_file(__DIR__ . '/../Config/config.ini', true);

        if (!$config) {
            die("Erreur : Impossible de charger la configuration.");
        }

        try {
            $dsn = "pgsql:host={$config['database']['host']};port={$config['database']['port']};dbname={$config['database']['name']}";
            $this->pdo = new PDO($dsn, $config['database']['username'], $config['database']['password']);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }

    public function add() {
        session_start();
        $productId = $_POST['product_id'] ?? null;

        if (!$productId || !is_numeric($productId)) {
            die("Produit invalide.");
        }

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId]++;
        } else {
            $_SESSION['cart'][$productId] = 1;
        }

        header('Location: /oshop/public/cart');
        exit;
    }

    public function index() {
        session_start();
        $cart = $_SESSION['cart'] ?? [];
        $pdo = $this->pdo;
        require __DIR__ . '/../Views/cart.php';
    }
}