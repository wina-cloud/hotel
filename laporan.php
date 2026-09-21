<?php
include 'config.php';

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$data = mysqli_query($koneksi, "SELECT booking.*, users.nama,
kamar.nomor_kamar, kamar.tipe
FROM booking
JOIN users ON booking.user_id=users.id
JOIN kamar ON booking.kamar_id=kamar.id
ORDER BY booking.id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan</title>
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
        <a href="pelanggan.php">👥 Pelanggan</a>
        <a href="booking.php">📅 Booking</a>
        <a href="pembayaran.php">💳 Pembayaran</a>
        <a href="laporan.php" class="active">📊 Laporan</a>
    </aside>

    <main class="main">
        <div class="report-title">
            <div>
                <h1>Laporan Reservasi</h1>
                <p>Data seluruh booking hotel.</p>
            </div>
            <button onclick="window.print()">Cetak Laporan</button>
        </div>

        <div class="panel">
            <table>
                <tr>
                    <th>No</th>
                    <th>Pelanggan</th>
                    <th>Kamar</th>
                    <th>Tipe</th>
                    <th>Check In</th>
                    <th>Check Out</th>
                    <th>Tamu</th>
                    <th>Status</th>
                </tr>

                <?php $no=1; while ($row=mysqli_fetch_assoc($data)): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($row['nama']) ?></td>
                    <td><?= $row['nomor_kamar'] ?></td>
                    <td><?= $row['tipe'] ?></td>
                    <td><?= $row['tanggal_checkin'] ?></td>
                    <td><?= $row['tanggal_checkout'] ?></td>
                    <td><?= $row['jumlah_tamu'] ?></td>
                    <td><?= $row['status'] ?></td>
                </tr>
                <?php endwhile; ?>
            </table>
        </div>
    </main>
</div>

</body>
</html>