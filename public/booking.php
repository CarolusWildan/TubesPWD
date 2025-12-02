<?php
// Mulai session agar bisa baca $_SESSION
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GMS Library</title>
    <link rel="stylesheet" href="css/booking.css" />
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
                <li><a href="booking.php">Booking</a></li>
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

    
    <div class="form-container">
        <h2 class="form-title">Form Peminjaman Buku</h2>

        <form action="#" method="POST">
            <!-- Nama Peminjam -->
            <div class="form-group">
                <label for="nama">Nama Peminjam</label>
                <input type="text" id="nama" name="nama" required placeholder="Masukkan nama lengkap">
            </div>

            <!-- Alamat Peminjam -->
            <div class="form-group">
                <label for="alamat">Alamat Peminjam</label>
                <input type="text" id="alamat" name="alamat" required placeholder="Masukkan alamat lengkap">
            </div>

            <!-- No Telepon -->
            <div class="form-group">
                <label for="telepon">No Telepon</label>
                <input type="tel" id="telepon" name="telepon" required placeholder="Contoh: 081234567890">
            </div>
            <script src="js/borrow.js"></script>        
            <div class="form-group">
                <label for="tgl_pinjam">Tanggal Peminjaman</label>
                <input type="date" id="tgl_pinjam" name="tgl_pinjam" class="date-readonly">
            </div>
            
            <script src="js/borrow.js"></script>
            <!-- Tanggal Peminjaman -->
            <div class="form-group">
                <label for="tgl_pinjam">Tanggal Peminjaman</label>
                <input type="date" id="tgl_pinjam" name="tgl_pinjam" class="date-readonly">
            </div>

            <!-- Tanggal Pengembalian -->
            <div class="form-group">
                <label for="tgl_kembali">Tanggal Pengembalian</label>
                <input type="date" id="tgl_kembali" name="tgl_kembali" class="date-readonly">
            </div>

            <!-- Divider -->
            <div class="divider"></div>

            <!-- Pinjam Buku Section -->
            <div class="book-section">
                <h3>Pinjam Buku</h3>
                <div class="book-card">
                    <div class="book-image"><img src="./asset/coverPeter.jpg" alt="Cover Buku Peter and the Wolf" width="80" height="120"></div>
                    <div class="book-title">PETER AND THE WOLF</div>
                    <div class="book-author">Sergel Prokofiev</div>
                    <div class="book-year">2024</div>
                    <div class="book-category">Anak-Anak</div>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="submit-btn">Pinjam</button>
        </form>
    </div>           
    


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
