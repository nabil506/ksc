<!DOCTYPE html>

<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Profil Saya - Krian Swimming Club</title>

    <link rel="stylesheet" href="/app/css/style.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        .profile-form-container {
            background: #fff;
            padding: 25px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            margin-top: 20px;
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #4a5568;
            font-size: 14px;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #cbd5e0;
            border-radius: 8px;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        .form-group input:focus {
            border-color: #0A4D8C;
            outline: none;
            box-shadow: 0 0 0 3px rgba(10, 77, 140, 0.1);
        }

        .form-group input:disabled {
            background-color: #edf2f7;
            cursor: not-allowed;
            color: #a0aec0;
        }

        .btn-update {
            background-color: #0A4D8C;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            width: 100%;
            font-family: 'Poppins', sans-serif;
            transition: 0.3s;
        }

        .btn-update:hover {
            background-color: #083b6b;
            transform: translateY(-2px);
        }

        .status-active {
            background-color: #d1fae5;
            color: #065f46;
            padding: 4px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 12px;
        }

        .status-inactive {
            background-color: #fee2e2;
            color: #991b1b;
            padding: 4px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 12px;
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

                <a href="/profil" class="sidebar-link active">Profil Saya</a>

                <a href="/jadwal" class="sidebar-link">Jadwal Latihan</a>

                <a href="/dashboardevent" class="sidebar-link">Event KSC</a>

                <a href="/riwayat" class="sidebar-link">Riwayat Pendaftaran</a>



                <?php if (strtolower($role_name) === 'admin'): ?>

                    <a href="/manage-users" class="sidebar-link" style="color: #3182ce; font-weight: 600;">⚙️ Manajemen User</a>

                <?php endif; ?>



                <span class="nav-separator"></span>

                <a href="/logout" class="logout-link">Logout</a>

            </nav>

        </aside>



        <main class="dashboard-main">

            <section class="tab-content active" id="tab-profil">

                <div class="tab-heading">

                    <h1>Profil Saya</h1>

                    <p>Perbarui informasi biodata personal kamu untuk keperluan administrasi KSC.</p>

                </div>



                <?php if (isset($_SESSION['flash_error'])): ?>

                    <div class="alert alert-danger" style="background-color: #ffe3e3; color: #e53e3e; padding: 12px; border-radius: 8px; margin-bottom: 20px; border-left: 5px solid #e53e3e; font-size: 14px;">

                        ❌ <?= $_SESSION['flash_error'];
                            unset($_SESSION['flash_error']); ?>

                    </div>

                <?php endif; ?>



                <?php if (isset($_SESSION['flash_sukses'])): ?>

                    <div class="alert alert-success" style="background-color: #e6fffa; color: #319795; padding: 12px; border-radius: 8px; margin-bottom: 20px; border-left: 5px solid #319795; font-size: 14px;">

                        ✅ <?= $_SESSION['flash_sukses'];
                            unset($_SESSION['flash_sukses']); ?>

                    </div>

                <?php endif; ?>



                <div class="profile-panel">

                    <!-- FORM KHUSUS UPLOAD FOTO PROFIL -->
                    <form action="/update-profile" method="POST" enctype="multipart/form-data" id="formAvatar">
                        <label class="profile-avatar-container" title="Klik untuk ubah foto">

                            <?php
                            // Cek apakah user sudah punya foto profil di session
                            $fotoProfile = $_SESSION['user']['foto_profile'] ?? null;
                            ?>

                            <?php if (!empty($fotoProfile)): ?>
                                <!-- Jika ada foto, tampilkan fotonya -->
                                <img src="/app/images/profile/<?= htmlspecialchars($fotoProfile) ?>" alt="Foto Profile"> <?php else: ?>
                                <!-- Jika belum ada, tampilkan inisial nama -->
                                <div class="profile-avatar-big"><?= htmlspecialchars($initials) ?></div>
                            <?php endif; ?>

                            <div class="avatar-overlay">📷 Upload Image</div>

                            <!-- Input file disembunyikan. Saat gambar dipilih, form langsung dikirim (onchange) -->
                            <input type="file" name="foto_profile" accept="image/png, image/jpeg, image/jpg" style="display: none;" onchange="document.getElementById('formAvatar').submit();">

                        </label>
                    </form>
                    <div class="profile-grid">

                        <div class="profile-item">

                            <label>Nama Lengkap</label>

                            <span><?= htmlspecialchars($nama_lengkap) ?></span>

                        </div>

                        <div class="profile-item">

                            <label>Email Akun</label>

                            <span><?= htmlspecialchars($email) ?></span>

                        </div>

                        <div class="profile-item">

                            <label>Umur</label>

                            <span><?= !empty($umur) ? htmlspecialchars($umur) . ' Tahun' : '-' ?></span>

                        </div>

                        <div class="profile-item">

                            <label>Nomor WhatsApp</label>

                            <span><?= !empty($no_wa) ? htmlspecialchars($no_wa) : '-' ?></span>

                        </div>
                        <div class="profile-item">

                            <label>Hak Akses</label>

                            <span class="badge-role"><?= htmlspecialchars(ucfirst($role_name)) ?></span>

                        </div>



                        <!-- Status Anggota di profil disembunyikan untuk Admin -->

                        <?php if (strtolower($role_name) !== 'admin'): ?>

                            <div class="profile-item">

                                <label>Status Anggota</label>

                                <span class="<?= $badgeClass ?>"><?= htmlspecialchars(ucfirst($status_anggota)) ?></span>

                            </div>

                        <?php endif; ?>



                        <div class="profile-item">

                            <label>Klub Utama</label>

                            <span>Krian Swimming Club</span>

                        </div>

                    </div>

                </div>


                <?php if (strtolower($role_name) !== 'admin'): ?>
                    <div class="profile-form-container">

                        <h3>Edit Data Biodata</h3>

                        <hr style="border: 0; border-top: 1px solid #e2e8f0; margin: 15px 0;">

                        <form action="/update-profile" method="POST">

                            <div class="form-group">

                                <label for="umur">Umur (Tahun)</label>

                                <input type="number" id="umur" name="umur" value="" placeholder="Isi umur Anda di sini">

                            </div>

                            <div class="form-group">

                                <label for="noWa">Nomor WhatsApp</label>

                                <input type="tel" id="noWa" name="no_wa" value="" placeholder="Isi nomor handphone/WA aktif Anda">

                            </div>
                            <button type="submit" class="btn-update">Simpan Perubahan</button>

                        </form>
                    <?php endif; ?>

                    </div>

            </section>

        </main>

    </div>

    <script src="/app/js/dashboard.js"></script>

</body>

</html>