<?php
// ...existing code...
// <?php
// Replace old bootstrap / controller require with app init
require_once __DIR__ . '/../app/init.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// if (!isset($_SESSION['user_id'])) {
//     // Redirect to login via the app front controller
//     header("Location: index.php?controller=auth&action=login");
//     exit;
// }

// Use the User model (see: User::getById in app/models/User.php)
$userModel = new User($conn);
$user = $userModel->getById((int) $_SESSION['user_id']);

// if (!$user) {
//     header("Location: index.php");
//     exit;
// }

$displayName = $user['user_name'] ?? $user['username'] ?? 'Pengguna';
$avatar = $user['avatar'] ?? 'asset/default-avatar.png';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - <?= htmlspecialchars($displayName) ?></title>
</head>
<link rel="stylesheet" href="css/profile.css">
<body>
    <div class="container">
        <div class="header">
            <h1>My Profile</h1>
            <p>Welcome back, <?= htmlspecialchars($displayName) ?>!</p>
        </div>

        <img src="<?= htmlspecialchars($avatar) ?>" alt="Profile Picture" class="avatar">

        <div class="btn-group">
            <button class="btn btn-edit" onclick="location.href='edit_profile.php'">Edit Profile</button>
            <button class="btn btn-share" onclick="shareProfile()">Share Profile</button>
        </div>

        <div class="menu">
            <div class="menu-item" onclick="location.href='favourites.php'">
                <div class="icon">❤️</div>
                <span class="menu-text">Favourites</span>
                <span class="arrow">›</span>
            </div>

            <div class="menu-item" onclick="location.href='downloads.php'">
                <div class="icon">⬇️</div>
                <span class="menu-text">Downloads</span>
                <span class="arrow">›</span>
            </div>

            <hr style="margin: 20px 0; border: none; border-top: 1px solid #ddd;">

            <div class="menu-item" onclick="location.href='language.php'">
                <div class="icon">🌐</div>
                <span class="menu-text">Language</span>
                <span class="arrow">›</span>
            </div>

            <div class="menu-item" onclick="location.href='location.php'">
                <div class="icon">📍</div>
                <span class="menu-text">Location</span>
                <span class="arrow">›</span>
            </div>

            <div class="menu-item" onclick="location.href='display.php'">
                <div class="icon">🖥️</div>
                <span class="menu-text">Display</span>
                <span class="arrow">›</span>
            </div>

            <hr style="margin: 20px 0; border: none; border-top: 1px solid #ddd;">

            <div class="menu-item" onclick="location.href='clear_history.php'">
                <div class="icon">🔄</div>
                <span class="menu-text">Clear History</span>
                <span class="arrow">›</span>
            </div>

            <div class="menu-item logout" onclick="confirmLogout()">
                <div class="icon">⛔</div>
                <span class="menu-text">Logout</span>
                <span class="arrow">›</span>
            </div>
        </div>

        <div class="footer">
            © 2025 Your App Name. All rights reserved.
        </div>
    </div>

    <script>
        function shareProfile() {
            if (navigator.share) {
                navigator.share({
                    title: 'My Profile',
                    text: 'Check out my profile!',
                    url: window.location.href
                }).catch(console.error);
            } else {
                alert('Fitur Share tidak didukung di browser ini.');
            }
        }

        function confirmLogout() {
            if (confirm('Apakah Anda yakin ingin keluar?')) {
                window.location.href = 'logout.php';
            }
        }
    </script>
</body>
</html>
// ...existing code...