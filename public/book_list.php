<?php
// Jika ditekan tombol "Kembali", kembali ke index
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil Pencarian Buku</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<h2>Hasil Pencarian</h2>
<a href="index.php" style="display:inline-block;margin-bottom:15px;">← Kembali</a>

<div class="book-list">
    <?php foreach($books as $b): ?>
        <div class="book-card">
            <img src="<?= $b['cover'] ?>" alt="cover">
            <p><?= $b['title'] ?></p>
            <small><?= $b['author'] ?></small>
        </div>
    <?php endforeach; ?>
</div>

</body>
</html>
