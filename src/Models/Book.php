<?php

namespace App\Models;

class Book {
    private $id;
    private $title;
    private $author;
    private $category;

    public function __construct($title, $author, $category, $id = null) {
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
        $this->category = $category;
    }

    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function getCategory() {
        return $this->category;
    }

    public function toArray() {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'author' => $this->author,
            'category' => $this->category
        ];
    }
}