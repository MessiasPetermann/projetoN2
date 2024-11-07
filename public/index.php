<?php

require_once __DIR__ . '/../vendor/autoload.php';

header('Content-Type: application/json');

$router = new \Bramus\Router\Router();

// CORS headers
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

$bookController = new \App\Controllers\BookController();

// Routes
$router->get('/books', function() use ($bookController) {
    $bookController->read();
});

$router->get('/books/(\d+)', function($id) use ($bookController) {
    $bookController->read($id);
});

$router->post('/books', function() use ($bookController) {
    $bookController->create();
});

$router->put('/books/(\d+)', function($id) use ($bookController) {
    $bookController->update($id);
});

$router->delete('/books/(\d+)', function($id) use ($bookController) {
    $bookController->delete($id);
});

$router->run();