<?php
namespace App\Services;

use App\DAOs\ProductDAO;
use App\Models\Product;

class ProductService {
    private ProductDAO $productDAO;
    
    public function __construct() {
        $this->productDAO = new ProductDAO();
    }
    
    public function getAllProducts(): array {
        try {
            return $this->productDAO->findAll();
        } catch (\Exception $e) {
            throw new \Exception('Erro ao buscar produtos: ' . $e->getMessage());
        }
    }
    
    public function getProduct(int $id): array {
        try {
            $product = $this->productDAO->findById($id);
            if (!$product) {
                throw new \Exception('Produto não encontrado');
            }
            return $product;
        } catch (\Exception $e) {
            throw new \Exception('Erro ao buscar produto: ' . $e->getMessage());
        }
    }
    
    public function createProduct(array $data): array {
        try {
            $product = new Product(
                null,
                $data['name'],
                (float)$data['price'],
                $data['description']
            );
            $product->validate();
            return $this->productDAO->create($product);
        } catch (\Exception $e) {
            throw new \Exception('Erro ao criar produto: ' . $e->getMessage());
        }
    }
    
    public function updateProduct(int $id, array $data): array {
        try {
            $product = new Product(
                $id,
                $data['name'],
                (float)$data['price'],
                $data['description']
            );
            $product->validate();
            
            $result = $this->productDAO->update($product);
            if (!$result) {
                throw new \Exception('Produto não encontrado');
            }
            return $result;
        } catch (\Exception $e) {
            throw new \Exception('Erro ao atualizar produto: ' . $e->getMessage());
        }
    }
    
    public function deleteProduct(int $id): array {
        try {
            $result = $this->productDAO->delete($id);
            if (!$result) {
                throw new \Exception('Produto não encontrado');
            }
            return ['message' => 'Produto removido com sucesso'];
        } catch (\Exception $e) {
            throw new \Exception('Erro ao remover produto: ' . $e->getMessage());
        }
    }
}