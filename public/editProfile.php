<?php
// asumsi: $user dikirim dari UserController->profile()
// $user punya key: user_name, user_address, user_phone
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
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
<header class="navbar">
    <h2 class="logo">GMS Library</h2>
    
    <div class="toggle-btn"></div>
    
    <nav class="nav-menu">
        <ul>
            <li><a href="index.php">Beranda</a></li>
            <li><a href="#riwayat">Riwayat</a></li>
            <li><a href="index.php?controller=user&action=profile">Profil</a></li>
        </ul>

        <div class="user-action">
            <div class="icon-circle">
                <a href="index.php?controller=user&action=profile">
                    <div class="circle"></div> 
                </a>
            </div>
        </div>
    </nav>
</header>

    <!-- Main Content -->
    <main>
        <div class="profile-container">
                    <div class="avatar-section">
            <div class="avatar-placeholder">
                <!-- Tombol + untuk upload -->
                <label class="upload-btn">
                    <input type="file" name="profile_image" accept="image/*" hidden>
                    +
                </label>
            </div>
        </div>


            <!-- FORM EDIT PROFIL -->
            <form class="profile-form" 
                  action="index.php?controller=user&action=updateProfile" 
                  method="POST">
                  
                <div class="form-group">
                    <label for="user">Nama</label>
                    <input type="text" id="user" name="name"
                           value="<?= htmlspecialchars($user['user_name'] ?? '') ?>" 
                           required>
                </div>

                <div class="form-group">
                    <label for="address">Alamat</label>
                    <input type="text" id="address" name="address"
                           value="<?= htmlspecialchars($user['user_address'] ?? '') ?>" 
                           required>
                </div>

                <div class="form-group">
                    <label for="phone">No. Telepon</label>
                    <input type="text" id="phone" name="phone"
                           value="<?= htmlspecialchars($user['user_phone'] ?? '') ?>" 
                           required>
                </div>

                <div class="button-row">
                    <a href="profile.php?controller=userController&action=profile"><button type="button" class="btn-cancel" onclick="history.back()">Batal</button></a>
                    <a href="profile.php?controller=userController&action=update"><button type="submit" class="btn-save">Simpan</button></a>
                </div>
            </form>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-left">
            <div class="h2">
                <h2>GMS Library</h2>
            </div>
            <div class="footer-left">
                <p>Pusat Informasi Buku & Edukasi</p>
            </div>
        </div>

        <div class="footer-mid">
            <p><b>Navigasi</b></p>
            <p>Beranda</p>
            <p>Pengguna</p>
        </div>

        <div class="footer-mid">
            <p><b>Kontak</b></p>
            <p>email@gmslibrary.com</p>
            <p>+62 812 3456 7890</p>
        </div>

        <div class="footer-right">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.0881220390825!2d110.41220107476592!3d-7.780480992239148!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a59f1d2361f71%3A0x4a2ce83adbcfd5aa!2sPerpustakaan%20Universitas%20Atma%20Jaya%20Yogyakarta!5e0!3m2!1sid!2sid!4v1764419745591!5m2!1sid!2sid"
                width="350"
                height="250"
                style="border:0; border-radius:10px;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </footer>
</body>
</html>
