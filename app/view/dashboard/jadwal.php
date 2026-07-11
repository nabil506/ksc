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
                <div class="user-name"><?= htmlspecialchars($user['nama_lengkap']) ?></div>
                <div class="user-role" style="display: flex; justify-content: center; align-items: center; gap: 8px; margin-top: 8px;">
                    <span style="background: rgba(255,255,255,0.2); padding: 4px 12px; border-radius: 12px; font-size: 10px; font-weight: 600;">
                        <?= htmlspecialchars(strtoupper($user['role_name'])) ?>
                    </span>

                    <?php if (strtolower($user['role_name']) !== 'admin'): ?>
                        <?php
                        $badgeBg = (strtolower($user['status_anggota']) === 'aktif') ? '#d1fae5' : '#fee2e2';
                        $badgeColor = (strtolower($user['status_anggota']) === 'aktif') ? '#065f46' : '#991b1b';
                        ?>
                        <span style="background-color: <?= $badgeBg ?>; color: <?= $badgeColor ?>; padding: 4px 12px; border-radius: 12px; font-size: 10px; font-weight: 600;">
                            <?= htmlspecialchars(strtoupper($user['status_anggota'])) ?>
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

                <?php if (strtolower($user['role_name']) === 'admin'): ?>
                    <a href="/manage-users" class="sidebar-link" style="color: #3182ce; font-weight: 600;">⚙️ Manajemen User</a>
                <?php endif; ?>

                <span class="nav-separator"></span>
                <a href="/logout" class="logout-link">Logout</a>
            </nav>
        </aside>

        <main class="dashboard-main">
            <section class="tab-content active" id="tab-jadwal">

                <div class="tab-heading" style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <h1>Jadwal Latihan</h1>
                        <p>Filter jadwal berdasarkan kelompok latihan atlet.</p>
                    </div>

                    <?php if (strtolower($user['role_name']) === 'admin'): ?>
                        <button onclick="document.getElementById('modalJadwal').style.display='flex'" class="dashboard-primary-btn" style="padding: 10px 20px;">
                            + Tambah Jadwal
                        </button>
                    <?php endif; ?>
                </div>

                <div class="dashboard-table-wrap">
                    <table id="jadwalTable" class="dashboard-table">
                        <thead>
                            <tr>
                                <th>Hari</th>
                                <th>Waktu</th>
                                <th>Pelatih</th>
                                <th>Kolam</th>
                                <th>Keterangan</th>
                                <?php if (strtolower($user['role_name']) === 'admin'): ?>
                                    <th>Aksi</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($jadwalList)): ?>
                                <tr>
                                    <td colspan="<?= (strtolower($user['role_name']) === 'admin') ? '7' : '6' ?>" style="text-align:center; padding: 20px;">
                                        Belum ada jadwal latihan yang terdaftar.
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($jadwalList as $jadwal): ?>
                                        <td><span class="day-badge"><?= htmlspecialchars($jadwal['hari']) ?></span></td>
                                        <td><?= htmlspecialchars($jadwal['waktu']) ?></td>

                                        <td style="font-weight: 600; color: #2d3748;">
                                            <?= htmlspecialchars($jadwal['nama_pelatih']) ?>
                                        </td>

                                        <td><?= htmlspecialchars($jadwal['kolam']) ?></td>
                                        <td><?= htmlspecialchars($jadwal['keterangan']) ?></td>

                                        <?php if (strtolower($user['role_name']) === 'admin'): ?>
                                            <td>
                                                <form action="/hapus-jadwal" method="POST" onsubmit="return confirm('Yakin ingin menghapus jadwal ini?');">
                                                    <input type="hidden" name="id" value="<?= $jadwal['id'] ?>">
                                                    <button type="submit" style="background: #fc8181; color: white; border: none; padding: 6px 12px; border-radius: 4px; cursor: pointer; font-weight: 500;">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>

    <?php if (strtolower($user['role_name']) === 'admin'): ?>
        <div id="modalJadwal" class="event-modal" style="display: none; align-items: center; justify-content: center;">
            <div class="event-modal-content" style="max-width: 500px; padding: 30px;">

                <span class="close-modal" onclick="document.getElementById('modalJadwal').style.display='none'" style="float: right; cursor: pointer; font-size: 24px;">×</span>
                <h2 style="margin-bottom: 20px;">Tambah Jadwal Baru</h2>

                <form action="/tambah-jadwal" method="POST" style="display: flex; flex-direction: column; gap: 15px;">

                    <select name="hari" required style="padding: 10px; border-radius: 6px; border: 1px solid #cbd5e0;">
                        <option value="">-- Pilih Hari --</option>
                        <option value="Senin">Senin</option>
                        <option value="Selasa">Selasa</option>
                        <option value="Rabu">Rabu</option>
                        <option value="Kamis">Kamis</option>
                        <option value="Jumat">Jumat</option>
                        <option value="Sabtu">Sabtu</option>
                        <option value="Minggu">Minggu</option>
                    </select>

                    <input type="text" name="waktu" placeholder="Waktu (Contoh: 15:00 - 17:00)" required style="padding: 10px; border-radius: 6px; border: 1px solid #cbd5e0;">

                    <select name="id_pelatih" required style="padding: 10px; border-radius: 6px; border: 1px solid #cbd5e0;">
                        <option value="">-- Pilih Pelatih --</option>
                        <?php if (!empty($pelatihList)): ?>
                            <?php foreach ($pelatihList as $pelatih): ?>
                                <option value="<?= $pelatih['id'] ?>">Coach <?= htmlspecialchars($pelatih['nama_lengkap']) ?></option>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <option value="" disabled>Belum ada pelatih yang terdaftar</option>
                        <?php endif; ?>
                    </select>

                    <input type="text" name="kolam" placeholder="Nama Kolam (Contoh: Kolam Dangkal)" required style="padding: 10px; border-radius: 6px; border: 1px solid #cbd5e0;">

                    <textarea name="keterangan" placeholder="Keterangan / Materi latihan..." rows="3" style="padding: 10px; border-radius: 6px; border: 1px solid #cbd5e0;"></textarea>

                    <button type="submit" class="dashboard-primary-btn" style="margin-top: 10px;">Simpan Jadwal</button>
                </form>

            </div>
        </div>
    <?php endif; ?>

    <script src="/app/js/dashboard.js"></script>
</body>

</html>