<?php
require_once '../config/database.php';
require_once '../config/session.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $reservasi_id = $_POST['reservasi_id'];
    $menu_input = $_POST['menu'] ?? [];

    // Validasi apakah ada item yang dipilih
    $total_pesanan = 0;
    foreach ($menu_input as $qty) {
        $total_pesanan += (int)$qty;
    }

    if ($total_pesanan <= 0) {
        echo "<script>alert('Silakan pilih minimal 1 menu makanan atau minuman!'); window.history.back();</script>";
        exit;
    }

    // Di sini Anda bisa menyimpan ke tabel database pesanan room service (jika sudah ada tabelnya).
    // Untuk saat ini, kita arahkan kembali dengan pesan sukses.
    header("Location: room-service.php?success=1");
    exit;
} else {
    header("Location: room-service.php");
    exit;
}
?>