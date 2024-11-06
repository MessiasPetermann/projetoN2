<?php
namespace App\Controllers;

use App\Services\ProductService;

class ProductController {
    private ProductService $productService;
    
    public function __construct() {
        $this->productService = new ProductService();
    }
    
    public function index(): array {
        try {
            return $this->productService->getAllProducts();
        } catch (\Exception $e) {
            http_response_code(500);
            return ['error' => $e->getMessage()];
        }
    }
    
    public function show(int $id): array {
        try {
            return $this->productService->getProduct($id);
        } catch (\Exception $e) {
            http_response_code(404);
            return ['error' => $e->getMessage()];
        }
    }
    
    public function store(): array {
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            $result = $this->productService->createProduct($data);
            http_response_code(201);
            return $result;
        } catch (\Exception $e) {
            http_response_code(400);
            return ['error' => $e->getMessage()];
        }
    }
    
    public function update(int $id): array {
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            return $this->productService->updateProduct($id, $data);
        } catch (\Exception $e) {
            http_response_code(400);
            return ['error' => $e->getMessage()];
        }
    }
    
    public function delete(int $id): array {
        try {
            return $this->productService->deleteProduct($id);
        } catch (\Exception $e) {
            http_response_code(404);
            return ['error' => $e->getMessage()];
        }
    }
}