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

        <!-- LEFT SECTION -->
        <div class="left-panel">
            <h1><span class="bold">GMS</span> Library</h1>
            <p>
                Daftar sebagai anggota GMS Library dan dapatkan akses penuh ke koleksi buku,
                e-resources, ruang baca, dan layanan perpustakaan lainnya.
            </p>
        </div>

        <!-- RIGHT SECTION -->
        <div class="right-panel">
            <h2>Register</h2>

            <form action="register_process.php" method="POST">

                <label>Nama Lengkap</label>
                <input type="text" name="user_name" placeholder="Masukkan Nama Lengkap" required>

                <label>Alamat</label>
                <textarea name="user_address" placeholder="Masukkan Alamat" required></textarea>

                <label>No. Telepon</label>
                <input type="text" name="user_phone" placeholder="Masukkan Nomor Telepon" required>

                <label>Username</label>
                <input type="text" name="username" placeholder="Masukkan Username" required>

                <label>Password</label>
                <input type="password" name="password" placeholder="Masukkan Password" required>

                <label>Konfirmasi Password</label>
                <input type="password" name="confirm_password" placeholder="Ulangi Password" required>

                <button type="submit" class="btn-login">Daftar</button>
            </form>

        </div>

    </div>
</div>

</body>
</html>
