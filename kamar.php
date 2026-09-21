<?php
include 'config.php';

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['tambah'])) {
    $nomor = $_POST['nomor_kamar'];
    $tipe = $_POST['tipe'];
    $harga = $_POST['harga'];

    mysqli_query($koneksi, "INSERT INTO kamar (nomor_kamar,tipe,harga,status)
    VALUES ('$nomor','$tipe','$harga','Tersedia')");

    header("Location: kamar.php");
    exit;
}

if (isset($_GET['hapus'])) {
    $id = intval($_GET['hapus']);
    mysqli_query($koneksi, "DELETE FROM kamar WHERE id='$id'");

    header("Location: kamar.php");
    exit;
}

$data = mysqli_query($koneksi, "SELECT * FROM kamar ORDER BY id ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Kamar</title>
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
        <a href="kamar.php" class="active">🛏️ Data Kamar</a>
        <a href="pelanggan.php">👥 Pelanggan</a>
        <a href="booking.php">📅 Booking</a>
        <a href="pembayaran.php">💳 Pembayaran</a>
        <a href="laporan.php">📊 Laporan</a>
    </aside>

    <main class="main">
        <h1>Data Kamar</h1>
        <p>Kelola kamar hotel.</p>

        <div class="panel">
            <h2>Tambah Kamar</h2>

            <form method="POST" class="form-grid">
                <input type="text" name="nomor_kamar" placeholder="Nomor Kamar" required>

                <select name="tipe" required>
                    <option value="">Pilih Tipe</option>
                    <option value="Standard">Standard</option>
                    <option value="Deluxe">Deluxe</option>
                    <option value="Suite">Suite</option>
                </select>

                <input type="number" name="harga" placeholder="Harga" required>

                <button type="submit" name="tambah">Tambah</button>
            </form>
        </div>

        <div class="panel">
            <h2>Daftar Kamar</h2>

            <table>
                <tr>
                    <th>No</th>
                    <th>Nomor Kamar</th>
                    <th>Tipe</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>

                <?php $no=1; while ($row=mysqli_fetch_assoc($data)): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['nomor_kamar'] ?></td>
                    <td><?= $row['tipe'] ?></td>
                    <td>Rp <?= number_format($row['harga'],0,',','.') ?></td>
                    <td><?= $row['status'] ?></td>
                    <td>
                        <a class="hapus" href="kamar.php?hapus=<?= $row['id'] ?>"
                        onclick="return confirm('Hapus kamar?')">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </table>
        </div>
    </main>
</div>

</body>
</html>