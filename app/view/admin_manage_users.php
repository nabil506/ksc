<?php
$nama = $_SESSION['nama_aktif'] ?? 'Admin KSC';
$role = $_SESSION['role_aktif'] ?? 'admin';
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
    <title>Manajemen User - Krian Swimming Club</title>
    <link rel="stylesheet" href="/app/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        .status-aktif { background-color: #d1fae5; color: #065f46; padding: 4px 12px; border-radius: 20px; font-weight: 600; font-size: 12px; }
        .status-nonaktif { background-color: #fee2e2; color: #991b1b; padding: 4px 12px; border-radius: 20px; font-weight: 600; font-size: 12px; }
        .status-suspend { background-color: #fef3c7; color: #92400e; padding: 4px 12px; border-radius: 20px; font-weight: 600; font-size: 12px; }
        .select-aksi { padding: 6px 12px; border: 1px solid #cbd5e0; border-radius: 6px; font-family: 'Poppins', sans-serif; font-size: 13px; cursor: pointer; background-color: #fff; outline: none; }
        .select-aksi:focus { border-color: #0A4D8C; }
    </style>
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
                <a href="/riwayat" class="sidebar-link">Riwayat Pendaftaran</a>
                
                <?php if (strtolower($role) === 'admin'): ?>
                    <a href="/manage-users" class="sidebar-link active" style="font-weight: 600;">
                        ⚙️ Manajemen User
                    </a>
                <?php endif; ?>

                <span class="nav-separator"></span>
                <a href="/" class="sidebar-link back-home">Beranda Web</a>
                <a href="/logout" class="logout-link">Logout</a>
            </nav>
        </aside>

        <main class="dashboard-main">
            <section class="tab-content active">
                <div class="tab-heading">
                    <h1>Manajemen User</h1>
                    <p>Pantau dan atur hak akses serta status keaktifan seluruh anggota KSC.</p>
                    
                    <a href="/tambah-pelatih" style="display:inline-block; margin-top: 15px; text-decoration: none; background-color: #0A4D8C; color: white; padding: 10px 20px; border-radius: 8px; font-weight: 600;">
                        ➕ Tambah Akun Pelatih
                    </a>
                </div>

                <?php if (isset($_SESSION['flash_sukses'])): ?>
                    <div class="alert alert-success" style="background-color: #e6fffa; color: #319795; padding: 12px; border-radius: 8px; margin-bottom: 20px; border-left: 5px solid #319795; font-size: 14px;">
                        ✅ <?= $_SESSION['flash_sukses']; unset($_SESSION['flash_sukses']); ?>
                    </div>
                <?php endif; ?>
                <?php if (isset($_SESSION['flash_error'])): ?>
                    <div class="alert alert-danger" style="background-color: #ffe3e3; color: #e53e3e; padding: 12px; border-radius: 8px; margin-bottom: 20px; border-left: 5px solid #e53e3e; font-size: 14px;">
                        ❌ <?= $_SESSION['flash_error']; unset($_SESSION['flash_error']); ?>
                    </div>
                <?php endif; ?>

                <div class="dashboard-table-wrap">
                    <table class="dashboard-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Lengkap</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Aksi (Ubah Status)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            if (!empty($users)): 
                                foreach ($users as $u): 
                                    $statusLower = strtolower($u['status_anggota']);
                                    $badgeClass = 'status-nonaktif';
                                    if ($statusLower === 'aktif') $badgeClass = 'status-aktif';
                                    if ($statusLower === 'suspend') $badgeClass = 'status-suspend';
                            ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><strong><?= htmlspecialchars($u['nama_lengkap']) ?></strong></td>
                                <td><?= htmlspecialchars($u['email']) ?></td>
                                <td>
                                    <span class="badge-role" style="font-size: 11px; padding: 4px 8px;">
                                        <?= htmlspecialchars(ucfirst($u['role'])) ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="<?= $badgeClass ?>">
                                        <?= htmlspecialchars(ucfirst($u['status_anggota'])) ?>
                                    </span>
                                </td>
                                <td>
                                    <form action="/update-status" method="POST" style="margin: 0;">
                                        <input type="hidden" name="user_id" value="<?= $u['id'] ?>">
                                        <select name="status_baru" class="select-aksi" onchange="this.form.submit()">
                                            <option value="Aktif" <?= $statusLower === 'aktif' ? 'selected' : '' ?>>Aktif</option>
                                            <option value="Nonaktif" <?= $statusLower === 'nonaktif' ? 'selected' : '' ?>>Nonaktif</option>
                                            <option value="Suspend" <?= $statusLower === 'suspend' ? 'selected' : '' ?>>Suspend</option>
                                        </select>
                                    </form>
                                </td>
                            </tr>
                            <?php 
                                endforeach; 
                            else: 
                            ?>
                            <tr>
                                <td colspan="6" style="text-align: center; padding: 20px;">Belum ada data pengguna.</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>
</body>
</html>