<?php
require_once __DIR__ . "/../app/init.php";

// Cek session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Cek login
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php?controller=user&action=showLoginForm");
    exit;
}

// Ambil data user terbaru untuk ditampilkan di form
$userModel = new User($conn);
$user = $userModel->getById($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil - GMS Library</title>
    
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/profile.css">
</head>
<body>

    <header class="navbar">
        <h2 class="logo">GMS Library</h2>
        <div class="toggle-btn"></div>
        <nav class="nav-menu">
            <ul>
                <li><a href="index.php">Beranda</a></li>
                <li><a href="history.php">Riwayat</a></li>
                <li><a href="profile.php">Profil</a></li>
            </ul>

            <div class="user-action">
                <div class="icon-circle">
                    <a href="profile.php">
                        <div class="circle"></div> 
                    </a>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="profile-container">

            <form class="profile-form" action="index.php?controller=user&action=updateProfile" method="POST" enctype="multipart/form-data">
                
                <div class="avatar-section">
                    <div class="avatar-placeholder">
                        <span style="font-size: 40px;">👤</span>
                        
                        <label class="upload-btn">
                            <input type="file" name="profile_image" accept="image/*" hidden>
                            +
                        </label>
                    </div>
                    <p style="font-size: 12px; color: #666; margin-top: 10px;">Ketuk '+' untuk ganti foto</p>
                </div>

                <div class="form-group">
                    <label for="full_name">Nama Lengkap</label>
                    <input type="text" id="full_name" name="full_name" 
                           value="<?= htmlspecialchars($user['full_name'] ?? '') ?>" required>
                </div>

                <div class="form-group">
                    <label for="user_address">Alamat</label>
                    <input type="text" id="user_address" name="user_address" 
                           value="<?= htmlspecialchars($user['user_address'] ?? '') ?>" required>
                </div>

                <div class="form-group">
                    <label for="user_phone">No. Telepon</label>
                    <input type="text" id="user_phone" name="user_phone" 
                           value="<?= htmlspecialchars($user['user_phone'] ?? '') ?>" required>
                </div>

                <div class="button-row">
                    <a href="profile.php" class="btn-cancel" style="text-decoration:none; text-align:center; padding-top:12px; box-sizing: border-box;">Batal</a>
                    
                    <button type="submit" class="btn-save">Simpan</button>
                </div>
            </form>

            <?php if (isset($_SESSION['update_error'])) : ?>
                <script>
                    alert("<?= $_SESSION['update_error']; ?>");
                </script>
                <?php unset($_SESSION['update_error']); ?>
            <?php endif; ?>

        </div>
    </main>

    <footer class="footer">
        <div class="footer-left">
            <div class="h2">
                <h2>GMS Library</h2>
            </div>
            <div class="footer-left-desc">
                <p>GMS Library adalah perpustakaan modern dengan koleksi buku dan sumber digital yang beragam.</p>
            </div>
        </div>

        <div class="footer-mid">
            <p><b>Navigasi</b></p>
            <p>Beranda</p>
            <p>Riwayat</p>
            <p>Profil</p>
        </div>

        <div class="footer-mid">
            <p><b>Lokasi</b></p>
            <p>Yogyakarta, Indonesia</p>
            <p><b class="kontak-title">Kontak</b></p>
            <p>email@gmslibrary.com</p>
        </div>
        
        <div class="footer-right">
             <div style="width:350px; height:250px; background:#ddd; border-radius:10px;">[Map Placeholder]</div>
        </div>
    </footer>

</body>
</html>