<?php
require_once __DIR__ . "/../app/init.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$controller = $_GET['controller'] ?? null;
$action     = $_GET['action']     ?? null;

// Kalau yang diminta adalah AUTH (login/logout)
if ($controller === 'auth') {
    $authController = new AuthController($conn);

    switch ($action) {
        case 'login':
            // proses login (POST)
            $authController->login();
            break;

        case 'logout':
            $authController->logout();
            break;
        
        case 'register':
            $authController->registerProcess();
            break;
    }

    // HENTIKAN SCRIPT DI SINI
    exit;
}

if (!isset($_SESSION['role'])) {
    header("Location: index.php?controller=auth&action=login");
    exit;
}
?>

<?php if (isset($_SESSION['alert_success'])) : ?>
  <script>
      alert("<?php echo $_SESSION['alert_success']; ?>");
  </script>
  <?php 
      // PENTING: Hapus pesan setelah ditampilkan
      // Supaya kalau di-refresh, alertnya tidak muncul lagi
      unset($_SESSION['alert_success']); 
  ?>
<?php endif; ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GMS Library</title>
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>

    <!-- NAVBAR -->
    <header class="navbar">
        <h2 class="logo">GMS Library</h2>
        <div class="toggle-btn"></div>
    </header>

    <!-- HERO -->
    <section class="hero">
        <img src="./asset/background.png" alt="Bookshelf" />
    </section>

    <!-- SEARCH BAR -->
    <section class="search-section input">
        <div class="search-box">
        <input type="text" placeholder="Cari Buku..." />
            <button type="submit">Cari</button>
        </div>
    </section>

    <!-- BUKU POPULER -->
    <section class="popular-section">
        <h2>Buku Terpopuler!</h2>
        <p>Buku-buku kategori terpopuler yang banyak dipinjam dalam kurun waktu 3 bulan terakhir</p>

        <div class="book-list">
            <div class="book-card">
                <img src="./asset/coverPeter.jpg" />
                <p>PETER AND THE WOLF</p>
            </div>

            <div class="book-card">
                <img src="./asset/coverWibu.jpeg" />
                <p>THE PROPHET</p>
            </div>

            <div class="book-card">
                <img src="./asset/coverPurpose.jpg" />
                <p>PURPOSE</p>
            </div>

            <div class="book-card">
                <img src="./asset/coverMonk.jpg" />
                <p>THE MONK Of MOKHA</p>
            </div>
        </div>
    </section>

    <!-- BUKU TERBAIK TAHUN INI -->
    <section class="best-section">
        <h2>Buku Terbaik Tahun Ini</h2>

        <div class="best-container">
            <button class="prev-btn">&#10094;</button>

            <div class="best-card">
                <div class="best-text">
                    <h3>MINDSET: THE NEW PSYCHOLOGY OF SUCCESS</h3>
                    <p>
                        Buku ini menjelaskan bagaimana pola pikir dapat 
                        mempengaruhi kesuksesan seseorang. Cocok untuk membaca 
                        self-improvement dan pemahaman mendalam mengenai metode 
                        berpikir yang tepat.
                    </p>
                </div>
                <div class="best-card img">
                    <img src="./asset/Best1.png" class="best-img" />
                </div>
            </div>

            <button class="next-btn">&#10095;</button>
        </div>
    </section>

    <!-- FOOTER -->
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
            <img src="./asset/Lokasi.png" width="250">
        </div>
    </footer>

</body>
</html>
