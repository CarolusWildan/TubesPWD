<?php

class User {

    private mysqli $conn;
    private string $table = "user";

    public function __construct(mysqli $conn) {
        $this->conn = $conn;
    }

    // ====================================================
    // REGISTER USER (Mahasiswa)
    // ====================================================
    public function register($name, $address, $phone, $username, $password, $activation_token) {

        $sql = "INSERT INTO {$this->table} 
                (user_name, user_address, user_phone, registration_date, username, password, user_status, activation_token)
                VALUES (?, ?, ?, NOW(), ?, ?, 'INACTIVE', ?)";

        $stmt = $this->conn->prepare($sql);

        $hashed = password_hash($password, PASSWORD_DEFAULT);

        $stmt->bind_param(
            "ssssss",
            $name,
            $address,
            $phone,
            $username,
            $hashed,
            $activation_token
        );

        return $stmt->execute();
    }

    // ====================================================
    // LOGIN USER
    // ====================================================
    public function login($username, $password) {
        $sql = "SELECT * FROM {$this->table} WHERE username = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();

        $user = $stmt->get_result()->fetch_assoc();

        if (!$user) return false;

        if (password_verify($password, $user['password'])) {
            return $user; 
        }

        return false;
    }

    // ====================================================
    // GET ALL USERS (borrowers)
    // ====================================================
    public function getAll() {
        $sql = "SELECT user_id, user_name, username, user_address, user_phone, registration_date, user_status
                FROM {$this->table}
                ORDER BY user_id DESC";

        return $this->conn->query($sql)->fetch_all(MYSQLI_ASSOC);
    }

    // ====================================================
    // GET USER BY ID
    // ====================================================
    public function getById($user_id) {
        $sql = "SELECT * FROM {$this->table} WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();

        return $stmt->get_result()->fetch_assoc();
    }

    // ====================================================
    // UPDATE USER PROFILE
    // ====================================================
    public function update($user_id, $name, $address, $phone) {
        $sql = "UPDATE {$this->table}
                SET user_name=?, user_address=?, user_phone=?
                WHERE user_id=?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssi", $name, $address, $phone, $user_id);

        return $stmt->execute();
    }

    // ====================================================
    // ACTIVATE ACCOUNT
    // ====================================================
    public function activate($token) {
        $sql = "UPDATE {$this->table} SET user_status='ACTIVE'
                WHERE activation_token = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $token);

        return $stmt->execute();
    }

    // ====================================================
    // DELETE USER
    // ====================================================
    public function delete($user_id) {
        $sql = "DELETE FROM {$this->table} WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);

        return $stmt->execute();
    }
}
?>
