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
          <div style="margin-top: 15px; text-align: center; font-size: 0.9rem;">
                Belom punya akun? <a href="index.php?controller=auth&action=register" style="font-weight:bold;">Daftar Dsisini</a>
            </div>

          <?php if (isset($_SESSION['error_message'])) : ?>
            <script>
                alert("<?php echo $_SESSION['error_message']; ?>");
            </script>
            <?php unset($_SESSION['error_message']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['alert_success'])) : ?>
          <script>
              alert("<?= $_SESSION['alert_success']; ?>");
          </script>
          <?php unset($_SESSION['alert_success']); ?>
        <?php endif; ?>


        </div>
        <script src="js/validation.js"></script>
    </div>
</div>

</body>
</html>
