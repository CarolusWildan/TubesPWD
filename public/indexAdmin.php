<?php
require_once __DIR__ . "/../app/init.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ==========================================================
// PROTEKSI: Pastikan user sudah login dan role-nya adalah admin
// ==========================================================
if (!isset($_SESSION['role']) || ($_SESSION['role'] !== 'librarian' && $_SESSION['role'] !== 'admin')) {
    $_SESSION['alert_error'] = "Akses ditolak! Anda harus login sebagai Admin.";
    header("Location: index.php"); 
    exit;
}



?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard | GMS Library</title>
    <link rel="stylesheet" href="css/style.css" /> 
    <link rel="stylesheet" href="css/admin.css" /> <style>
        /* CSS Khusus Dashboard Admin */
        .admin-dashboard {
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .stats-grid {
            display: flex;
            gap: 20px;
            margin-bottom: 40px;
            flex-wrap: wrap;
        }

        .stat-card {
            background: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            flex: 1;
            min-width: 200px;
            text-align: center;
            border-left: 5px solid #2ecc71; /* Warna hijau sukses */
        }
        .stat-card.red { border-left: 5px solid #e74c3c; } /* Merah untuk denda/terlambat */

        .stat-card h3 {
            margin: 0 0 10px 0;
            color: #7f8c8d;
            font-size: 14px;
            text-transform: uppercase;
        }

        .stat-card p {
            font-size: 36px;
            font-weight: bold;
            color: #34495e;
            margin: 0;
        }

        .recent-activity {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        .recent-activity h2 {
            border-bottom: 1px solid #ecf0f1;
            padding-bottom: 10px;
            margin-bottom: 20px;
            color: #34495e;
        }

        .recent-activity ul {
            list-style: none;
            padding: 0;
        }

        .recent-activity li {
            padding: 10px 0;
            border-bottom: 1px dashed #ecf0f1;
            display: flex;
            justify-content: space-between;
        }
        .recent-activity li:last-child {
            border-bottom: none;
        }
    </style>
    </head>
<body>

    <?php if (!empty($successMessage)) : ?>
        <div class="popup-overlay" id="successPopup">
            <div class="popup-content">
                <span class="popup-icon">✔</span> <h3>Berhasil!</h3>
                <p><?= htmlspecialchars($successMessage); ?></p>
            </div>
        </div>
        <script> /* Logika JS fade out diletakkan di sini */ </script>
    <?php endif; ?>

    <header class="navbar">
        <h2 class="logo">Admin GMS Library</h2>
        
        <nav class="nav-menu">
            <ul>
                <li><a href="index.php?controller=admin&action=dashboard">Dashboard</a></li>
                <li><a href="index.php?controller=book_management&action=index">Manajemen Buku</a></li>
                <li><a href="index.php?controller=user_management&action=index">Manajemen User</a></li>
                <li><a href="index.php?controller=borrow_management&action=index">Peminjaman</a></li>
                <li><a href="index.php?controller=fine_management&action=index">Denda</a></li>
                <li><a href="../index.php?controller=auth&action=logout">Logout (<?= $_SESSION['username'] ?? 'Admin' ?>)</a></li>
            </ul>
        </nav>
    </header>

    <section class="admin-dashboard">
        <h1>Dashboard Administrasi 👋</h1>
        <p>Ringkasan cepat status operasional perpustakaan Anda saat ini.</p>

        <div class="stats-grid">
            <div class="stat-card">
                <h3>Total Buku</h3>
                <p><?= $stats['total_books'] ?></p>
            </div>
            <div class="stat-card">
                <h3>Total User</h3>
                <p><?= $stats['total_users'] ?></p>
            </div>
            <div class="stat-card">
                <h3>Peminjaman Aktif</h3>
                <p><?= $stats['active_borrows'] ?></p>
            </div>
            <div class="stat-card red">
                <h3>Buku Terlambat</h3>
                <p><?= $stats['overdue_books'] ?></p>
            </div>
        </div>
        
        <div class="recent-activity">
            <h2>Aktivitas Peminjaman Terbaru</h2>
            <ul>
                <?php foreach ($latestBorrows as $borrow) : ?>
                    <li>
                        <span>**<?= htmlspecialchars($borrow['user']) ?>** meminjam: *<?= htmlspecialchars($borrow['book']) ?>*</span>
                        <small><?= htmlspecialchars($borrow['date']) ?></small>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        
    </section>

    <footer class="footer" style="margin-top: 50px; text-align: center; background: #34495e; color: white;">
        <p>&copy; <?= date('Y') ?> GMS Library Admin Panel. All rights reserved.</p>
    </footer>

</body>
</html>
