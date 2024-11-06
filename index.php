<?php
require_once __DIR__ . '/vendor/autoload.php';

use App\Controllers\ProductController;
use App\Core\Router;
use App\Core\Database;

header('Content-Type: application/json');

// Inicializa o banco de dados
Database::getInstance()->connect();

// Inicializa o Router
$router = new Router();

// Registra as rotas
$router->addRoute('GET', '/api/products', [ProductController::class, 'index']);
$router->addRoute('GET', '/api/products/{id}', [ProductController::class, 'show']);
$router->addRoute('POST', '/api/products', [ProductController::class, 'store']);
$router->addRoute('PUT', '/api/products/{id}', [ProductController::class, 'update']);
$router->addRoute('DELETE', '/api/products/{id}', [ProductController::class, 'delete']);

// Processa a requisição
$router->handleRequest();