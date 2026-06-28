<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$nama = $_SESSION['nama_aktif'] ?? 'Anggota KSC';
$role = $_SESSION['role_aktif'] ?? 'Atlet';

$status_anggota = $_SESSION['status_anggota'] ?? $_SESSION['status_aktif'] ?? 'Aktif';
$isAktif = (strtolower($status_anggota) === 'aktif');
$badgeBg = $isAktif ? '#d1fae5' : '#fee2e2';
$badgeColor = $isAktif ? '#065f46' : '#991b1b';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Latihan - Krian Swimming Club</title>
    <link rel="stylesheet" href="/app/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="dashboard-page">
    <div class="dashboard-container">
        
        <aside class="dashboard-sidebar">
            <div class="sidebar-user">
                <div class="user-name"><?= htmlspecialchars($nama) ?></div>
                <div class="user-role" style="display: flex; justify-content: center; align-items: center; gap: 8px; margin-top: 8px;">
                    <span style="background: rgba(255,255,255,0.2); padding: 4px 12px; border-radius: 12px; font-size: 10px; font-weight: 600;">
                        <?= htmlspecialchars(strtoupper($role)) ?>
                    </span>
                    
                    <!-- Badge Status disembunyikan untuk Admin -->
                    <?php if (strtolower($role) !== 'admin'): ?>
                    <span style="background-color: <?= $badgeBg ?>; color: <?= $badgeColor ?>; padding: 4px 12px; border-radius: 12px; font-size: 10px; font-weight: 600;">
                        <?= htmlspecialchars(strtoupper($status_anggota)) ?>
                    </span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="dashboard-brand">KSC Dashboard</div>
            <nav class="dashboard-nav">
                <a href="/dashboard" class="sidebar-link">Beranda</a>
                <a href="/profil" class="sidebar-link">Profil Saya</a>
                <a href="/jadwal" class="sidebar-link active">Jadwal Latihan</a>
                <a href="/dashboardevent" class="sidebar-link">Event KSC</a>
                <a href="/riwayat" class="sidebar-link">Riwayat Pendaftaran</a>
                
                <?php if (strtolower($role) === 'admin'): ?>
                    <a href="/manage-users" class="sidebar-link" style="color: #3182ce; font-weight: 600;">⚙️ Manajemen User</a>
                <?php endif; ?>

                <span class="nav-separator"></span>
                <a href="/" class="sidebar-link back-home">Beranda Web</a>
                <a href="/logout" class="logout-link">Logout</a>
            </nav>
        </aside>

        <main class="dashboard-main">
            <section class="tab-content active" id="tab-jadwal">
                <div class="tab-heading">
                    <h1>Jadwal Latihan</h1>
                    <p>Filter jadwal berdasarkan kelompok latihan atlet.</p>
                </div>

                <div class="filter-row">
                    <button class="filter-btn active" type="button" onclick="filterJadwal('semua', this)">Semua</button>
                    <button class="filter-btn" type="button" onclick="filterJadwal('pemula', this)">Pemula</button>
                    <button class="filter-btn" type="button" onclick="filterJadwal('remaja', this)">Remaja</button>
                    <button class="filter-btn" type="button" onclick="filterJadwal('dewasa', this)">Dewasa</button>
                    <button class="filter-btn" type="button" onclick="filterJadwal('prestasi', this)">Prestasi</button>
                </div>
                <div class="dashboard-table-wrap">
                    <table id="jadwalTable" class="dashboard-table">
                        <thead>
                            <tr>
                                <th>Hari</th>
                                <th>Waktu</th>
                                <th>Kelompok</th>
                                <th>Pelatih</th>
                                <th>Kolam</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($jadwalList)): ?>
                                <tr>
                                    <td colspan="6" style="text-align:center;">Belum ada jadwal.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($jadwalList as $jadwal): ?>
                                    <tr data-kelompok="<?= strtolower($jadwal['kelompok']) ?>">
                                        <td><span class="day-badge"><?= htmlspecialchars($jadwal['hari']) ?></span></td>
                                        <td><?= htmlspecialchars($jadwal['waktu']) ?></td>
                                        <td>
                                            <span class="group-badge <?= strtolower($jadwal['kelompok']) ?>">
                                                <?= htmlspecialchars($jadwal['kelompok']) ?>
                                            </span>
                                        </td>
                                        <td><?= htmlspecialchars($jadwal['pelatih']) ?></td>
                                        <td><?= htmlspecialchars($jadwal['kolam']) ?></td>
                                        <td><?= htmlspecialchars($jadwal['keterangan']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>
    <script src="/app/js/dashboard.js"></script>
</body>
</html>