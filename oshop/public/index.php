<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../app/Controllers/CategoryController.php';
require_once __DIR__ . '/../app/Controllers/ProductController.php';

$categoryController = new CategoryController();
$productController = new ProductController();

$router = new AltoRouter();
$router->setBasePath('/oshop/public');

$router->map('GET', '/', function () {
    require __DIR__ . '/../app/Views/home.php';
}, 'home');

$router->map('GET', '/categories', function () use ($categoryController) {
    $categoryController->index();
}, 'categories');

$router->map('GET', '/produit/[i:id]', function ($params) use ($productController) {
    $productController->show($params['id']);
}, 'product');

$router->map('GET', '/back-office/login', function () {
    require __DIR__ . '/../app/Views/login.php';
}, 'back-office-login');

$router->map('POST', '/back-office', function () {
    $validUsername = 'admin';
    $validPassword = 'password';

    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username === $validUsername && $password === $validPassword) {
        session_start();
        $_SESSION['is_logged_in'] = true;
        header('Location: /oshop/public/back-office/dashboard');
        exit;
    } else {
        echo "Nom d'utilisateur ou mot de passe incorrect.";
    }
}, 'back-office-login-post');

$router->map('GET', '/login', function () {
    require __DIR__ . '/../app/Views/login.php';
}, 'login');

$router->map('GET', '/back-office/dashboard', function () {
    session_start();
    if (!isset($_SESSION['is_logged_in']) || !$_SESSION['is_logged_in']) {
        header('Location: /oshop/public/back-office/login');
        exit;
    }
    require __DIR__ . '/../app/Views/dashboard.php';
}, 'back-office-dashboard');

$router->map('GET', '/catalogue/product/[i:id]', function ($params) {
    $_GET['id'] = $params['id'];
    require __DIR__ . '/../app/Views/product.php';
}, 'catalog-product');

$router->map('GET', '/cart', function () {
    require __DIR__ . '/../app/Controllers/CartController.php';
    $cartController = new CartController();
    $cartController->index();
}, 'cart-index');

$router->map('POST', '/cart/remove', function () {
    session_start();
    $productId = $_POST['product_id'] ?? null;

    if ($productId && isset($_SESSION['cart'][$productId])) {
        unset($_SESSION['cart'][$productId]);
    }

    header('Location: /oshop/public/cart');
    exit;
}, 'cart-remove');

$router->map('POST', '/cart/add', function () {
    require __DIR__ . '/../app/Controllers/CartController.php';
    $cartController = new CartController();
    $cartController->add();
}, 'cart-add');

$router->map('GET', '/register', function () {
    require __DIR__ . '/../app/Views/register.php';
}, 'register');

$router->map('POST', '/register', function () {
    require __DIR__ . '/../app/Controllers/RegisterController.php';
    $registerController = new RegisterController();
    $registerController->store();
}, 'register-post');

$match = $router->match();

if ($match) {
    call_user_func_array($match['target'], [$match['params']]);
} else {
    http_response_code(404);
    echo "Page non trouvée !";
}