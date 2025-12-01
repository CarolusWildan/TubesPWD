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
            <li><a href="#riwayat">Riwayat</a></li>
            <li><a href="profile.php">Profil</a></li>
        </ul>
        <div class="icon-circle">
            <!-- Bisa diganti dengan ikon SVG atau img -->
            <div class="circle"></div>
        </div>
    </nav>
    </header>

    <!-- HERO -->
    <section class="hero">
        <img src="./asset/background.png" alt="Bookshelf" />
    </section>

    
    <div class="container">
    <div class="riwayat-peminjaman">
        <h1 class="title">Riwayat Peminjaman</h1>
        <p class="subtitle">Anda dapat melihat semua riwayat peminjaman buku Anda</p>
    
        <div class="riwayat-list">
        <!-- Card 1 -->
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

        <!-- Card 2 -->
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

        <!-- Card 3 -->
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

    <!-- Tambahkan lebih banyak card jika perlu -->
  </div>
    </div>
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
