<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen User - Krian Swimming Club</title>
    <link rel="stylesheet" href="/app/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        .status-aktif {
            background-color: #d1fae5;
            color: #065f46;
            padding: 4px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 12px;
        }

        .status-nonaktif {
            background-color: #fee2e2;
            color: #991b1b;
            padding: 4px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 12px;
        }

        .select-aksi {
            padding: 6px 12px;
            border: 1px solid #cbd5e0;
            border-radius: 6px;
            font-family: 'Poppins', sans-serif;
            font-size: 13px;
            cursor: pointer;
            background-color: #fff;
            outline: none;
        }

        .select-aksi:focus {
            border-color: #0A4D8C;
        }
    </style>
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
                </div>
            </div>
            <div class="dashboard-brand">KSC Dashboard</div>

            <nav class="dashboard-nav">
                <a href="/dashboard" class="sidebar-link">Beranda</a>
                <a href="/profil" class="sidebar-link">Profil Saya</a>
                <a href="/jadwal" class="sidebar-link">Jadwal Latihan</a>
                <a href="/dashboardevent" class="sidebar-link">Event KSC</a>
                <a href="/riwayat" class="sidebar-link">Riwayat Pendaftaran</a>

                <?php if (strtolower($role_name) === 'admin'): ?>
                    <a href="/manage-users" class="sidebar-link active" style="font-weight: 600;">⚙️ Manajemen User</a>
                <?php endif; ?>

                <span class="nav-separator"></span>
                <a href="/logout" class="logout-link">Logout</a>
            </nav>
        </aside>

        <main class="dashboard-main">
            <section class="tab-content active">
                <div class="tab-heading">
                    <h1>Manajemen User</h1>
                    <p>Atur hak akses serta status keaktifan anggota KSC.</p>
                    <a href="/tambah-pelatih" style="display:inline-block; margin-top: 15px; text-decoration: none; background-color: #0A4D8C; color: white; padding: 10px 20px; border-radius: 8px; font-weight: 600;">
                        ➕ Tambah Akun Pelatih
                    </a>
                </div>

                <?php if (isset($_SESSION['flash_sukses'])): ?>
                    <div style="background-color: #e6fffa; color: #319795; padding: 12px; border-radius: 8px; margin-bottom: 20px; border-left: 5px solid #319795; font-size: 14px;">
                        ✅ <?= $_SESSION['flash_sukses'];
                            unset($_SESSION['flash_sukses']); ?>
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
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            if (!empty($users)):
                                foreach ($users as $u):
                                    $statusLower = strtolower($u['status_anggota']);
                                    $badgeClass = ($statusLower === 'aktif') ? 'status-aktif' : 'status-nonaktif';
                            ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><strong><?= htmlspecialchars($u['nama_lengkap']) ?></strong></td>
                                        <td><?= htmlspecialchars($u['email']) ?></td>
                                        <td><?= htmlspecialchars(ucfirst($u['role_name'])) ?></td>
                                        <td>
                                            <span class="<?= $badgeClass ?>">
                                                <?= htmlspecialchars(ucfirst($u['status_anggota'])) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <?php
                                            // Cek: Jangan tampilkan form jika ID user adalah ID admin yang sedang login
                                            // Pastikan session['user']['user_id'] ada sesuai controller kamu
                                            if ($u['id'] !== $_SESSION['user']['user_id']):
                                            ?> <form action="/update-status" method="POST" style="margin: 0;">
                                                    <input type="hidden" name="user_id" value="<?= $u['id'] ?>">
                                                    <select name="status_baru" class="select-aksi" onchange="this.form.submit()">
                                                        <option value="Aktif" <?= $statusLower === 'aktif' ? 'selected' : '' ?>>Aktif</option>
                                                        <option value="Nonaktif" <?= $statusLower === 'nonaktif' ? 'selected' : '' ?>>Nonaktif</option>
                                                    </select>
                                                <?php endif; ?>
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