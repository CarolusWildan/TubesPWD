<?php
require_once __DIR__ . '/../config/database.php';

class Borrow {
    private $conn;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }

    // ==================================
    // CREATE BORROW TRANSACTION
    // ==================================
    public function create($user_id, $book_id, $librarian_id, $borrow_date, $due_date) {
    // Cek apakah buku tersedia
    $sqlCheck = "SELECT status FROM book WHERE book_id = ?";
    $stmtCheck = $this->conn->prepare($sqlCheck);
    $stmtCheck->bind_param("i", $book_id);
    $stmtCheck->execute();
    $result = $stmtCheck->get_result()->fetch_assoc();

    if($result['status'] === 'DIPINJAM') {
        return false; // buku sudah dipinjam
    }

    // Insert borrow
    $sql = "INSERT INTO borrow (user_id, book_id, librarian_id, borrow_date, due_date)
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("iiiss", $user_id, $book_id, $librarian_id, $borrow_date, $due_date);

    if($stmt->execute()) {
        // Update book status
        $sqlUpdate = "UPDATE book SET status = 'DIPINJAM' WHERE book_id = ?";
        $stmtUpdate = $this->conn->prepare($sqlUpdate);
        $stmtUpdate->bind_param("i", $book_id);
        $stmtUpdate->execute();
        return true;
    }
    return false;
}


    // ==================================
    // GET ALL BORROW DATA
    // ==================================
    public function getAll() {
        $sql = "SELECT b.borrow_id, u.user_name, bk.title, l.librarian_name, 
                       b.borrow_date, b.due_date, b.status
                FROM borrow b
                JOIN user u ON b.user_id = u.user_id
                JOIN book bk ON b.book_id = bk.book_id
                JOIN librarian l ON b.librarian_id = l.librarian_id
                ORDER BY b.borrow_id DESC";

        $result = $this->conn->query($sql);

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    // ==================================
    // GET BORROW BY ID
    // ==================================
    public function getById($borrow_id) {
        $sql = "SELECT * FROM borrow WHERE borrow_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $borrow_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }


    // ==================================
    // DELETE BORROW DATA
    // ==================================
    public function delete($borrow_id) {
        $sql = "DELETE FROM borrow WHERE borrow_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $borrow_id);
        return $stmt->execute();
    }

    // ==================================
    // GET BORROW BY USER
    // ==================================
    public function getByUser($user_id) {
        $sql = "SELECT * FROM borrow WHERE user_id = ? ORDER BY borrow_id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();

        $result = $stmt->get_result();
        $data = [];

        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }
}
?>
