<?php

namespace App\Services;

use App\Models\Book;
use App\DAO\BookDAO;

class BookService {
    private $bookDAO;

    public function __construct() {
        $this->bookDAO = new BookDAO();
    }

    public function createBook($data) {
        $book = new Book(
            $data['title'],
            $data['author'],
            $data['category']
        );
        
        $id = $this->bookDAO->create($book);
        return ['id' => $id, 'message' => 'Book created successfully'];
    }

    public function getBooks($id = null) {
        $result = $this->bookDAO->read($id);
        if (empty($result)) {
            throw new \Exception("Book not found", 404);
        }
        return $result;
    }

    public function updateBook($id, $data) {
        $book = new Book(
            $data['title'],
            $data['author'],
            $data['category'],
            $id
        );
        
        if ($this->bookDAO->update($book)) {
            return ['message' => 'Book updated successfully'];
        }
        throw new \Exception("Failed to update book", 500);
    }

    public function deleteBook($id) {
        if ($this->bookDAO->delete($id)) {
            return ['message' => 'Book deleted successfully'];
        }
        throw new \Exception("Failed to delete book", 500);
    }
}