<?php
include 'config.php';

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$total_kamar = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM kamar"));
$tersedia = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM kamar WHERE status='Tersedia'"));
$pelanggan = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM users WHERE role='pelanggan'"));
$booking = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM booking"));
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Hotel</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="navbar">
    <h2>🏨 HOTEL WINA</h2>
    <div>
        Halo, <?= htmlspecialchars($_SESSION['nama']) ?>
        <a href="logout.php" class="logout">Logout</a>
    </div>
</div>

<div class="layout">

    <aside class="sidebar">
        <h3>MENU UTAMA</h3>
        <a href="dashboard.php" class="active">🏠 Dashboard</a>
        <a href="kamar.php">🛏️ Data Kamar</a>
        <a href="pelanggan.php">👥 Pelanggan</a>
        <a href="booking.php">📅 Booking</a>
        <a href="pembayaran.php">💳 Pembayaran</a>
        <a href="laporan.php">📊 Laporan</a>
    </aside>

    <main class="main">
        <h1>Dashboard</h1>
        <p>Selamat datang di Sistem Informasi Manajemen Hotel Wina.</p>

        <div class="cards">
            <div class="card">
                <h3>Total Kamar</h3>
                <h2><?= $total_kamar ?></h2>
            </div>

            <div class="card">
                <h3>Kamar Tersedia</h3>
                <h2><?= $tersedia ?></h2>
            </div>

            <div class="card">
                <h3>Pelanggan</h3>
                <h2><?= $pelanggan ?></h2>
            </div>

            <div class="card">
                <h3>Total Booking</h3>
                <h2><?= $booking ?></h2>
            </div>
        </div>

        <div class="panel">
            <h2>Selamat Datang di Hotel Wina</h2>
            <p>Silakan pilih menu di sebelah kiri untuk mengelola sistem hotel.</p>
        </div>
    </main>

</div>

</body>
</html>