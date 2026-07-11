<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pendaftaran - KSC</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/app/css/style.css">
    <style>
        .dashboard-table-wrap {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            margin-top: 20px;
        }

        .dashboard-table {
            width: 100%;
            border-collapse: collapse;
            font-family: 'Poppins', sans-serif;
        }

        .dashboard-table th {
            background-color: #f7fafc;
            color: #4a5568;
            font-weight: 600;
            padding: 15px;
            text-align: left;
            border-bottom: 2px solid #edf2f7;
            font-size: 0.9rem;
            text-transform: uppercase;
        }

        .dashboard-table td {
            padding: 15px;
            border-bottom: 1px solid #edf2f7;
            color: #2d3748;
            font-size: 0.95rem;
        }

        .dashboard-table tr:hover {
            background-color: #f7fafc;
        }

        .badge-status {
            background: #d1fae5;
            color: #065f46;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
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
                <a href="/dashboard" class="sidebar-link">Beranda</a>
                <a href="/profil" class="sidebar-link">Profil Saya</a>
                <a href="/jadwal" class="sidebar-link">Jadwal Latihan</a>
                <a href="/dashboardevent" class="sidebar-link">Event KSC</a>
                <a href="/riwayat" class="sidebar-link active">Riwayat Pendaftaran</a>

                <?php if (strtolower($role_name) === 'admin'): ?>
                    <a href="/manage-users" class="sidebar-link" style="color: #3182ce; font-weight: 600;">⚙️ Manajemen User</a>
                <?php endif; ?>

                <span class="nav-separator"></span>
                <a href="/logout" class="logout-link">Logout</a>
            </nav>
        </aside>

        <main class="dashboard-main">
            <section class="tab-content active">
                <div class="tab-heading">
                    <?php if (strtolower($role_name) === 'admin'): ?>
                        <h1>Data Pendaftar Event</h1>
                        <p>Daftar seluruh atlit yang telah mendaftar ke event KSC.</p>
                    <?php else: ?>
                        <h1>Riwayat Pendaftaran</h1>
                        <p>Semua event yang pernah kamu daftarkan.</p>
                    <?php endif; ?>
                </div>

                <div class="dashboard-table-wrap">
                    <table class="dashboard-table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Atlet</th>
                                <th>Event</th>
                                <th>Tanggal Daftar</th>
                                <th>Status Event</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($riwayat)): ?>
                                <tr>
                                    <td colspan="5" style="text-align:center; padding: 30px; color: #718096;">
                                        <?php if (strtolower($role_name) === 'admin'): ?>
                                            Belum ada atlit yang mendaftar pada event apa pun.
                                        <?php else: ?>
                                            Belum ada riwayat pendaftaran.<br>
                                            <a href="/dashboardevent" style="color: #3182ce; font-weight: 600; text-decoration: none; margin-top: 10px; display: inline-block;">Lihat Event yang Tersedia</a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($riwayat as $index => $row): ?>
                                    <tr>
                                        <td><?= $index + 1 ?></td>

                                        <td style="font-weight: 500; text-transform: capitalize;">
                                            <?= htmlspecialchars($row['nama_atlet']) ?>
                                        </td>

                                        <td><?= htmlspecialchars($row['nama_event']) ?></td>
                                        <td><?= date('d M Y, H:i', strtotime($row['tanggal_daftar'])) ?></td>
                                        <td>
                                            <span class="badge-status">
                                                <?= htmlspecialchars($row['status_event'] ?? 'Terdaftar') ?>
                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>
</body>

</html>