<?php
namespace App\Models;

class Product {
    private ?int $id = null;
    private string $name;
    private float $price;
    private string $description;
    
    public function __construct(?int $id = null, string $name = '', float $price = 0.0, string $description = '') {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->description = $description;
    }
    
    public function getId(): ?int {
        return $this->id;
    }
    
    public function setId(int $id): void {
        $this->id = $id;
    }
    
    public function getName(): string {
        return $this->name;
    }
    
    public function setName(string $name): void {
        $this->name = $name;
    }
    
    public function getPrice(): float {
        return $this->price;
    }
    
    public function setPrice(float $price): void {
        $this->price = $price;
    }
    
    public function getDescription(): string {
        return $this->description;
    }
    
    public function setDescription(string $description): void {
        $this->description = $description;
    }
    
    public function validate(): bool {
        if (empty($this->name)) {
            throw new \Exception('Nome inválido');
        }
        if ($this->price <= 0) {
            throw new \Exception('Preço inválido');
        }
        if (empty($this->description)) {
            throw new \Exception('Descrição inválida');
        }
        return true;
    }
    
    public function toArray(): array {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'description' => $this->description
        ];
    }
}