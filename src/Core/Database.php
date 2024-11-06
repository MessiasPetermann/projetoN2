<?php
namespace App\Core;

// Implementação do padrão Singleton
class Database {
    private static ?Database $instance = null;
    private ?\PDO $connection = null;
    
    private function __construct() {}
    
    public static function getInstance(): Database {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function connect(): void {
        if ($this->connection === null) {
            $this->connection = new \PDO(
                "sqlite:" . __DIR__ . "/../../database.sqlite",
                null,
                null,
                [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]
            );
            $this->createTables();
        }
    }
    
    private function createTables(): void {
        $sql = "
            CREATE TABLE IF NOT EXISTS products (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                name TEXT NOT NULL,
                price REAL NOT NULL,
                description TEXT NOT NULL,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
            )
        ";
        $this->connection->exec($sql);
    }
    
    public function getConnection(): \PDO {
        return $this->connection;
    }
}