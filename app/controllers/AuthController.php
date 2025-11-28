<?php

require_once __DIR__ . '/../helpers/mailer.php';
// require_once 'helpers/utils.php';

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
          // Cek Status Aktif/Pending
            if ($user['user_status'] === 'pending') {
                $error_message = "Akun belum aktif. Silakan cek email Anda.";
                require 'login.php';
                return;
            }

            $_SESSION['role']      = 'user';
            $_SESSION['user_id']   = $user['user_id'];
            $_SESSION['username']  = $user['username']   ?? $username;
            $_SESSION['user_name'] = $user['full_name'];
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

    public function register()
    {
        require 'register.php';
    }

    // ====================================================
    // 3. PROSES REGISTER
    // ====================================================
    public function registerProcess()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            require 'register.php'; 
            return;
        }

        // Ambil Data Input (Sesuai name di HTML)
        // Kamu bilang pakai 'full_name', oke kita tangkap disini
        $nama     = trim($_POST['full_name'] ?? ''); 
        $username = trim($_POST['username'] ?? '');
        $email    = trim($_POST['user_email'] ?? '');
        $phone    = trim($_POST['user_phone'] ?? '');
        $address  = trim($_POST['user_address'] ?? '');
        $password = $_POST['password'] ?? '';

        // Validasi
        if (empty($nama) || empty($username) || empty($email) || empty($password)) {
            $error_message = "Nama, Username, Email, dan Password wajib diisi!";
            require 'register.php'; 
            return;
        }

        // Cek Duplikat
        if ($this->userModel->checkUserExists($username, $email)) {
            $error_message = "Username atau Email sudah terdaftar!";
            require 'register.php'; 
            return;
        }

        $token = bin2hex(random_bytes(32)); 
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // BUNGKUS KE ARRAY (PENTING! Agar cocok dengan Model User.php)
        $data = [
            'full_name'        => $nama,
            'username'         => $username,
            'user_email'       => $email,
            'password'         => $hashed_password,
            'user_phone'       => $phone,
            'user_address'     => $address,
            'activation_token' => $token
        ];

        // Simpan ke Database
        if ($this->userModel->register($data)) {
            
            // Kirim Email
            $base_url = "http://tubes.local/"; 
            $link = $base_url . "index.php?controller=auth&action=activate&token=" . $token;

            $subject = "Aktivasi Akun GMS Library";
            $message = "Halo $nama, silakan klik link ini: <a href='$link'>Aktifkan Akun</a>";

            $kirim = Mailer::sendEmail($email, $subject, $message);

            if ($kirim) {
                $_SESSION['alert_success'] = "Registrasi Berhasil! Cek email (Inbox Mailtrap) untuk aktivasi.";
            } else {
                $_SESSION['alert_success'] = "Registrasi Berhasil, tapi email gagal terkirim.";
            }
            
            header("Location: index.php?controller=auth&action=login");
            exit;

        } else {
            $error_message = "Gagal mendaftar. Silakan coba lagi.";
            require __DIR__ . '/../../register.php';
        }
    }

    public function activate()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();

        $token = $_GET['token'] ?? '';

        if ($this->userModel->activate($token)) {
            $_SESSION['alert_success'] = "Akun berhasil diaktifkan! Silakan login.";
        } else {
            $_SESSION['alert_success'] = "Link aktivasi tidak valid atau akun sudah aktif."; 
        }

        header("Location: index.php?controller=auth&action=login");
        exit;
    }

    public function logout()
    {
        session_unset();
        session_destroy();

        header("Location: index.php?controller=auth&action=login");
        exit;
    }
}
