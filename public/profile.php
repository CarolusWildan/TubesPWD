<?php
session_start();

// Contoh data user (ganti dengan data dari UserController Anda nanti)
$user = [
    'user_name' => 'Kai',
    'user_address' => 'Jl. Merdeka No. 123, Jakarta',
    'user_phone' => '081234567890'
];

// Jika sudah punya UserController, ganti bagian atas dengan:
// require_once '../controllers/UserController.php';
// $controller = new UserController();
// $user = $controller->getCurrentUser();
// if (!$user) { header("Location: login.php"); exit(); }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna - GMS Library</title>
    <link rel="stylesheet" href="./css/profile.css">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="logo">GMS Library</div>
        <nav>
            <a href="index.php">Beranda</a>
            <a href="history.php">Riwayat</a>
            <a href="profile.php" class="active">Profil</a>
        </nav>
    </header>

    <!-- Main Content -->
    <main>
        <div class="profile-container">
            <div class="avatar-section">
                <div class="avatar-placeholder"></div>
                <button class="edit-btn">Edit</button>
            </div>

            <form class="profile-form">
                <div class="form-group">
                    <label for="user">Nama</label>
                    <input type="text" id="user" name="user" value="<?= htmlspecialchars($user['user_name']) ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="address">Alamat</label>
                    <input type="text" id="address" name="address" value="<?= htmlspecialchars($user['user_address']) ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="phone">No. Telepon</label>
                    <input type="text" id="phone" name="phone" value="<?= htmlspecialchars($user['user_phone']) ?>" readonly>
                </div>
            </form>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-logo">GMS Library</div>
            <div class="footer-nav">
                <a href="index.php">Beranda</a>
                <a href="history.php">Riwayat</a>
                <a href="profile.php">Profil</a>
            </div>
            <div class="footer-contact">
                <p>📧 info@gmslibrary.com</p>
                <p>📞 (021) 1234-5678</p>
            </div>
            <div class="footer-map">
                <img src="https://via.placeholder.com/150x100?text=Peta+Lokasi" alt="Lokasi GMS Library">
            </div>
        </div>
        <div class="footer-bottom">
            &copy; 2025 GMS Library. All Rights Reserved.
        </div>
    </footer>
</body>
</html>