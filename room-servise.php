<?php
require_once '../config/database.php';
require_once '../config/session.php';
include '../includes/header-user.php';

// Pastikan yang akses adalah pelanggan
if ($_SESSION['role'] !== 'pelanggan') {
    header("Location: ../auth/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Cek reservasi aktif user (untuk memastikan dia sedang menginap dan punya kamar)
$stmtCheck = $pdo->prepare("SELECT reservasi.*, kamar.nomor_kamar, tipe_kamar.nama_tipe 
                            FROM reservasi 
                            JOIN kamar ON reservasi.kamar_id = kamar.id 
                            JOIN tipe_kamar ON kamar.tipe_kamar_id = tipe_kamar.id 
                            WHERE reservasi.pengguna_id = ? AND reservasi.status = 'confirmed'");
$stmtCheck->execute([$user_id]);
$reservasi_aktif = $stmtCheck->fetchAll();

// Contoh daftar menu room service (bisa diambil dari database jika Anda membuat tabel khusus menu)
$menu_list = [
    ['id' => 1, 'nama' => 'Nasi Goreng Spesial Wina', 'harga' => 35000, 'kategori' => 'Makanan Utama', 'foto' => 'nasigoreng.jpg'],
    ['id' => 2, 'nama' => 'Chicken Steak Mushroom', 'harga' => 55000, 'kategori' => 'Makanan Utama', 'foto' => 'steak.jpg'],
    ['id' => 3, 'nama' => 'Mie Goreng Seafood', 'harga' => 30000, 'kategori' => 'Makanan Utama', 'foto' => 'miegoreng.jpg'],
    ['id' => 4, 'nama' => 'Es Teh Manis', 'harga' => 8000, 'kategori' => 'Minuman', 'foto' => 'esteh.jpg'],
    ['id' => 5, 'nama' => 'Juice Jeruk Segar', 'harga' => 15000, 'kategori' => 'Minuman', 'foto' => 'jusjeruk.jpg']
];
?>

<h2>Layanan Room Service</h2>
<p>Pesan makanan atau minuman langsung ke kamar Anda dengan mudah dan cepat.</p>

<?php if(count($reservasi_aktif) == 0): ?>
    <div class="alert-error" style="margin-top: 20px;">
        Anda tidak memiliki reservasi aktif (confirmed) saat ini. Fitur Room Service hanya dapat digunakan oleh tamu yang sedang aktif menginap.
    </div>
<?php else: ?>

    <?php if(isset($_GET['success'])): ?>
        <div style="background: #dcfce7; color: #166534; padding: 10px; border-radius: 4px; margin-bottom: 20px;">
            Pesanan Room Service berhasil dikirim! Petugas kami akan segera mengantarkannya ke kamar Anda.
        </div>
    <?php endif; ?>

    <div style="margin-top: 20px; margin-bottom: 30px; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
        <form action="room-service-process.php" method="POST">
            <div class="form-group">
                <label>Pilih Kamar / Reservasi Anda:</label>
                <select name="reservasi_id" required class="form-control">
                    <?php foreach($reservasi_aktif as $res): ?>
                        <option value="<?= $res['id']; ?>">
                            Kamar No. <?= $res['nomor_kamar']; ?> (<?= $res['nama_tipe']; ?>) - Check-in: <?= $res['tanggal_checkin']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <a href="index.php">Beranda</a>
            <a href="rooms.php">Daftar Kamar</a>
            <?php if(isset($_SESSION['user_id'])): ?>
                <a href="room-service.php">Room Service</a> <!-- Menu baru -->
                <a href="my-bookings.php">Reservasi Saya</a>
                <a href="profile.php">Profil</a>
                <a href="../auth/logout.php" class="btn-logout">Logout (<?= $_SESSION['nama']; ?>)</a>
            <?php else: ?>
                <a href="../auth/login.php" class="btn-login">Login</a>
            <?php endif; ?>

            <h3 style="margin-top: 20px; margin-bottom: 15px; font-size: 18px;">Pilih Menu:</h3>
            <div class="room-grid">
                <?php foreach($menu_list as $menu): ?>
                    <div class="room-card" style="padding: 15px; text-align: left;">
                        <h4><?= htmlspecialchars($menu['nama']); ?></h4>
                        <p style="color: #64748b; font-size: 13px;"><?= $menu['kategori']; ?></p>
                        <p class="price" style="margin: 10px 0;">Rp <?= number_format($menu['harga'], 0, ',', '.'); ?></p>
                        
                        <div class="form-group" style="display: flex; align-items: center; gap: 10px;">
                            <label style="margin: 0; font-size: 13px;">Jumlah:</label>
                            <input type="number" name="menu[<?= $menu['id']; ?>]" value="0" min="0" max="10" class="form-control" style="width: 80px;">
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div style="margin-top: 25px;">
                <button type="submit" class="btn-primary">Pesan Room Service Sekarang</button>
            </div>
        </form>
    </div>

<?php endif; ?>

<?php include '../includes/footer-user.php'; ?>