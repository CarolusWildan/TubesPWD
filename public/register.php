<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register - GMS Library</title>
<link rel="stylesheet" href="css/style.css"> 
</head>
<body>

<div class="login-background">
    <div class="login-container">

        <div class="left-panel">
            <h1><span class="bold">GMS</span> Library</h1>
            <p>
                Daftar sebagai anggota GMS Library dan dapatkan akses penuh ke koleksi buku,
                e-resources, ruang baca, dan layanan perpustakaan lainnya.
            </p>
        </div>

        <div class="right-panel">
            <h2>Register</h2>

            <?php if (isset($error_message)) : ?>
                <div class="alert-error">
                    <?php echo $error_message; ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['alert_success'])) : ?>
                <div class="alert-success">
                    <?php echo $_SESSION['alert_success']; ?>
                </div>
                <?php unset($_SESSION['alert_success']); ?>
            <?php endif; ?>
            <form action="index.php?controller=auth&action=register" method="POST">

                <label>Nama Lengkap</label>
                <input type="text" name="user_name" placeholder="Masukkan Nama Lengkap" required>

                <label>Email (Aktif)</label>
                <input type="email" name="user_email" placeholder="contoh@email.com" required>

                <label>Alamat</label>
                <input type="text" name="user_address" placeholder="Masukkan Alamat" required>

                <label>No. Telepon</label>
                <input type="text" name="user_phone" placeholder="Masukkan Nomor Telepon" required>

                <label>Username</label>
                <input type="text" name="username" placeholder="Masukkan Username" required>

                <label>Password</label>
                <input type="password" name="password" placeholder="Masukkan Password" required>

                <button type="submit" class="btn-login">Daftar</button>
            </form>
            
            <div style="margin-top: 15px; text-align: center; font-size: 0.9rem;">
                Sudah punya akun? <a href="index.php?controller=auth&action=login" style="font-weight:bold;">Login disini</a>
            </div>

        </div>

    </div>
</div>

</body>
</html>