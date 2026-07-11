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
                <div class="user-name"><?= htmlspecialchars($nama_lengkap) ?></div>
                <div class="user-role" style="display: flex; justify-content: center; align-items: center; gap: 8px; margin-top: 8px;">
                    <span style="background: rgba(255,255,255,0.2); padding: 4px 12px; border-radius: 12px; font-size: 10px; font-weight: 600;">
                        <?= htmlspecialchars(strtoupper($role_name)) ?>
                    </span>

                    <?php if (strtolower($role_name) !== 'admin'): ?>
                        <?php
                        $badgeBg = (strtolower($status_anggota) === 'aktif') ? '#d1fae5' : '#fee2e2';
                        $badgeColor = (strtolower($status_anggota) === 'aktif') ? '#065f46' : '#991b1b';
                        ?>
                        <span style="background-color: <?= $badgeBg ?>; color: <?= $badgeColor ?>; padding: 4px 12px; border-radius: 12px; font-size: 10px; font-weight: 600;">
                            <?= htmlspecialchars(strtoupper($status_anggota)) ?>
                        </span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="dashboard-brand">KSC Dashboard</div>

            <nav class="dashboard-nav">
                <a href="/dashboard" class="sidebar-link active">Beranda</a>
                <a href="/profil" class="sidebar-link">Profil Saya</a>
                <a href="/jadwal" class="sidebar-link">Jadwal Latihan</a>
                <a href="/dashboardevent" class="sidebar-link">Event KSC</a>

                <?php if (strtolower($role_name) === 'atlit' || strtolower($role_name) === 'admin'): ?>
                    <a href="/riwayat" class="sidebar-link">Riwayat Pendaftaran</a>
                <?php endif; ?>

                <?php if (strtolower($role_name) === 'admin'): ?>
                    <a href="/manage-users" class="sidebar-link" style="color: #3182ce; font-weight: 600;">
                        ⚙️ Manajemen User
                    </a>
                <?php endif; ?>

                <span class="nav-separator"></span>
                <a href="/logout" class="logout-link">Logout</a>
            </nav>
        </aside>

        <main class="dashboard-main">
            <section class="tab-content active" id="tab-beranda">

                <div class="dashboard-hero">
                    <div>
                        <span class="eyebrow">
                            Krian Swimming Club
                            <?php if (strtolower($status_anggota) === 'nonaktif' && strtolower($role_name) !== 'admin'): ?>
                                <span style="margin-left: 10px; background: #fee2e2; color: #991b1b; padding: 3px 8px; border-radius: 4px; font-size: 11px; font-weight: bold;">
                                    ⚠️ Akun Anda <?= htmlspecialchars(ucfirst($status_anggota)) ?>
                                </span>
                            <?php endif; ?>
                        </span>

                        <h1>Halo, <?= htmlspecialchars($nama_lengkap) ?>! 👋</h1>

                        <?php if (strtolower($role_name) === 'admin'): ?>
                            <p>Selamat datang di Panel Admin. Pantau data anggota, atur jadwal, dan kelola event KSC dari sini.</p>
                        <?php elseif (strtolower($role_name) === 'pelatih'): ?>
                            <p>Selamat datang, Coach! Cek jadwal melatih Anda dan pantau perkembangan event KSC terbaru.</p>
                        <?php else: ?>
                            <?php if (strtolower($status_anggota) === 'nonaktif'): ?>
                                <p style="color: #c53030; font-weight: 500;">
                                    Akun kamu saat ini dinonaktifkan. Silakan hubungi admin untuk mengaktifkan kembali akunmu agar bisa mendaftar event.
                                </p>
                            <?php else: ?>
                                <p>Pantau jadwal latihanmu, daftarkan dirimu ke event kompetisi, dan raih prestasi terbaikmu bersama KSC.</p>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <?php if (strtolower($role_name) === 'admin'): ?>
                    <h2 style="margin-top: 30px; font-size: 1.2rem; color: #2d3748;">Pintasan Cepat Admin</h2>
                    <div class="dashboard-stats-grid" style="grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); margin-top: 15px;">
                        <div class="dashboard-stat-card" style="cursor: pointer; background: #ebf8ff;" onclick="window.location.href='/manage-users'">
                            <span class="stat-icon" style="background: #bee3f8;">👥</span>
                            <strong style="font-size: 1.1rem; margin-top: 10px; color: #2b6cb0;">Manajemen User</strong>
                            <span>Kelola Atlit & Pelatih</span>
                        </div>
                        <div class="dashboard-stat-card" style="cursor: pointer; background: #faf5ff;" onclick="window.location.href='/dashboardevent'">
                            <span class="stat-icon" style="background: #e9d8fd;">🏆</span>
                            <strong style="font-size: 1.1rem; margin-top: 10px; color: #6b46c1;">Kelola Event</strong>
                            <span>Tambah & Atur Lomba</span>
                        </div>
                        <div class="dashboard-stat-card" style="cursor: pointer; background: #f0fff4;" onclick="window.location.href='/riwayat'">
                            <span class="stat-icon" style="background: #c6f6d5;">📄</span>
                            <strong style="font-size: 1.1rem; margin-top: 10px; color: #2f855a;">Riwayat Daftar</strong>
                            <span>Lihat Semua Pendaftar</span>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if (strtolower($role_name) === 'pelatih'): ?>
                    <h2 style="margin-top: 30px; font-size: 1.2rem; color: #2d3748;">Pintasan Pelatih</h2>
                    <div class="dashboard-stats-grid" style="grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); margin-top: 15px;">
                        <div class="dashboard-stat-card" style="cursor: pointer;" onclick="window.location.href='/profil'">
                            <span class="stat-icon">👤</span>
                            <strong style="font-size: 1.1rem; margin-top: 10px;">Profil Saya</strong>
                            <span>Update Biodata</span>
                        </div>
                        <div class="dashboard-stat-card" style="cursor: pointer;" onclick="window.location.href='/jadwal'">
                            <span class="stat-icon">⏱️</span>
                            <strong style="font-size: 1.1rem; margin-top: 10px;">Jadwal Mengajar</strong>
                            <span>Lihat Sesi Latihan</span>
                        </div>
                        <div class="dashboard-stat-card" style="cursor: pointer;" onclick="window.location.href='/dashboardevent'">
                            <span class="stat-icon">📢</span>
                            <strong style="font-size: 1.1rem; margin-top: 10px;">Event Tersedia</strong>
                            <span>Info Kompetisi KSC</span>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if (strtolower($role_name) === 'atlit'): ?>
                    <h2 style="margin-top: 30px; font-size: 1.2rem; color: #2d3748;">Aktivitas Atlit</h2>
                    <div class="dashboard-stats-grid" style="grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); margin-top: 15px;">
                        <div class="dashboard-stat-card" style="cursor: pointer;" onclick="window.location.href='/jadwal'">
                            <span class="stat-icon">🏊</span>
                            <strong style="font-size: 1.1rem; margin-top: 10px;">Jadwal Latihan</strong>
                            <span>Cek Jadwal & Kolam</span>
                        </div>
                        <div class="dashboard-stat-card" style="cursor: pointer;" onclick="window.location.href='/dashboardevent'">
                            <span class="stat-icon">🏆</span>
                            <strong style="font-size: 1.1rem; margin-top: 10px;">Daftar Lomba</strong>
                            <span>Ikuti Event Terbaru</span>
                        </div>
                        <div class="dashboard-stat-card" style="cursor: pointer;" onclick="window.location.href='/riwayat'">
                            <span class="stat-icon">🏅</span>
                            <strong style="font-size: 1.1rem; margin-top: 10px;">Riwayat Saya</strong>
                            <span>Event yang Diikuti</span>
                        </div>
                    </div>

                    <div class="athlete-home-grid" style="margin-top: 30px; grid-template-columns: 1fr;">
                        <article class="dashboard-card athlete-card-event">
                            <div class="athlete-card-header">
                                <span class="athlete-card-icon">📢</span>
                                <div>
                                    <h3>Pusat Informasi Atlit</h3>
                                    <p class="athlete-card-sub">Pembaruan sistem & Informasi Klub</p>
                                </div>
                            </div>
                            <div style="padding: 20px 0;">
                                <p>Pastikan kamu selalu mengecek <strong>Jadwal Latihan</strong> setiap minggunya. Jika ada event kompetisi renang terbaru, segera daftar melalui menu <strong>Event KSC</strong>.</p>
                                <?php if (strtolower($status_anggota) === 'aktif'): ?>
                                    <a href="/dashboardevent" class="dashboard-primary-btn" style="text-decoration:none; display:inline-block; margin-top:15px;">Lihat Daftar Event</a>
                                <?php else: ?>
                                    <button class="dashboard-primary-btn" style="background-color: #a0aec0; cursor: not-allowed; border: none; margin-top:15px;" disabled>Akun Nonaktif</button>
                                <?php endif; ?>
                            </div>
                        </article>
                    </div>
                <?php endif; ?>

            </section>
        </main>
    </div>
    <script src="/app/js/dashboard.js"></script>
</body>

</html>