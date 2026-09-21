<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grand Luxury Hotel - Portal Tamu</title>
    <!-- Google Fonts & FontAwesome Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary: #0284c7; /* Warna biru elegan untuk user/tamu */
            --primary-light: #e0f2fe;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --dark: #1e293b;
            --light: #f8fafc;
            --gray: #64748b;
            --border: #e2e8f0;
            --sidebar-width: 260px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background-color: #f1f5f9;
            color: var(--dark);
            display: flex;
            min-height: 100vh;
        }

        /* --- SIDEBAR --- */
        aside {
            width: var(--sidebar-width);
            background: #ffffff;
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
            z-index: 100;
        }

        .sidebar-brand {
            padding: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--primary);
            border-bottom: 1px solid var(--border);
        }

        .sidebar-brand i {
            font-size: 1.5rem;
        }

        .sidebar-menu {
            list-style: none;
            padding: 20px 16px;
            flex-grow: 1;
            overflow-y: auto;
        }

        .sidebar-menu li {
            margin-bottom: 6px;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 12px 16px;
            color: var(--gray);
            text-decoration: none;
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .sidebar-menu a:hover, .sidebar-menu li.active a {
            background: var(--primary-light);
            color: var(--primary);
        }

        .sidebar-menu a i {
            font-size: 1.1rem;
            width: 20px;
            text-align: center;
        }

        /* Style khusus untuk tombol Log Out */
        .sidebar-menu.sidebar-footer {
            flex-grow: 0;
            border-top: 1px solid var(--border);
            padding: 16px;
        }

        .sidebar-menu.sidebar-footer a {
            color: var(--danger);
        }

        .sidebar-menu.sidebar-footer a:hover {
            background: #fee2e2;
            color: var(--danger);
        }

        /* --- MAIN CONTENT --- */
        main {
            margin-left: var(--sidebar-width);
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        /* --- TOPBAR --- */
        header {
            background: #ffffff;
            height: 70px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
            position: sticky;
            top: 0;
            z-index: 99;
        }

        .welcome-msg h3 {
            font-size: 1.1rem;
            font-weight: 700;
        }

        .welcome-msg p {
            font-size: 0.8rem;
            color: var(--gray);
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .user-profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .user-info h4 {
            font-size: 0.9rem;
            font-weight: 600;
        }

        .user-info p {
            font-size: 0.75rem;
            color: var(--gray);
        }

        /* --- DASHBOARD CONTAINER --- */
        .dashboard-content {
            padding: 32px;
            overflow-y: auto;
        }

        .page-section {
            display: none;
        }

        .page-section.active-section {
            display: block;
        }

        .page-title {
            margin-bottom: 24px;
        }

        .page-title h1 {
            font-size: 1.5rem;
            font-weight: 700;
        }

        .page-title p {
            color: var(--gray);
            font-size: 0.9rem;
        }

        /* --- KARTU AKTIF / STAY CARD (BANNER UTAMA TAMU) --- */
        .active-stay-card {
            background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
            color: white;
            border-radius: 16px;
            padding: 28px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
            box-shadow: 0 10px 15px -3px rgba(2, 132, 199, 0.3);
        }

        .stay-info h2 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 6px;
        }

        .stay-info p {
            font-size: 0.95rem;
            opacity: 0.9;
            margin-bottom: 16px;
        }

        .stay-details-grid {
            display: flex;
            gap: 24px;
        }

        .stay-detail-item {
            background: rgba(255, 255, 255, 0.15);
            padding: 10px 16px;
            border-radius: 8px;
            backdrop-filter: blur(5px);
        }

        .stay-detail-item span {
            display: block;
            font-size: 0.75rem;
            opacity: 0.8;
        }

        .stay-detail-item strong {
            font-size: 0.95rem;
        }

        .stay-action-btn {
            background: white;
            color: var(--primary);
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .stay-action-btn:hover {
            background: #f8fafc;
        }

        /* --- GRID UTAMA --- */
        .grid-main {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 24px;
            margin-bottom: 32px;
        }

        @media (max-width: 1024px) {
            .grid-main {
                grid-template-columns: 1fr;
            }
            .active-stay-card {
                flex-direction: column;
                align-items: flex-start;
                gap: 20px;
            }
        }

        .card {
            background: #ffffff;
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
            margin-bottom: 24px;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .card-header h2 {
            font-size: 1.1rem;
            font-weight: 600;
        }

        .btn-action {
            background: var(--primary-light);
            color: var(--primary);
            border: none;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-action:hover {
            background: var(--primary);
            color: white;
        }

        /* --- TABEL --- */
        .table-responsive {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        th, td {
            padding: 12px 16px;
            border-bottom: 1px solid var(--border);
            font-size: 0.9rem;
        }

        th {
            background: var(--light);
            color: var(--gray);
            font-weight: 600;
        }

        .badge {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-block;
        }

        .badge.success { background: #d1fae5; color: var(--success); }
        .badge.warning { background: #fef3c7; color: var(--warning); }
        .badge.danger { background: #fee2e2; color: var(--danger); }

        /* --- QUICK SERVICE CARDS --- */
        .service-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }

        .service-box {
            background: var(--light);
            border: 1px solid var(--border);
            padding: 16px;
            border-radius: 10px;
            text-align: center;
            cursor: pointer;
            transition: 0.2s;
        }

        .service-box:hover {
            border-color: var(--primary);
            background: var(--primary-light);
            color: var(--primary);
        }

        .service-box i {
            font-size: 1.5rem;
            color: var(--primary);
            margin-bottom: 8px;
        }

        .service-box h4 {
            font-size: 0.9rem;
            font-weight: 600;
        }

        /* --- FASILITAS HOTEL --- */
        .facility-list {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .facility-item {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .facility-item img {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            object-fit: cover;
        }

        .facility-info h4 {
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 2px;
        }

        .facility-info p {
            font-size: 0.8rem;
            color: var(--gray);
        }

        .digital-key-container {
            text-align: center;
            padding: 40px;
            background: white;
            border-radius: 12px;
            border: 1px solid var(--border);
        }
        .digital-key-container i {
            font-size: 4rem;
            color: var(--primary);
            margin-bottom: 20px;
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <aside>
        <div class="sidebar-brand">
            <i class="fa-solid fa-hotel"></i>
            <span>Grand Luxury</span>
        </div>
        <ul class="sidebar-menu">
            <li class="active"><a data-target="beranda"><i class="fa-solid fa-house"></i> Beranda Tamu</a></li>
            <li><a data-target="kunci"><i class="fa-solid fa-key"></i> Kunci Kamar Digital</a></li>
            <li><a data-target="roomservice"><i class="fa-solid fa-utensils"></i> Room Service</a></li>
            <li><a data-target="reservasi"><i class="fa-solid fa-calendar-check"></i> Reservasi Saya</a></li>
            <li><a data-target="tagihan"><i class="fa-solid fa-receipt"></i> Tagihan & Pembayaran</a></li>
            <li><a data-target="ulasan"><i class="fa-solid fa-star"></i> Ulasan & Saran</a></li>
            <li><a data-target="profil"><i class="fa-solid fa-user-gear"></i> Profil Saya</a></li>
        </ul>
        
        <!-- NAVIGASI LOG OUT -->
        <ul class="sidebar-menu sidebar-footer">
            <li><a href="login.php" id="logout-btn"><i class="fa-solid fa-right-from-bracket"></i> Keluar (Log Out)</a></li>
        </ul>
    </aside>

    <!-- MAIN SECTION -->
    <main>
        <!-- TOPBAR -->
        <header>
            <div class="welcome-msg">
                <h3>Portal Pelanggan Hotel</h3>
                <p>Senin, 21 September 2026</p>
            </div>
            <div class="user-profile">
                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&auto=format&fit=crop&q=80" alt="User">
                <div class="user-info">
                    <h4>Budi Santoso</h4>
                    <p>Tamu VIP (Gold Member)</p>
                </div>
            </div>
        </header>

        <!-- DASHBOARD CONTENT -->
        <div class="dashboard-content">

            <!-- 1. BERANDA TAMU -->
            <section id="beranda" class="page-section active-section">
                <div class="page-title">
                    <h1>Halo, Budi!</h1>
                    <p>Selamat datang kembali di Grand Luxury Hotel. Nikmati masa menginap Anda.</p>
                </div>

                <!-- KARTU PENGINAPAN AKTIF (STAY BANNER) -->
                <div class="active-stay-card">
                    <div class="stay-info">
                        <h2>Kamar Deluxe Suite #302</h2>
                        <p>Status: <span style="background: rgba(255,255,255,0.2); padding: 2px 8px; border-radius: 4px;">Sedang Menginap</span></p>
                        <div class="stay-details-grid">
                            <div class="stay-detail-item">
                                <span>Check-In</span>
                                <strong>21 Sep 2026 (14:00)</strong>
                            </div>
                            <div class="stay-detail-item">
                                <span>Check-Out</span>
                                <strong>25 Sep 2026 (12:00)</strong>
                            </div>
                        </div>
                    </div>
                    <button class="stay-action-btn" onclick="switchTab('kunci')"><i class="fa-solid fa-mobile-screen"></i> Buka Kunci Kamar</button>
                </div>

                <!-- GRID UTAMA -->
                <div class="grid-main">
                    <!-- Riwayat & Reservasi -->
                    <div class="card">
                        <div class="card-header">
                            <h2>Riwayat & Jadwal Reservasi</h2>
                            <button class="btn-action" onclick="switchTab('reservasi')">Pesan Kamar Lagi</button>
                        </div>
                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>ID Reservasi</th>
                                        <th>Tipe Kamar</th>
                                        <th>Tanggal</th>
                                        <th>Total Biaya</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>#RSV-9012</td>
                                        <td>Deluxe Suite (302)</td>
                                        <td>21-25 Sep 2026</td>
                                        <td>Rp 4.800.000</td>
                                        <td><span class="badge success">Aktif</span></td>
                                    </tr>
                                    <tr>
                                        <td>#RSV-8410</td>
                                        <td>Superior Room (204)</td>
                                        <td>12-14 Jun 2026</td>
                                        <td>Rp 2.100.000</td>
                                        <td><span class="badge success">Selesai</span></td>
                                    </tr>
                                    <tr>
                                        <td>#RSV-7932</td>
                                        <td>Standard Room (105)</td>
                                        <td>05 Jan 2026</td>
                                        <td>Rp 950.000</td>
                                        <td><span class="badge success">Selesai</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Layanan Cepat (Quick Room Service) -->
                    <div class="card">
                        <div class="card-header">
                            <h2>Layanan Cepat</h2>
                        </div>
                        <div class="service-grid">
                            <div class="service-box" onclick="switchTab('roomservice')">
                                <i class="fa-solid fa-burger"></i>
                                <h4>Pesan Makanan</h4>
                            </div>
                            <div class="service-box" onclick="switchTab('roomservice')">
                                <i class="fa-solid fa-shirt"></i>
                                <h4>Laundry</h4>
                            </div>
                            <div class="service-box" onclick="switchTab('roomservice')">
                                <i class="fa-solid fa-broom"></i>
                                <h4>Pembersihan</h4>
                            </div>
                            <div class="service-box" onclick="switchTab('roomservice')">
                                <i class="fa-solid fa-taxi"></i>
                                <h4>Pesan Taksi</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FASILITAS & PENAWARAN KHUSUS -->
                <div class="card">
                    <div class="card-header">
                        <h2>Fasilitas Hotel Tersedia</h2>
                        <button class="btn-action">Lihat Semua</button>
                    </div>
                    <div class="facility-list">
                        <div class="facility-item">
                            <img src="https://images.unsplash.com/photo-1571896349842-33c89424de2d?w=150&auto=format&fit=crop&q=80" alt="Pool">
                            <div class="facility-info">
                               <h4>Infinity Pool (Lantai R)</h4>
                                <p>Buka pukul 06:00 - 21:00 WIB. Nikmati pemandangan kota dari ketinggian.</p>
                            </div>
                        </div>
                        <div class="facility-item">
                            <img src="https://images.unsplash.com/photo-1544161515-4ab6ce6db874?w=150&auto=format&fit=crop&q=80" alt="Spa">
                            <div class="facility-info">
                                <h4>Luxury Spa & Massage</h4>
                                <p>Dapatkan diskon 20% khusus member VIP untuk perawatan relaksasi tubuh.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- 2. KUNCI KAMAR DIGITAL -->
            <section id="kunci" class="page-section">
                <div class="page-title">
                    <h1>Kunci Kamar Digital</h1>
                    <p>Gunakan ponsel Anda untuk membuka pintu kamar secara otomatis.</p>
                </div>
                <div class="digital-key-container card">
                    <i class="fa-solid fa-fingerprint"></i>
                    <h2>Deluxe Suite - Kamar #302</h2>
                    <p style="color: var(--gray); margin-bottom: 24px;">Dekatkan perangkat Anda ke gagang pintu pintar kamar.</p>
                    <button class="stay-action-btn" style="padding: 14px 32px; font-size: 1rem;" onclick="alert('Pintu Berhasil Terbuka!')">
                        <i class="fa-solid fa-lock-open"></i> Tekan untuk Membuka Pintu
                    </button>
                </div>
            </section>

            <!-- 3. ROOM SERVICE -->
            <section id="roomservice" class="page-section">
                <div class="page-title">
                    <h1>Room Service & Layanan</h1>
                    <p>Pesan makanan, minuman, atau layanan kamar lainnya langsung dari sini.</p>
                </div>
                <div class="grid-main">
                    <div class="card">
                        <div class="card-header">
                            <h2>Menu Restoran & Bar</h2>
                        </div>
                        <div class="facility-list">
                            <div class="facility-item">
                                <img src="https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=150&auto=format&fit=crop&q=80" alt="Burger">
                                <div class="facility-info" style="flex-grow: 1;">
                                    <h4>Grand Wagyu Burger</h4>
                                    <p>Rp 125.000 - Juicy beef patty dengan keju cheddar leleh.</p>
                                </div>
                                <button class="btn-action" onclick="alert('Menu berhasil dipesan ke kamar #302!')">Pesan</button>
                            </div>
                            <div class="facility-item">
                                <img src="https://images.unsplash.com/photo-1579871494447-9811cf80d66c?w=150&auto=format&fit=crop&q=80" alt="Sushi">
                                <div class="facility-info" style="flex-grow: 1;">
                                    <h4>Salmon Deluxe Sushi Set</h4>
                                    <p>Rp 180.000 - Segar dengan kualitas salmon premium.</p>
                                </div>
                                <button class="btn-action" onclick="alert('Menu berhasil dipesan ke kamar #302!')">Pesan</button>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h2>Permintaan Tambahan</h2>
                        </div>
                        <div class="service-grid">
                            <div class="service-box" onclick="alert('Permintaan tambahan handuk telah dikirim!')">
                                <i class="fa-solid fa-bath"></i>
                                <h4>Extra Handuk</h4>
                            </div>
                            <div class="service-box" onclick="alert('Petugas kebersihan akan segera datang!')">
                                <i class="fa-solid fa-broom"></i>
                                <h4>Bersihkan Kamar</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- 4. RESERVASI SAYA -->
            <section id="reservasi" class="page-section">
                <div class="page-title">
                    <h1>Reservasi Saya</h1>
                    <p>Kelola jadwal menginap Anda saat ini dan masa lalu.</p>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h2>Daftar Riwayat Reservasi Lengkap</h2>
                        <button class="btn-action" onclick="alert('Mengarahkan ke halaman pemesanan kamar baru...')">Buat Reservasi Baru</button>
                    </div>
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID Reservasi</th>
                                    <th>Tipe Kamar</th>
                                    <th>Tanggal Check-In</th>
                                    <th>Tanggal Check-Out</th>
                                    <th>Total Biaya</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#RSV-9012</td>
                                    <td>Deluxe Suite (302)</td>
                                    <td>21 Sep 2026</td>
                                    <td>25 Sep 2026</td>
                                    <td>Rp 4.800.000</td>
                                    <td><span class="badge success">Aktif</span></td>
                                </tr>
                                <tr>
                                    <td>#RSV-8410</td>
                                    <td>Superior Room (204)</td>
                                    <td>12 Jun 2026</td>
                                    <td>14 Jun 2026</td>
                                    <td>Rp 2.100.000</td>
                                    <td><span class="badge success">Selesai</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

            <!-- 5. TAGIHAN & PEMBAYARAN -->
            <section id="tagihan" class="page-section">
                <div class="page-title">
                    <h1>Tagihan & Pembayaran</h1>
                    <p>Rincian pengeluaran selama Anda menginap di hotel.</p>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h2>Rincian Tagihan Kamar #302</h2>
                        <span class="badge warning">Belum Lunas</span>
                    </div>
                    <div class="table-responsive" style="margin-bottom: 20px;">
                        <table>
                            <thead>
                                <tr>
                                    <th>Keterangan</th>
                                    <th>Jumlah</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Sewa Kamar Deluxe Suite (4 Malam)</td>
                                    <td>1</td>
                                    <td>Rp 4.400.000</td>
                                </tr>
                                <tr>
                                    <td>Layanan Restoran (Grand Wagyu Burger)</td>
                                    <td>2</td>
                                    <td>Rp 250.000</td>
                                </tr>
                                <tr>
                                    <td>Pajak & Layanan Hotel (10%)</td>
                                    <td>-</td>
                                    <td>Rp 465.000</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <h3>Total Keseluruhan: <span style="color: var(--primary);">Rp 5.115.000</span></h3>
                    <button class="stay-action-btn" style="margin-top: 16px;" onclick="alert('Mengarahkan ke gerbang pembayaran online...')">Bayar Sekarang</button>
                </div>
            </section>

            <!-- 6. ULASAN & SARAN -->
            <section id="ulasan" class="page-section">
                <div class="page-title">
                    <h1>Ulasan & Saran</h1>
                    <p>Bagikan pengalaman Anda untuk membantu kami melayani lebih baik.</p>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h2>Beri Penilaian Penginapan</h2>
                    </div>
                    <form onsubmit="event.preventDefault(); alert('Terima kasih, ulasan Anda telah dikirim!');">
                        <div style="margin-bottom: 16px;">
                            <label style="display: block; margin-bottom: 8px; font-weight: 600;">Rating (Bintang)</label>
                            <select style="width: 100%; padding: 10px; border: 1px solid var(--border); border-radius: 6px;">
                                <option>★★★★★ (Sangat Memuaskan)</option>
                                <option>★★★★☆ (Puas)</option>
                                <option>★★★☆☆ (Cukup)</option>
                                <option>★★☆☆☆ (Kurang)</option>
                                <option>★☆☆☆☆ (Buruk)</option>
                            </select>
                        </div>
                        <div style="margin-bottom: 16px;">
                            <label style="display: block; margin-bottom: 8px; font-weight: 600;">Komentar atau Saran</label>
                            <textarea rows="4" placeholder="Tuliskan ulasan Anda di sini..." style="width: 100%; padding: 10px; border: 1px solid var(--border); border-radius: 6px;"></textarea>
                        </div>
                        <button type="submit" class="stay-action-btn">Kirim Ulasan</button>
                    </form>
                </div>
            </section>

            <!-- 7. PROFIL SAYA -->
            <section id="profil" class="page-section">
                <div class="page-title">
                    <h1>Profil Saya</h1>
                    <p>Informasi akun dan status keanggotaan Anda.</p>
                </div>
                <div class="card" style="display: flex; gap: 24px; align-items: center;">
                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=200&auto=format&fit=crop&q=80" alt="Profile" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover;">
                    <div>
                        <h2>Budi Santoso</h2>
                        <p style="color: var(--gray); margin-bottom: 8px;">budi.santoso@email.com | +62 812-3456-7890</p>
                        <span class="badge success">Tamu VIP (Gold Member)</span>
                    </div>
                </div>
            </section>

        </div>
    </main>

    <!-- JAVASCRIPT UNTUK NAVIGASI TAB DINAMIS & LOG OUT -->
    <script>
        const menuItems = document.querySelectorAll('.sidebar-menu:not(.sidebar-footer) a');
        const sections = document.querySelectorAll('.page-section');

        function switchTab(targetId) {
            // Sembunyikan semua section
            sections.forEach(sec => sec.classList.remove('active-section'));
            // Hapus kelas aktif di semua menu sidebar
            menuItems.forEach(item => item.parentElement.classList.remove('active'));

            // Tampilkan section yang dipilih
            const targetSection = document.getElementById(targetId);
            if (targetSection) {
                targetSection.classList.add('active-section');
            }

            // Beri kelas aktif pada menu sidebar yang sesuai
            menuItems.forEach(item => {
                if (item.getAttribute('data-target') === targetId) {
                    item.parentElement.classList.add('active');
                }
            });

            // Scroll ke atas konten
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        menuItems.forEach(item => {
            item.addEventListener('click', (e) => {
                e.preventDefault();
                const targetId = item.getAttribute('data-target');
                switchTab(targetId);
            });
        });

        // Log Out Event Handler & Redirect ke login.php
        const logoutBtn = document.getElementById('logout-btn');
        logoutBtn.addEventListener('click', (e) => {
            e.preventDefault();
            const confirmLogout = confirm('Apakah Anda yakin ingin keluar dari portal tamu?');
            if (confirmLogout) {
                // Diaktifkan fungsi redirect ke halaman login
                window.location.href = 'login.php'; 
            }
        });
    </script>
</body>
</html>