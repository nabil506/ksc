<?php
$nama = $_SESSION['nama_aktif'] ?? 'Anggota KSC';
$role = $_SESSION['role_aktif'] ?? 'Atlet';

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
    <title>Riwayat Pendaftaran - Krian Swimming Club</title>
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
                <a href="/dashboard" class="sidebar-link">Beranda</a>
                <a href="/profil" class="sidebar-link">Profil Saya</a>
                <a href="/jadwal" class="sidebar-link">Jadwal Latihan</a>
                <a href="/dashboardevent" class="sidebar-link">Event KSC</a>
                <a href="/riwayat" class="sidebar-link active">Riwayat Pendaftaran</a> <!-- ACTIVE DI SINI -->
                
                <?php if (strtolower($role) === 'admin'): ?>
                    <a href="/manage-users" class="sidebar-link" style="color: #3182ce; font-weight: 600;">⚙️ Manajemen User</a>
                <?php endif; ?>

                <span class="nav-separator"></span>
                <a href="/" class="sidebar-link back-home">Beranda Web</a>
                <a href="/logout" class="logout-link">Logout</a>
            </nav>
        </aside>

        <main class="dashboard-main">
            <section class="tab-content active" id="tab-riwayat">
                <div class="tab-heading">
                    <h1>Riwayat Pendaftaran</h1>
                    <p>Semua event yang pernah kamu daftarkan melalui dashboard ini.</p>
                </div>

                <div class="riwayat-stats" id="riwayatStats">
                    <div class="riwayat-stat-box">
                        <span class="riwayat-stat-icon">📋</span>
                        <div><strong id="rvTotal">0</strong><span>Total Pendaftaran</span></div>
                    </div>
                    <div class="riwayat-stat-box">
                        <span class="riwayat-stat-icon">🏆</span>
                        <div><strong id="rvEvent">-</strong><span>Event Aktif</span></div>
                    </div>
                    <div class="riwayat-stat-box">
                        <span class="riwayat-stat-icon">🏷️</span>
                        <div><strong id="rvKategori">-</strong><span>Kategori Terbanyak</span></div>
                    </div>
                    <div class="riwayat-stat-box">
                        <span class="riwayat-stat-icon">✅</span>
                        <div><strong id="rvStatus">Terdaftar</strong><span>Status</span></div>
                    </div>
                </div>

                <div class="riwayat-toolbar">
                    <div class="riwayat-search-wrap">
                        <span class="riwayat-search-icon">🔍</span>
                        <input type="text" id="riwayatSearch" class="riwayat-search" placeholder="Cari nama atau kategori..." oninput="renderRiwayat()">
                    </div>
                    <select id="riwayatFilter" class="riwayat-filter-select" onchange="renderRiwayat()">
                        <option value="">Semua Kategori</option>
                        <option value="50m Gaya Bebas">50m Gaya Bebas</option>
                        <option value="100m Gaya Bebas">100m Gaya Bebas</option>
                        <option value="200m Gaya Dada">200m Gaya Dada</option>
                        <option value="Relay 4x50m">Relay 4x50m</option>
                    </select>
                    <button class="riwayat-action-btn print" type="button" onclick="printRiwayat()">🖨️ Cetak</button>
                    <button class="riwayat-action-btn danger" type="button" onclick="hapusSemua()">🗑️ Hapus Semua</button>
                </div>

                <div class="dashboard-table-wrap">
                    <table class="dashboard-table" id="riwayatTable">
                        <thead>
                            <tr>
                                <th>No. Peserta</th>
                                <th>Nama Atlet</th>
                                <th>Kategori</th>
                                <th>Event</th>
                                <th>Tanggal Daftar</th>
                                <th>WA</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="riwayatBody">
                            <!-- Data akan dimuat dengan JavaScript yang sudah kamu buat sebelumnya -->
                        </tbody>
                    </table>
                </div>

                <div class="riwayat-empty" id="riwayatEmpty" style="display:none">
                    <div class="riwayat-empty-icon">📭</div>
                    <h3>Belum Ada Riwayat</h3>
                    <p>Kamu belum mendaftarkan diri ke event apapun.<br>Yuk, daftar sekarang!</p>
                    <a href="/dashboardevent" class="dashboard-primary-btn" style="text-decoration:none; display:inline-block;">Lihat Event</a>
                </div>
            </section>
        </main>
    </div>
    <script src="/app/js/dashboard.js"></script>
</body>
</html>