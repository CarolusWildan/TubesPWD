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
<title>Login - GMS Library</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="login-background">
    <div class="login-container">

        <!-- LEFT SECTION -->
        <div class="left-panel">
            <h1><span class="bold">GMS</span> Library</h1>
            <p>
                GMS Library adalah perpustakaan modern dengan koleksi buku dan sumber digital yang beragam.
                Menyediakan ruang baca nyaman, area diskusi, serta layanan peminjaman untuk menunjang belajar
                dan penelitian pengunjung.
            </p>
        </div>

        <!-- RIGHT SECTION -->
        <div class="right-panel">
            <h2>Login</h2>
          
            <form id="loginForm" action="index.php?controller=auth&action=login" method="POST">
              <label>Username</label>
              <input type="text" name="username" placeholder="Masukkan Username" required>

              <label>Password</label>
              <input type="password" name="password" placeholder="Masukkan Password" required>

              <button type="submit" class="btn-login">Masuk</button>
          </form>
          <?php if (isset($error_message)) : ?>
            <script>
              // Munculkan pop-up alert browser
              alert("<?php echo $error_message; ?>");
            </script>
            <?php 
              // PENTING: Hapus pesan setelah ditampilkan
              // Supaya kalau di-refresh, alertnya tidak muncul lagi
              unset($error_message); 
            ?>
            <?php endif; ?>
        </div>
        <script src="js/validation.js"></script>
    </div>
</div>

</body>
</html>
