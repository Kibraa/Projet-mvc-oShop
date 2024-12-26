<?php

require_once __DIR__ . '/../vendor/autoload.php';

$router = new AltoRouter();

$router->setBasePath('/oshop/public');

$router->map('GET', '/', function () {
    require __DIR__ . '/../app/Views/home.php';
}, 'home');

$router->map('GET', '/categories', function () {
    require __DIR__ . '/../app/Views/categories.php';
}, 'categories');

$router->map('GET', '/produit/[i:id]', function ($params) {
    require __DIR__ . '/../app/Views/product.php';
}, 'product');

return $router;