<?php
namespace App\DAOs;

use App\Core\Database;
use App\Models\Product;

class ProductDAO {
    private \PDO $db;
    
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    
    public function findAll(): array {
        $stmt = $this->db->query('SELECT * FROM products');
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    public function findById(int $id): ?array {
        $stmt = $this->db->prepare('SELECT * FROM products WHERE id = ?');
        $stmt->execute([$id]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result ?: null;
    }
    
    public function create(Product $product): array {
        $stmt = $this->db->prepare(
            'INSERT INTO products (name, price, description) VALUES (?, ?, ?)'
        );
        
        $stmt->execute([
            $product->getName(),
            $product->getPrice(),
            $product->getDescription()
        ]);
        
        $id = $this->db->lastInsertId();
        return $this->findById($id);
    }
    
    public function update(Product $product): ?array {
        $stmt = $this->db->prepare(
            'UPDATE products SET name = ?, price = ?, description = ? WHERE id = ?'
        );
        
        $success = $stmt->execute([
            $product->getName(),
            $product->getPrice(),
            $product->getDescription(),
            $product->getId()
        ]);
        
        return $success ? $this->findById($product->getId()) : null;
    }
    
    public function delete(int $id): bool {
        $stmt = $this->db->prepare('DELETE FROM products WHERE id = ?');
        return $stmt->execute([$id]);
    }
}