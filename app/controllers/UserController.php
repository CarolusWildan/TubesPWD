<?php

class UserController
{
    private mysqli $conn;
    private User $userModel;

    public function __construct(mysqli $conn)
    {
        $this->conn = $conn;
        $this->userModel = new User($this->conn);
    }

    // ====================================================
    // LIST SEMUA USER (untuk admin)
    // ====================================================
    public function index()
    {
        $users = $this->userModel->getAll();
        // tampilin di tabel
        include "../views/user/index.php";
    }

    // ====================================================
    // HALAMAN REGISTER FORM
    // ====================================================
    public function showRegisterForm()
    {
        include "../views/user/register.php";
    }

    // ====================================================
    // PROSES REGISTER
    // ====================================================
    public function register()
    {
        $name     = $_POST['name']     ?? null;
        $address  = $_POST['address']  ?? null;
        $phone    = $_POST['phone']    ?? null;
        $username = $_POST['username'] ?? null;
        $password = $_POST['password'] ?? null;

        if (!$name || !$address || !$phone || !$username || !$password) {
            // validasi sederhana
            echo "<script>alert('Semua field wajib diisi'); history.back();</script>";
            return;
        }

        // token aktivasi acak
        $activation_token = bin2hex(random_bytes(16));

        $success = $this->userModel->register(
            $name,
            $address,
            $phone,
            $username,
            $password,
            $activation_token
        );

        if ($success) {
            // di sini nanti bisa kirim email aktivasi pakai token
            // contoh link: index.php?controller=user&action=activate&token=xxxx

            echo "<script>alert('Registrasi berhasil! Silakan cek email untuk aktivasi akun.'); window.location='index.php?controller=user&action=showLoginForm';</script>";
        } else {
            echo "<script>alert('Registrasi gagal'); history.back();</script>";
        }
    }

    // ====================================================
    // HALAMAN LOGIN FORM
    // ====================================================
    public function showLoginForm()
    {
        include "../views/user/login.php";
    }

    // ====================================================
    // PROSES LOGIN
    // ====================================================
    public function login()
    {
        $username = $_POST['username'] ?? null;
        $password = $_POST['password'] ?? null;

        if (!$username || !$password) {
            echo "<script>alert('Username dan password wajib diisi'); history.back();</script>";
            return;
        }

        $user = $this->userModel->login($username, $password);

        if (!$user) {
            echo "<script>alert('Username atau password salah'); history.back();</script>";
            return;
        }

        if ($user['user_status'] !== 'ACTIVE') {
            echo "<script>alert('Akun belum aktif. Silakan aktivasi terlebih dahulu.'); history.back();</script>";
            return;
        }

        // set session
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION['user_id']   = $user['user_id'];
        $_SESSION['user_name'] = $user['user_name'];
        $_SESSION['username']  = $user['username'];

        // redirect ke halaman home / dashboard
        header("Location: index.php");
        exit;
    }

    // ====================================================
    // LOGOUT
    // ====================================================
    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        session_unset();
        session_destroy();

        header("Location: index.php?controller=user&action=showLoginForm");
        exit;
    }

    // ====================================================
    // PROFIL USER LOGIN
    // ====================================================
    public function profile()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?controller=user&action=showLoginForm");
            exit;
        }

        $user_id = $_SESSION['user_id'];
        $user    = $this->userModel->getById($user_id);

        include "../views/user/profile.php";
    }

    // ====================================================
    // UPDATE PROFIL (POST)
    // ====================================================
    public function updateProfile()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?controller=user&action=showLoginForm");
            exit;
        }

        $user_id = $_SESSION['user_id'];

        $name    = $_POST['name']    ?? null;
        $address = $_POST['address'] ?? null;
        $phone   = $_POST['phone']   ?? null;

        if (!$name || !$address || !$phone) {
            echo "<script>alert('Semua field profil wajib diisi'); history.back();</script>";
            return;
        }

        $success = $this->userModel->update($user_id, $name, $address, $phone);

        if ($success) {
            echo "<script>alert('Profil berhasil diperbarui'); window.location='index.php?controller=user&action=profile';</script>";
        } else {
            echo "<script>alert('Gagal memperbarui profil'); history.back();</script>";
        }
    }

    // ====================================================
    // AKTIVASI AKUN VIA TOKEN
    // link: index.php?controller=user&action=activate&token=xxxxx
    // ====================================================
    public function activate()
    {
        $token = $_GET['token'] ?? null;

        if (!$token) {
            echo "<script>alert('Token tidak valid'); window.location='index.php';</script>";
            return;
        }

        $success = $this->userModel->activate($token);

        if ($success) {
            echo "<script>alert('Akun berhasil diaktivasi. Silakan login.'); window.location='index.php?controller=user&action=showLoginForm';</script>";
        } else {
            echo "<script>alert('Aktivasi gagal atau token tidak valid'); window.location='index.php';</script>";
        }
    }

    // ====================================================
    // HAPUS USER (untuk admin)
    // ====================================================
    public function delete()
    {
        $user_id = $_GET['id'] ?? null;

        if (!$user_id) {
            echo "<script>alert('User ID tidak ditemukan'); history.back();</script>";
            return;
        }

        $success = $this->userModel->delete($user_id);

        if ($success) {
            echo "<script>alert('User berhasil dihapus'); window.location='index.php?controller=user&action=index';</script>";
        } else {
            echo "<script>alert('Gagal menghapus user'); history.back();</script>";
        }
    }
}
