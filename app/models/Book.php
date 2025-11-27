<?php
class Book {

    private mysqli $conn;
    private string $table = "book";

    public function __construct(mysqli $conn) {
        $this->conn = $conn;
    }

    // CREATE
    public function create($title, $author, $publish_year, $category, $cover) {
        $sql = "INSERT INTO {$this->table} (title, author, publish_year, category, cover)
                VALUES (?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssiss", $title, $author, $publish_year, $category, $cover);

        return $stmt->execute();
    }

    // READ ALL
    public function getAll() {
        $sql = "SELECT * FROM {$this->table} ORDER BY book_id DESC";
        $result = $this->conn->query($sql);

        $books = [];
        while ($row = $result->fetch_assoc()) {
            $books[] = $row;
        }
        return $books;
    }

    // GET BY ID
    public function getById($book_id) {
        $sql = "SELECT * FROM {$this->table} WHERE book_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $book_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // UPDATE
    public function update($book_id, $title, $author, $publish_year, $category, $cover) {
        $sql = "UPDATE {$this->table} SET 
                    title=?, 
                    author=?, 
                    publish_year=?, 
                    category=?, 
                    cover=?
                WHERE book_id = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssissi",
            $title,
            $author,
            $publish_year,
            $category,
            $cover,
            $book_id
        );

        return $stmt->execute();
    }

    // DELETE
    public function delete($book_id) {
        $sql = "DELETE FROM {$this->table} WHERE book_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $book_id);
        return $stmt->execute();
    }
}
?>
