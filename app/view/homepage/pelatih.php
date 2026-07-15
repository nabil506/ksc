<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pelatih - Krian Swimming Club</title>
    <link rel="stylesheet" href="/app/css/style.css">
</head>

<body>
    <?php include __DIR__ . '/../layouts/navbar.php' ?>
    <section class="page-banner">
        <h1>Tim Pelatih</h1>
    </section>

    <section class="coach-page">
        <h2>Pelatih Profesional KSC</h2>

        <div class="coach-grid">
            <?php if (!empty($pelatihAktif)): ?>
                <?php foreach ($pelatihAktif as $pelatih): ?>
                    <div class="coach-profile">

                        <?php if (!empty($pelatih['foto_profile'])): ?>
                            <img src="/app/images/profile/<?= htmlspecialchars($pelatih['foto_profile']) ?>" alt="Coach <?= htmlspecialchars($pelatih['nama_lengkap']) ?>">
                        <?php else: ?>
                            <img src="https://ui-avatars.com/api/?name=<?= urlencode($pelatih['nama_lengkap']) ?>&background=0A4D8C&color=fff&size=150&bold=true" alt="Coach <?= htmlspecialchars($pelatih['nama_lengkap']) ?>">
                        <?php endif; ?>

                        <h3>Coach <?= htmlspecialchars($pelatih['nama_lengkap']) ?></h3>
                        <p>Pelatih KSC</p>
                        <span>🏅 Sertifikasi KSC</span>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div style="grid-column: 1 / -1; text-align: center; color: #718096; padding: 40px;">
                    Belum ada tim pelatih yang terdaftar saat ini.
                </div>
            <?php endif; ?>
        </div>
    </section>

    <section class="coach-schedule">
        <h2>Jadwal Pelatih</h2>
        <table>
            <tr>
                <th>Pelatih</th>
                <th>Hari</th>
                <th>Jam</th>
            </tr>

            <?php if (!empty($jadwalPelatih)): ?>
                <?php foreach ($jadwalPelatih as $jadwal): ?>
                    <tr>
                        <td style="font-weight: 600;">
                            Coach <?= htmlspecialchars($jadwal['nama_pelatih']) ?>
                        </td>
                        <td><?= htmlspecialchars($jadwal['hari']) ?></td>
                        <td><?= htmlspecialchars($jadwal['waktu']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" style="text-align: center; color: #718096; padding: 20px;">
                        Belum ada jadwal pelatih yang terdaftar saat ini.
                    </td>
                </tr>
            <?php endif; ?>

        </table>
    </section>

    <footer class="footer">
        <div class="footer-container">
            <div class="footer-col">
                <h3>Krian Swimming Club</h3>
                <p>Klub renang yang berkomitmen mencetak atlet berprestasi dan meningkatkan kualitas olahraga renang di Kabupaten Sidoarjo.</p>
            </div>
            <div class="footer-col">
                <h3>Menu</h3>
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="/about">Tentang</a></li>
                    <li><a href="/pelatih">Pelatih</a></li>
                    <li><a href="/event">Event</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h3>Kontak</h3>
                <p>📍 Krian, Sidoarjo</p>
                <p>📞 0812-3456-7890</p>
                <p>✉ krianswimmingclub@gmail.com</p>
            </div>
        </div>
        <div class="footer-bottom">
            © 2026 Krian Swimming Club. All Rights Reserved.
        </div>
    </footer>

    <script src="/app/js/script.js"></script>
</body>

</html>