<?php
$nama = $_SESSION['nama_aktif'] ?? 'Anggota KSC';
$role = $_SESSION['role_aktif'] ?? 'Atlet';

// Ambil status dari session (sesuai yang kita buat sebelumnya)
$status_anggota = $_SESSION['status_aktif'] ?? 'Aktif';
$isAktif = (strtolower($status_anggota) === 'aktif');
$badgeBg = $isAktif ? '#d1fae5' : '#fee2e2';
$badgeColor = $isAktif ? '#065f46' : '#991b1b';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Krian Swimming Club</title>
    <link rel="stylesheet" href="/app/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="dashboard-page">
    <div class="dashboard-container">
        <aside class="dashboard-sidebar">
            <div class="sidebar-user">
                <div class="user-name"><?= htmlspecialchars($nama) ?></div>
                <div class="user-role" style="display: flex; align-items: center; gap: 8px;">
                    <?= htmlspecialchars(ucfirst($role)) ?>
                    <span style="font-size: 10px; padding: 2px 8px; border-radius: 12px; background-color: <?= $badgeBg ?>; color: <?= $badgeColor ?>; font-weight: 600;">
                        <?= htmlspecialchars(ucfirst($status_anggota)) ?>
                    </span>
                </div>
            </div>
            <div class="dashboard-brand">KSC Dashboard</div>
            
            <nav class="dashboard-nav">
                <a href="/dashboard" class="sidebar-link active">Beranda</a>
                <a href="/profil" class="sidebar-link">Profil Saya</a>
                <a href="/jadwal" class="sidebar-link">Jadwal Latihan</a>
                <a href="/dashboardevent" class="sidebar-link">Event KSC</a>
                <a href="/riwayat" class="sidebar-link">Riwayat Pendaftaran</a>
                
                <!-- MENU KHUSUS ADMIN -->
                <?php if (strtolower($role) === 'admin'): ?>
                    <a href="/manage-users" class="sidebar-link" style="color: #3182ce; font-weight: 600;">
                        ⚙️ Manajemen User
                    </a>
                <?php endif; ?>
                <!-- END MENU KHUSUS ADMIN -->

                <span class="nav-separator"></span>
                <a href="/" class="sidebar-link back-home">Beranda Web</a>
                <a href="/logout" class="logout-link">Logout</a>
            </nav>
        </aside>

        <main class="dashboard-main">
            <section class="tab-content active" id="tab-beranda">
                <div class="dashboard-hero">
                    <div>
                        <span class="eyebrow">
                            Krian Swimming Club
                            <?php if (!$isAktif): ?>
                                <span style="margin-left: 10px; background: #fee2e2; color: #991b1b; padding: 3px 8px; border-radius: 4px; font-size: 11px; font-weight: bold;">
                                    ⚠️ Akun Anda <?= htmlspecialchars(ucfirst($status_anggota)) ?>
                                </span>
                            <?php endif; ?>
                        </span>
                        <h1>Halo, <?= htmlspecialchars($nama) ?>! 👋</h1>
                        
                        <?php if ($isAktif): ?>
                            <p>Pantau jadwal latihanmu, daftarkan dirimu ke event, dan raih prestasi terbaikmu bersama KSC.</p>
                        <?php else: ?>
                            <p style="color: #c53030; font-weight: 500;">Akun kamu saat ini dibatasi. Hubungi Admin untuk mengaktifkan kembali akunmu.</p>
                        <?php endif; ?>
                    </div>
                    
                    <?php if ($isAktif): ?>
                        <a href="/dashboardevent" class="dashboard-primary-btn" style="text-decoration:none; display:inline-block; text-align:center;">Daftar Event</a>
                    <?php else: ?>
                        <button class="dashboard-primary-btn" style="background-color: #a0aec0; cursor: not-allowed; border: none;" disabled>Event Ditutup</button>
                    <?php endif; ?>
                </div>

                <!-- Bagian Bawah Tetap Sama -->
                <div class="dashboard-stats-grid">
                    <div class="dashboard-stat-card">
                        <span class="stat-icon">🏊</span>
                        <strong id="statLatihanMingguIni">5</strong>
                        <span>Latihan Minggu Ini</span>
                    </div>
                    <div class="dashboard-stat-card">
                        <span class="stat-icon">📋</span>
                        <strong id="statEventSaya">0</strong>
                        <span>Event Didaftar</span>
                    </div>
                    <div class="dashboard-stat-card">
                        <span class="stat-icon">⏳</span>
                        <strong id="hariMundur">-</strong>
                        <span>Hari ke Event</span>
                    </div>
                </div>

                <div class="athlete-home-grid">
                    <!-- Kartu Riwayat Pendaftaran -->
                    <article class="dashboard-card athlete-card-reg">
                        <div class="athlete-card-header">
                            <span class="athlete-card-icon">📝</span>
                            <div>
                                <h3>Pendaftaran Saya</h3>
                                <p class="athlete-card-sub">Event yang sudah kamu daftarkan</p>
                            </div>
                        </div>
                        <ul class="my-reg-list" id="myRegList">
                            <li class="my-reg-empty">Kamu belum mendaftar event apapun.</li>
                        </ul>
                        <a href="/dashboardevent" class="dashboard-secondary-btn" style="text-decoration:none; display:block; text-align:center;">Lihat Semua Event</a>
                    </article>

                    <!-- Kartu Event Terdekat -->
                    <article class="dashboard-card athlete-card-event">
                        <div class="athlete-card-header">
                            <span class="athlete-card-icon">🏆</span>
                            <div>
                                <h3>Event Terdekat</h3>
                                <p class="athlete-card-sub">KSC National Cup 2026</p>
                            </div>
                        </div>
                        <div class="athlete-event-meta">
                            <div class="athlete-event-meta-item"><span>📅</span><span>30 Juni 2026</span></div>
                            <div class="athlete-event-meta-item"><span>📍</span><span>Kolam Renang Krian, Sidoarjo</span></div>
                            <div class="athlete-event-meta-item"><span>🏷️</span><span>50m Bebas · 100m Bebas · 200m Dada</span></div>
                        </div>
                        <div class="athlete-countdown-mini">
                            <div><strong id="cdHariB">00</strong><small>Hari</small></div>
                            <div><strong id="cdJamB">00</strong><small>Jam</small></div>
                            <div><strong id="cdMenitB">00</strong><small>Menit</small></div>
                            <div><strong id="cdDetikB">00</strong><small>Detik</small></div>
                        </div>
                        
                        <?php if ($isAktif): ?>
                            <a href="/dashboardevent" class="dashboard-primary-btn" style="text-decoration:none; display:block; text-align:center;">Daftar Sekarang</a>
                        <?php else: ?>
                            <button class="dashboard-primary-btn" style="background-color: #a0aec0; width: 100%; cursor: not-allowed; border: none;" disabled>Ditutup</button>
                        <?php endif; ?>
                    </article>
                </div>
            </section>
        </main>
    </div>
    <script src="/app/js/dashboard.js"></script>
</body>
</html>