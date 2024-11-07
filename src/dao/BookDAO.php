<?php

namespace App\DAO;

use App\Models\Book;
use App\Config\Database;

class BookDAO {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function create(Book $book) {
        $sql = "INSERT INTO books (title, author, category) VALUES (:title, :author, :category)";
        $stmt = $this->db->prepare($sql);
        
        $stmt->execute([
            ':title' => $book->getTitle(),
            ':author' => $book->getAuthor(),
            ':category' => $book->getCategory()
        ]);

        return $this->db->lastInsertId();
    }

    public function read($id = null) {
        if ($id) {
            $sql = "SELECT * FROM books WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }

        $sql = "SELECT * FROM books";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function update(Book $book) {
        $sql = "UPDATE books SET title = :title, author = :author, category = :category WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        
        return $stmt->execute([
            ':id' => $book->getId(),
            ':title' => $book->getTitle(),
            ':author' => $book->getAuthor(),
            ':category' => $book->getCategory()
        ]);
    }

    public function delete($id) {
        $sql = "DELETE FROM books WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}