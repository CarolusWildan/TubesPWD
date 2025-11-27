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

    // ====================================================
    // TAMPILKAN FORM LOGIN
    // route: index.php?controller=auth&action=loginForm
    // ====================================================
    public function loginForm()
    {
        // kalau sudah login, boleh langsung diarahkan ke halaman lain
        // if (isset($_SESSION['role'])) {
        //     header("Location: index.php");
        //     exit;
        // }

        include "../views/auth/login.php";
    }

    // ====================================================
    // PROSES LOGIN (POST)
    // route: index.php?controller=auth&action=login
    // ====================================================
    public function login() 
    {
        $username = $_POST['username'] ?? null;
        $password = $_POST['password'] ?? null;
        $role     = $_POST['role']     ?? null; // "user" atau "librarian"

        if (!$username || !$password || !$role) {
            echo "<script>alert('Username, password, dan role wajib diisi'); history.back();</script>";
            return;
        }

        if ($role === 'user') {
            // ------------- LOGIN MAHASISWA -------------
            $user = $this->userModel->login($username, $password);

            if (!$user) {
                echo "<script>alert('Login gagal: username atau password user salah'); history.back();</script>";
                return;
            }

            // sesuaikan dengan enum di DB: 'ACTIVE' / 'INACTIVE' atau 'active' / 'inactive'
            if (strtoupper($user['user_status']) !== 'ACTIVE') {
                echo "<script>alert('Akun user belum aktif'); history.back();</script>";
                return;
            }

            $_SESSION['role']      = 'user';
            $_SESSION['user_id']   = $user['user_id'];
            $_SESSION['user_name'] = $user['user_name'];
            $_SESSION['username']  = $user['username'];

            // setelah login user, arahkan ke halaman utama user
            header("Location: index.php");
            exit;

        } elseif ($role === 'librarian') {
            // ------------- LOGIN LIBRARIAN -------------
            $lib = $this->librarianModel->login($username, $password);

            if (!$lib) {
                echo "<script>alert('Login gagal: username atau password librarian salah'); history.back();</script>";
                return;
            }

            // kalau kamu sudah tambah kolom librarian_status
            if (isset($lib['librarian_status']) && strtoupper($lib['librarian_status']) !== 'ACTIVE') {
                echo "<script>alert('Akun librarian tidak aktif'); history.back();</script>";
                return;
            }

            $_SESSION['role']               = 'librarian';
            $_SESSION['librarian_id']       = $lib['librarian_id'];
            $_SESSION['librarian_name']     = $lib['librarian_name'];
            $_SESSION['librarian_username'] = $lib['librarian_username'];
            $_SESSION['librarian_role']     = $lib['librarian_role'] ?? 'STAFF'; // ADMIN / STAFF

            // setelah login librarian, bisa arahkan ke dashboard admin
            header("Location: index.php"); // atau: index.php?controller=dashboard&action=admin
            exit;

        } else {
            echo "<script>alert('Role tidak dikenali'); history.back();</script>";
            return;
        }
    }

    // ====================================================
    // LOGOUT
    // route: index.php?controller=auth&action=logout
    // ====================================================
    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        session_unset();
        session_destroy();

        header("Location: index.php?controller=auth&action=loginForm");
        exit;
    }
}
