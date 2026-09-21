<?php
include 'config.php';

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$data = mysqli_query($koneksi, "SELECT * FROM users WHERE role='pelanggan'");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pelanggan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="navbar">
    <h2>🏨 HOTEL WINA</h2>
    <a href="logout.php" class="logout">Logout</a>
</div>

<div class="layout">
    <aside class="sidebar">
        <h3>MENU UTAMA</h3>
        <a href="dashboard.php">🏠 Dashboard</a>
        <a href="kamar.php">🛏️ Data Kamar</a>
        <a href="pelanggan.php" class="active">👥 Pelanggan</a>
        <a href="booking.php">📅 Booking</a>
        <a href="pembayaran.php">💳 Pembayaran</a>
        <a href="laporan.php">📊 Laporan</a>
    </aside>

    <main class="main">
        <h1>Data Pelanggan</h1>
        <p>Daftar pelanggan hotel.</p>

        <div class="panel">
            <table>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Tanggal Daftar</th>
                </tr>

                <?php $no=1; while ($row=mysqli_fetch_assoc($data)): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($row['nama']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= $row['created_at'] ?></td>
                </tr>
                <?php endwhile; ?>
            </table>
        </div>
    </main>
</div>

</body>
</html>