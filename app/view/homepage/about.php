<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - Krian Swimming Club</title>
    <link rel="stylesheet" href="/app/css/style.css">
</head>

<body>
    <?php include __DIR__ . '/../layouts/navbar.php' ?>
    
    <section class="about-hero">
        <div class="about-overlay">
            <h1>Tentang Krian Swimming Club</h1>
            <p>Membentuk Atlet Berprestasi, Disiplin, dan Berkarakter</p>
        </div>
    </section>

    <section class="history-section">
        <div class="container">
            <h2>Sejarah Klub</h2>
            <p>
                Krian Swimming Club (KSC) didirikan pada tahun 2018
                dengan tujuan mengembangkan olahraga renang di wilayah
                Krian dan sekitarnya.
                Sejak berdiri, KSC telah membina ratusan atlet muda
                dan berhasil meraih berbagai prestasi di tingkat daerah
                maupun nasional.
            </p>
        </div>
    </section>

    <section class="vision-mission">
        <div class="visi-box">
            <h2>Visi</h2>
            <p>Menjadi klub renang unggulan yang menghasilkan atlet berprestasi dan berkarakter.</p>
        </div>
        <div class="misi-box">
            <h2>Misi</h2>
            <ul>
                <li>Membina atlet sejak usia dini</li>
                <li>Menyelenggarakan pelatihan profesional</li>
                <li>Mengikuti kompetisi secara aktif</li>
                <li>Menanamkan sportivitas</li>
            </ul>
        </div>
    </section>

    <section class="achievement-section">
        <h2>Pencapaian Kami</h2>
        
        <div class="achievement-grid">
            <div class="achievement-card">
                <h3><?= htmlspecialchars($atlitAktif) ?></h3>
                <p>Anggota</p>
            </div>
            <div class="achievement-card">
                <h3><?= htmlspecialchars($pelatihAktif) ?></h3>
                <p>Pelatih</p>
            </div>
            <div class="achievement-card">
                <h3>2025</h3>
                <p>Tahun Berdiri</p>
            </div>
        </div>
    </section>

    <section class="why-section">
        <h2>Mengapa Memilih KSC?</h2>
        <div class="why-grid">
            <div class="why-card">
                🏊
                <h3>Pelatih Bersertifikat</h3>
            </div>
            <div class="why-card">
                🏆
                <h3>Prestasi Terbukti</h3>
            </div>
            <div class="why-card">
                ⭐
                <h3>Fasilitas Modern</h3>
            </div>
            <div class="why-card">
                👥
                <h3>Komunitas Aktif</h3>
            </div>
        </div>
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
</body>
</html>