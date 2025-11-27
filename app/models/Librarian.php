<?php

class Librarian
{
    private mysqli $conn;
    private string $table = "librarian";

    public function __construct(mysqli $conn)
    {
        $this->conn = $conn;
    }

    // ====================================================
    // REGISTER LIBRARIAN (ADMIN / STAFF)
    // ====================================================
    public function register(
        string $name,
        string $username,
        string $password,
        string $role,        // ADMIN / STAFF (dipilih di form)
        string $phone,
        string $address,
        string $status = 'ACTIVE'
    ): bool {
        $sql = "INSERT INTO {$this->table}
                (librarian_name, librarian_username, librarian_password,
                 librarian_role, librarian_phone, librarian_address, librarian_status)
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);

        $hashed = password_hash($password, PASSWORD_DEFAULT);

        $stmt->bind_param(
            "sssssss",
            $name,
            $username,
            $hashed,
            $role,
            $phone,
            $address,
            $status
        );

        return $stmt->execute();
    }

    // ====================================================
    // LOGIN LIBRARIAN
    // ====================================================
    public function login(string $username, string $password)
    {
        $sql = "SELECT * FROM {$this->table} WHERE librarian_username = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();

        $lib = $stmt->get_result()->fetch_assoc();
        if (!$lib) return false;

        if (password_verify($password, $lib['librarian_password'])) {
            return $lib;
        }

        return false;
    }

    // ====================================================
    // GET ALL LIBRARIANS
    // ====================================================
    public function getAll(): array
    {
        $sql = "SELECT librarian_id, librarian_name, librarian_username,
                       librarian_role, librarian_phone, librarian_status, created_at
                FROM {$this->table}
                ORDER BY librarian_id DESC";

        return $this->conn->query($sql)->fetch_all(MYSQLI_ASSOC);
    }

    // ====================================================
    // GET LIBRARIAN BY ID
    // ====================================================
    public function getById(int $id): ?array
    {
        $sql = "SELECT * FROM {$this->table} WHERE librarian_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $data = $stmt->get_result()->fetch_assoc();
        return $data ?: null;
    }

    // ====================================================
    // UPDATE LIBRARIAN (phone & address wajib diisi)
    // ====================================================
    public function update(
        int $id,
        string $name,
        string $role,
        string $phone,
        string $address,
        string $status
    ): bool {
        $sql = "UPDATE {$this->table}
                SET librarian_name    = ?,
                    librarian_role    = ?,
                    librarian_phone   = ?,
                    librarian_address = ?,
                    librarian_status  = ?
                WHERE librarian_id = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssssi", $name, $role, $phone, $address, $status, $id);

        return $stmt->execute();
    }

    // ====================================================
    // UPDATE PASSWORD
    // ====================================================
    public function updatePassword(int $id, string $newPassword): bool
    {
        $sql = "UPDATE {$this->table}
                SET librarian_password = ?
                WHERE librarian_id = ?";

        $stmt = $this->conn->prepare($sql);
        $hashed = password_hash($newPassword, PASSWORD_DEFAULT);
        $stmt->bind_param("si", $hashed, $id);

        return $stmt->execute();
    }

    // ====================================================
    // DELETE LIBRARIAN
    // ====================================================
    public function delete(int $id): bool
    {
        $sql = "DELETE FROM {$this->table} WHERE librarian_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }
}
