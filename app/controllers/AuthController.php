<?php

class AuthController
{
    private mysqli $conn;
    private User $userModel;
    private Librarian $librarianModel;

    public function __construct(mysqli $conn)
    {
        $this->conn           = $conn;
        $this->userModel      = new User($this->conn);
        $this->librarianModel = new Librarian($this->conn);

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function login()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // HARUS POST, kalau bukan POST balikin ke form
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            require_once 'login.php'; 
            return; // Stop function disini agar kode bawah tidak jalan
        }
        //ambil data username dan pass dari form
        $username = $_POST['username'] ?? null;
        $password = $_POST['password'] ?? null;

        // ===============================
        // 1. Coba login sebagai LIBRARIAN
        // ===============================
        $lib = $this->librarianModel->loginLib($username, $password);

        if ($lib) {
            $_SESSION['role']               = 'librarian';
            $_SESSION['librarian_id']       = $lib['librarian_id'];
            $_SESSION['librarian_name']     = $lib['librarian_name'] ?? null;
            $_SESSION['librarian_username'] = $lib['librarian_username'] ?? $username;
            $_SESSION['librarian_role']     = $lib['librarian_role'] ?? 'STAFF';
            $_SESSION['alert_success'] = "Selamat Datang, Librarian " . ($lib['librarian_name'] ?? $username);
            header("Location: index.php"); 
            exit;
        }

        // ===============================
        // 2. Kalau bukan librarian, cek USER
        // ===============================
        $user = $this->userModel->loginUser($username, $password);

        if ($user) {
            $_SESSION['role']      = 'user';
            $_SESSION['user_id']   = $user['user_id'];
            $_SESSION['username']  = $user['username']   ?? $username;
            $_SESSION['alert_success'] = "Selamat Datang, " . ($user['username'] ?? $username);
            header("Location: index.php"); 
            exit;
        }

        // ===============================
        // 3. Kalau dua-duanya gagal
        // ===============================
        $error_message = "Username atau Password salah!";
        require 'login.php';
        return;
    }

    public function logout()
    {
        session_unset();
        session_destroy();

        header("Location: index.php?controller=auth&action=login");
        exit;
    }
}
