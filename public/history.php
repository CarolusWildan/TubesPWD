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
    <title>Riwayat - GMS Library</title>
    <link rel="stylesheet" href="css/history.css" />
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
                <div class="icon-circle">
                    <a href="profile.php">
                        
                        <?php if (isset($_SESSION['profile_photo']) && !empty($_SESSION['profile_photo'])) : ?>
                            
                            <img src="<?= $_SESSION['profile_photo'] ?>" alt="Profile" class="header-profile-img">
                        
                        <?php else : ?>
                            
                            <div class="circle"></div>
                        
                        <?php endif; ?>

                    </a>
                </div>
            </div>
        </nav>
    </header>

    <!-- HERO -->
    <section class="hero">
        <img src="./asset/background.png" alt="Bookshelf" />
    </section>

    <!-- CONTAINER RIWAYAT -->
    <div class="container">
        <div class="riwayat-peminjaman">
            <h1 class="title">Riwayat Peminjaman</h1>
            <p class="subtitle">Anda dapat melihat semua riwayat peminjaman buku Anda</p>

            <div class="riwayat-list">

                <!-- CARD 1 -->
                <div class="riwayat-card">
                    <div class="book-image">
                        <img src="./asset/coverPeter.jpg" alt="Peter and the Wolf" />
                    </div>
                    <div class="book-info">
                        <div class="status-badge dikembalikan">Dikembalikan</div>
                        <h3>PETER AND THE WOLF</h3>

                        <div class="detail">
                            <span class="label">Pengarang</span>
                            <span class="colon">:</span>
                            <span class="value">Sergei Prokofiev</span>
                        </div>

                        <div class="detail">
                            <span class="label">Tahun Terbit</span>
                            <span class="colon">:</span>
                            <span class="value">2024</span>
                        </div>

                        <div class="detail">
                            <span class="label">Kategori</span>
                            <span class="colon">:</span>
                            <span class="value">Anak-anak</span>
                        </div>

                        <div class="detail">
                            <span class="label2">Tanggal Peminjaman</span>
                            <span class="colon">:</span>
                            <span class="value">19-Oktober-2025</span>
                        </div>

                        <div class="detail">
                            <span class="label3">Tanggal Pengembalian</span>
                            <span class="colon">:</span>
                            <span class="value">21-Oktober-2025</span>
                        </div>

                        <div class="detail">
                            <span class="label">Denda</span>
                            <span class="colon">:</span>
                            <span class="value">-</span>
                        </div>
                    </div>
                </div>

                <!-- CARD 2 -->
                <div class="riwayat-card">
                    <div class="book-image">
                        <img src="./asset/coverWibu.jpeg" alt="The Prophet" />
                    </div>

                    <div class="book-info">
                        <div class="status-badge dipinjam">Dipinjam</div>
                        <h3>The Prophet</h3>

                        <div class="detail">
                            <span class="label">Pengarang</span>
                            <span class="colon">:</span>
                            <span class="value">Sergei Prokofiev</span>
                        </div>

                        <div class="detail">
                            <span class="label">Tahun Terbit</span>
                            <span class="colon">:</span>
                            <span class="value">2024</span>
                        </div>

                        <div class="detail">
                            <span class="label">Kategori</span>
                            <span class="colon">:</span>
                            <span class="value">Anak-anak</span>
                        </div>

                        <div class="detail">
                            <span class="label2">Tanggal Peminjaman</span>
                            <span class="colon">:</span>
                            <span class="value">19-Oktober-2025</span>
                        </div>

                        <div class="detail">
                            <span class="label3">Tanggal Pengembalian</span>
                            <span class="colon">:</span>
                            <span class="value">21-Oktober-2025</span>
                        </div>

                        <div class="detail">
                            <span class="label">Denda</span>
                            <span class="colon">:</span>
                            <span class="value">-</span>
                        </div>
                    </div>
                </div>

                <!-- CARD 3 -->
                <div class="riwayat-card">
                    <div class="book-image">
                        <img src="./asset/coverMonk.jpg" alt="Monk" />
                    </div>

                    <div class="book-info">
                        <div class="status-badge tersedia">Tersedia</div>
                        <h3>The Monk</h3>

                        <div class="detail">
                            <span class="label">Pengarang</span>
                            <span class="colon">:</span>
                            <span class="value">Sergei Prokofiev</span>
                        </div>

                        <div class="detail">
                            <span class="label">Tahun Terbit</span>
                            <span class="colon">:</span>
                            <span class="value">2024</span>
                        </div>

                        <div class="detail">
                            <span class="label">Kategori</span>
                            <span class="colon">:</span>
                            <span class="value">Anak-anak</span>
                        </div>

                        <div class="detail">
                            <span class="label2">Tanggal Peminjaman</span>
                            <span class="colon">:</span>
                            <span class="value">19-Oktober-2025</span>
                        </div>

                        <div class="detail">
                            <span class="label3">Tanggal Pengembalian</span>
                            <span class="colon">:</span>
                            <span class="value">21-Oktober-2025</span>
                        </div>

                        <div class="detail">
                            <span class="label">Denda</span>
                            <span class="colon">:</span>
                            <span class="value">-</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div> <!-- END CONTAINER -->

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
            <p>Jl. Masjid Al-Furqon No.RT.10, Cepit Baru, Condongcatur, Kec. Depok, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55283<br></p>
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
