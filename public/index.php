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
            $authController->register();
            break;

        case 'registerProcess':
            $authController->registerProcess();
            break;

        case 'activate':
            $authController->activate();
            break;
    }

    // HENTIKAN SCRIPT DI SINI
    exit;
}else if ($controller === 'book') {
    $bookController = new BookController($conn);

    switch ($action) {
        case 'search':
            $bookController->search();
            break;

        // case 'detail':
        //     $bookController->detail();
        //     break;
    }

    exit;
}else if ($controller === 'user') {
    $userController = new UserController($conn);

    switch ($action) {
        case 'profile':
            $userController->profile();
            break;

        case 'updateProfile':
            // proses update profil (POST)
            $userController->updateProfile();
            break;

        case 'showLoginForm':
            $userController->showLoginForm();
            break;

        // tambahkan action lain jika ada, register, delete, dll
    }

    exit;
}



// if (!isset($_SESSION['role'])) {
//     header("Location: index.php?controller=auth&action=login");
//     exit;
// }
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
    
    <nav class="nav-menu">
        <ul>
            <li><a href="index.php">Beranda</a></li>

            <?php if (isset($_SESSION['role'])): ?>
                <li><a href="history.php">Riwayat</a></li>
                <li><a href="profile.php">Profil</a></li>
            <?php endif; ?>
        </ul>

        <div class="user-action">
            <?php if (isset($_SESSION['role'])): ?>
                
                <div class="icon-circle">
                    <a href="profile.php">
                        <div class="circle"></div> 
                        </a>
                </div>

            <?php else: ?>

                <a href="login.php" class="btn-login">Login</a>

            <?php endif; ?>
        </div>
    </nav>
</header>

    <!-- HERO -->
    <section class="hero">
        <img src="./asset/background.png" alt="Bookshelf" />
    </section>

    <!-- SEARCH BAR -->
    <?php if (isset($_SESSION['search_error'])) : ?>
        <script>
            alert("<?= $_SESSION['search_error']; ?>");
        </script>
        <?php unset($_SESSION['search_error']); ?>
    <?php endif; ?>
    <section class="search-section input">
        <div class="search-box">
            <input id="searchInput" type="text" placeholder="Cari Buku..." />
            <button id="searchBtn" type="button">Cari</button>
        </div>
    </section>

    <script src="js/search.js"></script>

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
                <p>GMS Library adalah perpustakaan modern dengan koleksi buku dan sumber digital yang beragam. Menyediakan ruang baca nyaman, area diskusi, serta layanan peminjaman untuk mendukung belajar dan penelitian pengunjung.</p>
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
            <p>Jl. Masjid Al-Furqon No.RT.10, Cepit Baru, Condongcatur, Kec. Depok, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55283</p>
            <p><b class="kontak-title">Kontak</b></p>
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
