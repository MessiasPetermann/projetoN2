<?php

namespace App\Controllers;

use App\Services\BookService;

class BookController {
    private $bookService;

    public function __construct() {
        $this->bookService = new BookService();
    }

    public function create() {
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            $result = $this->bookService->createBook($data);
            http_response_code(201);
            echo json_encode($result);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function read($id = null) {
        try {
            $result = $this->bookService->getBooks($id);
            echo json_encode($result);
        } catch (\Exception $e) {
            http_response_code($e->getCode());
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function update($id) {
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            $result = $this->bookService->updateBook($id, $data);
            echo json_encode($result);
        } catch (\Exception $e) {
            http_response_code($e->getCode());
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function delete($id) {
        try {
            $result = $this->bookService->deleteBook($id);
            echo json_encode($result);
        } catch (\Exception $e) {
            http_response_code($e->getCode());
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}