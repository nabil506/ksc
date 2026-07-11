<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event KSC - Krian Swimming Club</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/app/css/style.css">
    <style>
        .modal-overlay { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); backdrop-filter: blur(4px); z-index: 1000; justify-content: center; align-items: center; font-family: 'Poppins', sans-serif; }
        .modal-overlay.open { display: flex; }
        .modal-box { background: #ffffff; padding: 25px 30px; border-radius: 12px; width: 100%; max-width: 450px; box-shadow: 0 10px 25px rgba(0,0,0,0.15); animation: slideDown 0.3s ease-out; max-height: 90vh; overflow-y: auto; }
        @keyframes slideDown { from { transform: translateY(-20px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
        .modal-title { margin-top: 0; margin-bottom: 20px; font-size: 1.25rem; color: #2d3748; border-bottom: 2px solid #edf2f7; padding-bottom: 10px; font-weight: 600; }
        .form-group { margin-bottom: 15px; text-align: left; }
        .form-group label { display: block; margin-bottom: 6px; font-weight: 500; color: #4a5568; font-size: 0.9rem; }
        .form-control { width: 100%; padding: 10px 12px; border: 1px solid #cbd5e0; border-radius: 6px; font-size: 1rem; box-sizing: border-box; background: #f7fafc; font-family: 'Poppins', sans-serif; }
        .form-control:focus { outline: none; border-color: #3182ce; background: #fff; }
        textarea.form-control { resize: vertical; min-height: 80px; }
        .modal-actions { display: flex; gap: 10px; margin-top: 25px; }
        .btn-form { flex: 1; padding: 10px; border: none; border-radius: 6px; font-weight: 600; cursor: pointer; font-size: 1rem; font-family: 'Poppins', sans-serif; }
        .btn-submit { background: #3182ce; color: white; }
        .btn-cancel { background: #e53e3e; color: white; }
        .btn-disabled { background: #e2e8f0; color: #a0aec0; cursor: not-allowed; border: none; font-weight: 600; padding: 10px; width: 100%; }
        .event-desc { font-size: 0.85rem; color: #4a5568; margin-top: 10px; padding-top: 10px; border-top: 1px dashed #e2e8f0; line-height: 1.5; }
    </style>
</head>
<body class="dashboard-page">
    <div class="dashboard-container">
        <!-- SIDEBAR TETAP -->
        <aside class="dashboard-sidebar">
            <div class="sidebar-user">
                <div class="user-name"><?= htmlspecialchars($user['nama_lengkap']) ?></div>
                <div class="user-role" style="display: flex; justify-content: center; align-items: center; gap: 8px; margin-top: 8px;">
                    <span style="background: rgba(255,255,255,0.2); padding: 4px 12px; border-radius: 12px; font-size: 10px; font-weight: 600;">
                        <?= htmlspecialchars(strtoupper($user['role_name'])) ?>
                    </span>
                    <?php if (strtolower($user['role_name']) !== 'admin'): ?>
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
                <a href="/jadwal" class="sidebar-link">Jadwal Latihan</a>
                <a href="/dashboardevent" class="sidebar-link active">Event KSC</a>
                <a href="/riwayat" class="sidebar-link">Riwayat Pendaftaran</a>
                <?php if (strtolower($user['role_name']) === 'admin'): ?>
                    <a href="/manage-users" class="sidebar-link" style="color: #3182ce; font-weight: 600;">⚙️ Manajemen User</a>
                <?php endif; ?>
                <span class="nav-separator"></span>
                <a href="/logout" class="logout-link">Logout</a>
            </nav>
        </aside>

        <main class="dashboard-main">
            <section class="tab-content active" id="tab-event">
                <div class="tab-heading">
                    <h1>Event KSC</h1>
                    <?php if (strtolower($user['role_name']) === 'admin'): ?>
                        <p>Kelola jadwal event KSC untuk anggota.</p>
                        <button class="dashboard-primary-btn" onclick="openModal('adminModal')">+ Buat Event Baru</button>
                    <?php else: ?>
                        <p>Daftar event yang tersedia untuk anggota.</p>
                    <?php endif; ?>
                </div>

                <div class="event-db-grid">
                    <?php if (!empty($data['events'])): ?>
                        <?php foreach ($data['events'] as $event): 
                            $eventDate = strtotime($event['tanggal_event']);
                            $isExpired = ($today > $eventDate); 
                            $sudahDaftar = in_array($event['id'], $registeredEvents ?? []);
                        ?>
                            <article class="event-db-card">
                                <h3><?= htmlspecialchars($event['nama_event']) ?></h3>
                                <p><strong>Tanggal:</strong> <?= date('d M Y', $eventDate) ?></p>
                                <p><strong>Lokasi:</strong> <?= htmlspecialchars($event['lokasi']) ?></p>
                                
                                <?php if (!empty($event['deskripsi'])): ?>
                                    <div class="event-desc"><?= nl2br(htmlspecialchars($event['deskripsi'])) ?></div>
                                <?php endif; ?>

                                <!-- TOMBOL KELOLA EVENT ADMIN (Membuka Modal Edit) -->
                                <?php if (strtolower($user['role_name']) === 'admin'): ?>
                                    <button class="dashboard-primary-btn full" style="margin-top: 15px;" type="button" onclick="openModal('editModal-<?= $event['id'] ?>')">Kelola Event</button>
                                <?php elseif (strtolower($user['role_name']) === 'pelatih'): ?>
                                    <button class="dashboard-primary-btn full btn-disabled" style="margin-top: 15px;" type="button" disabled>Hanya Melihat</button>
                                <?php elseif (strtolower($user['role_name']) === 'atlit'): ?>
                                    <?php if ($sudahDaftar): ?>
                                        <button class="dashboard-primary-btn full btn-disabled" style="margin-top: 15px;" type="button" disabled>Sudah Terdaftar ✅</button>
                                    <?php elseif ($isExpired): ?>
                                        <button class="dashboard-primary-btn full btn-disabled" style="margin-top: 15px;" type="button" disabled>Pendaftaran Ditutup</button>
                                    <?php elseif ($isAktif): ?>
                                        <button class="dashboard-primary-btn full" style="margin-top: 15px;" type="button" onclick="openModal('atletModal-<?= $event['id'] ?>')">Daftar Sekarang</button>
                                    <?php else: ?>
                                        <button class="dashboard-primary-btn full btn-disabled" style="margin-top: 15px;" type="button" disabled>Status Nonaktif</button>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </article>

                            <!-- ================= MODAL EDIT & HAPUS EVENT (HANYA ADMIN) ================= -->
                            <?php if (strtolower($user['role_name']) === 'admin'): ?>
                            <div class="modal-overlay" id="editModal-<?= $event['id'] ?>">
                                <div class="modal-box">
                                    <h3 class="modal-title">Edit Event KSC</h3>
                                    
                                    <!-- Form Edit Data -->
                                    <form action="/proses-edit-event" method="POST">
                                        <input type="hidden" name="event_id" value="<?= $event['id'] ?>">
                                        
                                        <div class="form-group">
                                            <label>Nama Event</label>
                                            <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($event['nama_event']) ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Deskripsi</label>
                                            <textarea name="deskripsi" class="form-control"><?= htmlspecialchars($event['deskripsi']) ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal</label>
                                            <!-- Format input date HTML memerlukan YYYY-MM-DD -->
                                            <input type="date" name="tanggal" class="form-control" value="<?= date('Y-m-d', $eventDate) ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Lokasi</label>
                                            <input type="text" name="lokasi" class="form-control" value="<?= htmlspecialchars($event['lokasi']) ?>" required>
                                        </div>
                                        
                                        <div class="modal-actions">
                                            <button type="submit" class="btn-form btn-submit">Simpan Perubahan</button>
                                            <button type="button" class="btn-form btn-cancel" onclick="closeModal('editModal-<?= $event['id'] ?>')">Tutup</button>
                                        </div>
                                    </form>

                                    <!-- Form Khusus Hapus Event -->
                                    <form action="/proses-hapus-event" method="POST" style="margin-top: 15px;" onsubmit="return confirm('Peringatan: Semua atlit yang sudah mendaftar di event ini akan ikut terhapus dari daftar. Yakin ingin menghapus event ini secara permanen?');">
                                        <input type="hidden" name="event_id" value="<?= $event['id'] ?>">
                                        <button type="submit" class="btn-form" style="background: #e53e3e; color: white; width: 100%;">🗑️ Hapus Event Ini</button>
                                    </form>
                                </div>
                            </div>
                            <?php endif; ?>

                            <!-- ================= MODAL DAFTAR ATLIT ================= -->
                            <?php if (strtolower($user['role_name']) === 'atlit' && $isAktif && !$isExpired && !$sudahDaftar): ?>
                            <div class="modal-overlay" id="atletModal-<?= $event['id'] ?>">
                                <div class="modal-box">
                                    <h3 class="modal-title">Konfirmasi Pendaftaran</h3>
                                    <form action="/proses-daftar-event" method="POST">
                                        <input type="hidden" name="event_id" value="<?= $event['id'] ?>">
                                        <p>Apakah Anda yakin mendaftar event <strong><?= htmlspecialchars($event['nama_event']) ?></strong>?</p>
                                        <div class="modal-actions">
                                            <button type="submit" class="btn-form btn-submit">Ya, Daftar</button>
                                            <button type="button" class="btn-form btn-cancel" onclick="closeModal('atletModal-<?= $event['id'] ?>')">Batal</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <?php endif; ?>

                        <?php endforeach; ?>
                    <?php else: ?>
                        <div style="grid-column: 1 / -1; text-align: center; padding: 40px;">
                            <p>Tidak ada event yang tersedia.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </section>
        </main>
    </div>

    <!-- MODAL TAMBAH EVENT BARU -->
    <?php if (strtolower($user['role_name']) === 'admin'): ?>
    <div class="modal-overlay" id="adminModal">
        <div class="modal-box">
            <h3 class="modal-title">Buat Event Baru</h3>
            <form action="/proses-tambah-event" method="POST">
                <div class="form-group"><label>Nama Event</label><input type="text" name="nama" class="form-control" required></div>
                <div class="form-group"><label>Deskripsi</label><textarea name="deskripsi" class="form-control"></textarea></div>
                <div class="form-group"><label>Tanggal</label><input type="date" name="tanggal" class="form-control" required></div>
                <div class="form-group"><label>Lokasi</label><input type="text" name="lokasi" class="form-control" required></div>
                <div class="modal-actions"><button type="submit" class="btn-form btn-submit">Simpan</button><button type="button" class="btn-form btn-cancel" onclick="closeModal('adminModal')">Batal</button></div>
            </form>
        </div>
    </div>
    <?php endif; ?>

    <script>
        function openModal(id) { document.getElementById(id).classList.add("open"); }
        function closeModal(id) { document.getElementById(id).classList.remove("open"); }
    </script>
</body>
</html>