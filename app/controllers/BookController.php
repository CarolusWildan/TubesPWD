<?php

class BookController
{
    private mysqli $conn;
    private Book $bookModel;

    public function __construct(mysqli $conn)
    {
        $this->conn = $conn;
        $this->bookModel = new Book($this->conn);

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // ================================
    // GET /books
    // ================================
    public function index(): void
    {
        $books = $this->bookModel->getAll();

        require BASE_PATH . '/public/views/book_list.php';
        return;
    }

    // ================================
    // GET /books?id=1
    // ================================
    public function show(int $book_id): void
    {
        $book = $this->bookModel->getById($book_id);

        if (!$book) {
            http_response_code(404);
            echo json_encode([
                "status"  => "error",
                "message" => "Book not found"
            ]);
            return;
        }

        echo json_encode([
            "status" => "success",
            "data"   => $book
        ]);
    }

    public function search() {
        $keyword = $_GET['keyword'] ?? '';

        $books = $this->bookModel->search($keyword);

        // Jika kosong → kirim pesan alert
        if (empty($books)) {
            $_SESSION['search_error'] = "Buku dengan kata kunci '$keyword' tidak ditemukan!";
            header("Location: index.php");
            exit;
        }

        require 'book_list.php';
    }


    // ================================
    // POST /books/create
    // ================================
    public function create(): void
    {
        $title        = $_POST['title']        ?? null;
        $author       = $_POST['author']       ?? null;
        $publish_year = $_POST['publish_year'] ?? null;
        $category     = $_POST['category']     ?? null;
        $cover        = $_POST['cover']        ?? null;

        if (!$title || !$author || !$publish_year || !$category || !$cover) {
            http_response_code(400);
            echo json_encode([
                "status"  => "error",
                "message" => "All fields (title, author, publish_year, category, cover) are required"
            ]);
            return;
        }

        $created = $this->bookModel->create(
            $title,
            $author,
            $publish_year,
            $category,
            $cover
        );

        echo json_encode([
            "status"  => $created ? "success" : "error",
            "message" => $created ? "Book created" : "Failed to create book"
        ]);
    }

    // ================================
    // POST /books/update?id=1
    // ================================
    public function update(int $book_id): void
    {
        $book = $this->bookModel->getById($book_id);
        if (!$book) {
            http_response_code(404);
            echo json_encode([
                "status"  => "error",
                "message" => "Book not found"
            ]);
            return;
        }

        $title        = $_POST['title']        ?? $book['title'];
        $author       = $_POST['author']       ?? $book['author'];
        $publish_year = $_POST['publish_year'] ?? $book['publish_year'];
        $category     = $_POST['category']     ?? $book['category'];
        $cover        = $_POST['cover']        ?? $book['cover'];

        $updated = $this->bookModel->update(
            $book_id,
            $title,
            $author,
            $publish_year,
            $category,
            $cover
        );

        echo json_encode([
            "status"  => $updated ? "success" : "error",
            "message" => $updated ? "Book updated" : "Failed to update"
        ]);
    }

    // ================================
    // GET /books/delete?id=1
    // ================================
    public function delete(int $book_id): void
    {
        $deleted = $this->bookModel->delete($book_id);

        echo json_encode([
            "status"  => $deleted ? "success" : "error",
            "message" => $deleted ? "Book deleted" : "Failed to delete"
        ]);
    }
}
