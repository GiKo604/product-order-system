<?php
// Front controller podle tvojí struktury

// core
require __DIR__ . '/../app/core/Router.php';
require __DIR__ . '/../app/core/Database.php';

// controllers
require __DIR__ . '/../app/controllers/ProductController.php';
require __DIR__ . '/../app/controllers/OrderController.php';
require __DIR__ . '/../app/controllers/ImportController.php';
require __DIR__ . '/../app/controllers/StatisticsController.php';
require __DIR__ . '/../app/controllers/AuthController.php';

$router = new Router();

// Dashboard
$router->get('/', function () {
    echo 'Dashboard (placeholder)';
});

// Auth
$router->get('/login', [new AuthController, 'loginForm']);
$router->post('/login', [new AuthController, 'login']);
$router->post('/logout', [new AuthController, 'logout']);

// Products
$router->get('/products', [new ProductController, 'index']);
$router->get('/products/show', function () {
    $id = $_GET['id'] ?? null;
    (new ProductController)->show((int)$id);
});
$router->get('/products/create', [new ProductController, 'create']);
$router->post('/products/store', [new ProductController, 'store']);
$router->post('/products/update', function () {
    $id = $_POST['id'] ?? null;
    (new ProductController)->update((int)$id);
});
$router->post('/products/delete', function () {
    $id = $_POST['id'] ?? null;
    (new ProductController)->delete((int)$id);
});

// Orders
$router->get('/orders', [new OrderController, 'index']);
$router->get('/orders/show', function () {
    $id = $_GET['id'] ?? null;
    (new OrderController)->show((int)$id);
});
$router->get('/orders/create', [new OrderController, 'create']);
$router->post('/orders/store', [new OrderController, 'store']);
$router->post('/orders/status', function () {
    $id = $_POST['id'] ?? null;
    (new OrderController)->updateStatus((int)$id);
});

// Import
$router->get('/import', [new ImportController, 'form']);
$router->post('/import/upload', [new ImportController, 'upload']);

// Statistics
$router->get('/statistics', [new StatisticsController, 'index']);

$router->dispatch();