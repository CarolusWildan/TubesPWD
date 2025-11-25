<?php
require_once __DIR__ . '/../config/database.php';

class Book {
    private $conn;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }

    // =========================
    // CREATE BOOK
    // =========================
    public function create($title, $author, $publish_year, $category, $cover) {
        $sql = "INSERT INTO book (title, author, publish_year, category, cover)
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssiss", $title, $author, $publish_year, $category, $cover);

        return $stmt->execute();
    }

    // =========================
    // READ ALL BOOKS
    // =========================
    public function getAll() {
        $sql = "SELECT * FROM book ORDER BY book_id DESC";
        $result = $this->conn->query($sql);

        $books = [];
        while ($row = $result->fetch_assoc()) {
            $books[] = $row;
        }
        return $books;
    }

    // =========================
    // GET BOOK BY Title
    // =========================
    public function getByTitle($title) {
        $sql = "SELECT * FROM book WHERE title = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $title);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // =========================
    // UPDATE BOOK
    // =========================
    public function update($book_id, $title, $author, $publish_year, $category, $cover) {
        $sql = "UPDATE book SET 
                    title=?, 
                    author=?, 
                    publish_year=?, 
                    category=?, 
                    cover=?
                WHERE book_id = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("isssss", $book_id, $title, $author, $publish_year, $category, $cover);

        return $stmt->execute();
    }

    // =========================
    // DELETE BOOK
    // =========================
    public function delete($book_id) {
        $sql = "DELETE FROM book WHERE book_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $book_id);

        return $stmt->execute();
    }
}
?>
