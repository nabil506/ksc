<?php
$nama = $_SESSION['nama_aktif'] ?? 'Admin KSC';
$role = $_SESSION['role_aktif'] ?? 'admin';
$status_anggota = $_SESSION['status_aktif'] ?? 'Aktif';
$badgeBg = '#d1fae5';
$badgeColor = '#065f46';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Pelatih - KSC Admin</title>
    <link rel="stylesheet" href="/app/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        .form-container { background: #fff; padding: 25px; border-radius: 12px; border: 1px solid #e2e8f0; max-width: 500px; margin-top: 20px;}
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 8px; font-weight: 600; color: #4a5568; font-size: 14px; }
        .form-group input { width: 100%; padding: 12px; border: 1px solid #cbd5e0; border-radius: 8px; font-family: inherit; box-sizing: border-box; }
        .btn-submit { background-color: #0A4D8C; color: white; padding: 12px 24px; border: none; border-radius: 8px; cursor: pointer; font-weight: 600; width: 100%; }
        .btn-kembali { display: inline-block; margin-top: 15px; color: #4a5568; text-decoration: none; font-size: 14px; }
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
                <a href="/manage-users" class="sidebar-link active" style="font-weight: 600;">⚙️ Manajemen User</a>
                <span class="nav-separator"></span>
                <a href="/" class="sidebar-link back-home">Beranda Web</a>
                <a href="/logout" class="logout-link">Logout</a>
            </nav>
        </aside>

        <main class="dashboard-main">
            <section class="tab-content active">
                <div class="tab-heading">
                    <h1>Tambah Akun Pelatih</h1>
                    <p>Buatkan akun untuk staf pelatih baru agar bisa mengelola jadwal dan event KSC.</p>
                </div>

                <?php if (isset($_SESSION['flash_error'])): ?>
                    <div class="alert alert-danger" style="background-color: #ffe3e3; color: #e53e3e; padding: 12px; border-radius: 8px; margin-bottom: 20px; border-left: 5px solid #e53e3e;">
                        ❌ <?= $_SESSION['flash_error']; unset($_SESSION['flash_error']); ?>
                    </div>
                <?php endif; ?>

                <div class="form-container">
                    <form action="/proses-tambah-pelatih" method="POST">
                        <div class="form-group">
                            <label>Nama Lengkap Pelatih</label>
                            <input type="text" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label>Email Login</label>
                            <input type="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label>Password Sementara</label>
                            <input type="text" name="password" placeholder="Misal: pelatihksc123" required>
                        </div>
                        <button type="submit" class="btn-submit">Simpan & Daftarkan Pelatih</button>
                    </form>
                    <a href="/manage-users" class="btn-kembali">⬅️ Kembali ke Tabel Manajemen</a>
                </div>
            </section>
        </main>
    </div>
</body>
</html>