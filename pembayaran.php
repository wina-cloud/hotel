<?php
include 'config.php';

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$pesan = "";

if (isset($_POST['bayar'])) {
    $booking_id = intval($_POST['booking_id']);
    $jumlah = $_POST['jumlah'];
    $metode = $_POST['metode'];

    mysqli_query($koneksi, "INSERT INTO pembayaran
    (booking_id,jumlah,metode,status)
    VALUES ('$booking_id','$jumlah','$metode','Lunas')");

    $pesan = "Pembayaran berhasil!";
}

$booking = mysqli_query($koneksi, "SELECT booking.id, users.nama
FROM booking
JOIN users ON booking.user_id=users.id");

$data = mysqli_query($koneksi, "SELECT pembayaran.*, users.nama
FROM pembayaran
JOIN booking ON pembayaran.booking_id=booking.id
JOIN users ON booking.user_id=users.id");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pembayaran</title>
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
        <a href="pembayaran.php" class="active">💳 Pembayaran</a>
        <a href="laporan.php">📊 Laporan</a>
    </aside>

    <main class="main">
        <h1>Pembayaran</h1>

        <?php if ($pesan): ?>
            <div class="alert success"><?= $pesan ?></div>
        <?php endif; ?>

        <div class="panel">
            <h2>Input Pembayaran</h2>

            <form method="POST" class="form-grid">
                <select name="booking_id" required>
                    <option value="">Pilih Booking</option>
                    <?php while ($b=mysqli_fetch_assoc($booking)): ?>
                        <option value="<?= $b['id'] ?>">
                            Booking #<?= $b['id'] ?> - <?= $b['nama'] ?>
                        </option>
                    <?php endwhile; ?>
                </select>

                <input type="number" name="jumlah" placeholder="Jumlah Pembayaran" required>

                <select name="metode" required>
                    <option value="">Pilih Metode</option>
                    <option value="Cash">Cash</option>
                    <option value="Transfer Bank">Transfer Bank</option>
                    <option value="E-Wallet">E-Wallet</option>
                </select>

                <button type="submit" name="bayar">Simpan Pembayaran</button>
            </form>
        </div>

        <div class="panel">
            <h2>Riwayat Pembayaran</h2>

            <table>
                <tr>
                    <th>No</th>
                    <th>Booking</th>
                    <th>Pelanggan</th>
                    <th>Jumlah</th>
                    <th>Metode</th>
                    <th>Status</th>
                </tr>

                <?php $no=1; while ($row=mysqli_fetch_assoc($data)): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td>#<?= $row['booking_id'] ?></td>
                    <td><?= htmlspecialchars($row['nama']) ?></td>
                    <td>Rp <?= number_format($row['jumlah'],0,',','.') ?></td>
                    <td><?= $row['metode'] ?></td>
                    <td><?= $row['status'] ?></td>
                </tr>
                <?php endwhile; ?>
            </table>
        </div>
    </main>
</div>

</body>
</html>