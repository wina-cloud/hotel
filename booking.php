<?php
include 'config.php';

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$pesan = "";

if (isset($_POST['booking'])) {
    $user_id = $_SESSION['id'];
    $kamar_id = intval($_POST['kamar_id']);
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];
    $jumlah = intval($_POST['jumlah_tamu']);

    if ($checkout <= $checkin) {
        $pesan = "Checkout harus setelah checkin!";
    } else {
        $cek = mysqli_query($koneksi,
            "SELECT * FROM kamar WHERE id='$kamar_id' AND status='Tersedia'"
        );

        if (mysqli_num_rows($cek) == 0) {
            $pesan = "Kamar tidak tersedia!";
        } else {
            mysqli_query($koneksi, "INSERT INTO booking
            (user_id,kamar_id,tanggal_checkin,tanggal_checkout,jumlah_tamu,status)
            VALUES ('$user_id','$kamar_id','$checkin','$checkout','$jumlah','Menunggu')");

            mysqli_query($koneksi,
                "UPDATE kamar SET status='Terisi' WHERE id='$kamar_id'"
            );

            $pesan = "Booking berhasil!";
        }
    }
}

$kamar = mysqli_query($koneksi, "SELECT * FROM kamar WHERE status='Tersedia'");

$data = mysqli_query($koneksi, "SELECT booking.*, users.nama, kamar.nomor_kamar
FROM booking
JOIN users ON booking.user_id=users.id
JOIN kamar ON booking.kamar_id=kamar.id
ORDER BY booking.id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Booking</title>
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
        <a href="booking.php" class="active">📅 Booking</a>
        <a href="pembayaran.php">💳 Pembayaran</a>
        <a href="laporan.php">📊 Laporan</a>
    </aside>

    <main class="main">
        <h1>Booking Kamar</h1>

        <?php if ($pesan): ?>
            <div class="alert success"><?= $pesan ?></div>
        <?php endif; ?>

        <div class="panel">
            <h2>Buat Booking</h2>

            <form method="POST" class="form-grid">
                <select name="kamar_id" required>
                    <option value="">Pilih Kamar</option>
                    <?php while ($k=mysqli_fetch_assoc($kamar)): ?>
                        <option value="<?= $k['id'] ?>">
                            <?= $k['nomor_kamar'] ?> - <?= $k['tipe'] ?>
                        </option>
                    <?php endwhile; ?>
                </select>

                <input type="number" name="jumlah_tamu" placeholder="Jumlah Tamu" required>
                <input type="date" name="checkin" required>
                <input type="date" name="checkout" required>

                <button type="submit" name="booking">Booking Sekarang</button>
            </form>
        </div>

        <div class="panel">
            <h2>Daftar Booking</h2>

            <table>
                <tr>
                    <th>No</th>
                    <th>Pelanggan</th>
                    <th>Kamar</th>
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