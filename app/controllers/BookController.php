<?php

require_once __DIR__ . '/../models/Book.php';

class BookController
{
    // GET /books
    public function index()
    {
        $books = Book::getAll();

        echo json_encode([
            "status" => "success",
            "data" => $books
        ]);
    }

    // GET /books?id=1
    public function show($book_id)
    {
        $book = Book::getById($book_id);

        if (!$book) {
            echo json_encode([
                "status" => "error",
                "message" => "Book not found"
            ]);
            return;
        }

        echo json_encode([
            "status" => "success",
            "data" => $book
        ]);
    }

    // POST /books/create
    public function create()
    {
        $title  = $_POST['title'] ?? null;
        $author = $_POST['author'] ?? null;
        $year   = $_POST['publish_year'] ?? null;
        $category = $_POST['category'] ?? null;
        $cover = $_POST['cover'] ?? null;


        if (!$title || !$author || !$year || !$category || !$cover) {
            echo json_encode([
                "status" => "error",
                "message" => "All fields are required"
            ]);
            return;
        }

        $created = Book::create($title, $author, $publish_year, $category, $cover);

        echo json_encode([
            "status" => "success",
            "message" => "Book created",
            "data" => $created
        ]);
    }

    // POST /books/update?id=1
    public function update($book_id)
    {
        $book = Book::getById($book_id);
        if (!$book) {
            echo json_encode([
                "status" => "error",
                "message" => "Book not found"
            ]);
            return;
        }
        $title  = $_POST['title'] ?? null;
        $author = $_POST['author'] ?? null;
        $publish_year   = $_POST['publish_year'] ?? null;
        $category = $_POST['category'] ?? null;
        $cover = $_POST['cover'] ?? null;


        $updated = Book::update($book_id, $title, $author, $publish_year, $category, $cover);

        echo json_encode([
            "status" => $updated ? "success" : "error",
            "message" => $updated ? "Book updated" : "Failed to update"
        ]);
    }

    // GET /books/delete?id=1
    public function delete($book_id)
    {
        $deleted = Book::delete($book_id);

        echo json_encode([
            "status" => $deleted ? "success" : "error",
            "message" => $deleted ? "Book deleted" : "Failed to delete"
        ]);
    }
}
