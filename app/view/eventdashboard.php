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
    <title>Event KSC - Krian Swimming Club</title>
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
                <a href="/dashboardevent" class="sidebar-link active">Event KSC</a> <!-- ACTIVE DI SINI -->
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
            <section class="tab-content active" id="tab-event">
                <div class="tab-heading">
                    <h1>Event KSC</h1>
                    <p>Daftar event dan kompetisi yang tersedia untuk anggota.</p>
                </div>

                <div class="countdown-box">
                    <span>Menuju KSC National Cup 2026</span>
                    <div class="countdown-timer">
                        <div><strong id="cdHari">00</strong><small>Hari</small></div>
                        <div><strong id="cdJam">00</strong><small>Jam</small></div>
                        <div><strong id="cdMenit">00</strong><small>Menit</small></div>
                        <div><strong id="cdDetik">00</strong><small>Detik</small></div>
                    </div>
                </div>

                <div class="event-db-grid">
                    <article class="event-db-card">
                        <span class="event-db-badge upcoming">Upcoming</span>
                        <h3>KSC National Cup 2026</h3>
                        <p>30 Juni 2026</p>
                        <p>Kolam Renang Krian, Sidoarjo</p>
                        <div class="event-db-cats">
                            <span>50m Gaya Bebas</span>
                            <span>100m Gaya Bebas</span>
                            <span>200m Gaya Dada</span>
                        </div>
                        <button class="dashboard-primary-btn full" type="button" onclick="openEventForm()">Daftar Sekarang</button>
                    </article>
                    <article class="event-db-card">
                        <span class="event-db-badge upcoming muted">Upcoming</span>
                        <h3>Liga Renang Jawa Timur</h3>
                        <p>15 Juli 2026</p>
                        <p>GOR Renang Surabaya</p>
                        <div class="event-db-cats">
                            <span>50m Bebas</span>
                            <span>100m Dada</span>
                        </div>
                        <button class="dashboard-primary-btn full muted" type="button" onclick="alert('Pendaftaran dibuka 1 Juli 2026')">Segera Dibuka</button>
                    </article>
                    <article class="event-db-card">
                        <span class="event-db-badge done">Selesai</span>
                        <h3>KSC Fun Swim 2025</h3>
                        <p>20 Desember 2025</p>
                        <p>Kolam Renang Krian</p>
                        <div class="event-db-cats">
                            <span>200m Gaya Dada</span>
                        </div>
                        <button class="dashboard-primary-btn full muted" type="button" disabled>Event Selesai</button>
                    </article>
                </div>

                <h2 class="section-title">Kalender Kompetisi 2026</h2>
                <div class="dashboard-table-wrap">
                    <table class="dashboard-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Event</th>
                                <th>Tanggal</th>
                                <th>Lokasi</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>KSC National Cup 2026</td>
                                <td>30 Juni 2026</td>
                                <td>Krian</td>
                                <td><span class="event-db-badge inline upcoming">Upcoming</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>
    
    <!-- Modal Event -->
    <div class="modal-overlay" id="eventModal">
        <div class="modal-box">
            <button class="modal-close" type="button" onclick="closeEventForm()">×</button>
            <h3>Pendaftaran Event KSC</h3>
            <form id="eventForm">
                <div class="form-group">
                    <label for="namaAtlet">Nama Atlet</label>
                    <input type="text" id="namaAtlet" value="<?= htmlspecialchars($nama) ?>" required>
                </div>
                <div class="form-group">
                    <label for="umurAtlet">Umur</label>
                    <input type="number" id="umurAtlet" min="5" max="80" value="17" required>
                </div>
                <input type="hidden" id="tglDaftar">
                <div class="form-group">
                    <label for="waAtlet">No. WhatsApp</label>
                    <input type="tel" id="waAtlet" placeholder="Contoh: 08123456789" required>
                </div>
                <div class="form-group">
                    <label for="kategori">Kategori Lomba</label>
                    <select id="kategori" required>
                        <option value="50m Gaya Bebas">50m Gaya Bebas</option>
                        <option value="100m Gaya Bebas">100m Gaya Bebas</option>
                        <option value="200m Gaya Dada">200m Gaya Dada</option>
                        <option value="Relay 4x50m">Relay 4x50m</option>
                    </select>
                </div>
                <button type="submit" class="form-submit-btn">Daftarkan Sekarang</button>
            </form>
        </div>
    </div>
    <script src="/app/js/dashboard.js"></script>
</body>
</html>