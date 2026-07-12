<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Krian Swimming Club</title>
    <link rel="stylesheet" href="/app/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<body>
    <?php include __DIR__ . '/../layouts/navbar.php' ?>

    <section class="hero">
        <div class="overlay"></div>
        <div class="hero-content">
            <span class="welcome">SELAMAT DATANG DI</span>
            <h1>
                KRIAN <br>
                SWIMMING CLUB
            </h1>
            <p>
                Tempat terbaik untuk belajar berenang,
                meningkatkan kebugaran, dan meraih prestasi.
            </p>
            <div class="quote">
                "Muridku adalah prioritasku, latihanku adalah ibadahku."
            </div>
        </div>
    </section>

    <section class="stats">
        <div class="stat-card">
            <h2><?= htmlspecialchars($atlitAktif) ?></h2>
            <p>Anggota Aktif</p>
        </div>
        <div class="stat-card">
            <h2><?= htmlspecialchars($pelatihAktif) ?></h2>
            <p>Pelatih Profesional</p>
        </div>
        <div class="stat-card">
            <h2>2025</h2>
            <p>Tahun Berdiri</p>
        </div>
    </section>

    <section class="about">
        <div class="about-image">
            <img src="https://images.unsplash.com/photo-1600965962102-9d260a71890d?w=800" alt="KSC Pool">
        </div>
        <div class="about-content">
            <span>TENTANG KAMI</span>
            <h2>Krian Swimming Club</h2>
            <p>
                Krian Swimming Club adalah klub renang yang berfokus
                pada pembinaan atlet dan masyarakat umum untuk
                meningkatkan kemampuan berenang, kesehatan,
                dan prestasi olahraga.
            </p>
            <p>
                Kami menyediakan program latihan untuk anak-anak,
                remaja, dan dewasa dengan pelatih yang berpengalaman.
            </p>
        </div>
    </section>

    <section class="coach">
        <h2>Tim Pelatih</h2>
        <div class="coach-container">
            <?php if (!empty($pelatihList)): ?>
                <?php foreach ($pelatihList as $p): ?>
                    <div class="coach-card">
                        <img src="https://ui-avatars.com/api/?name=<?= urlencode($p['nama_lengkap']) ?>&background=0A4D8C&color=fff&size=150&bold=true" alt="Foto <?= htmlspecialchars($p['nama_lengkap']) ?>">
                        <h3><?= htmlspecialchars($p['nama_lengkap']) ?></h3>
                        <p>Pelatih KSC</p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div style="width: 100%; text-align: center; color: #718096; padding: 20px;">
                    <p>Belum ada pelatih yang terdaftar.</p>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <section class="event-section">
        <div class="section-title">
            <h2>Agenda Kompetisi</h2>
            <p>Jangan lewatkan kesempatan untuk bersinar.</p>
        </div>
        <div class="event-container">
            <?php
            if (!empty($events)):
                $today = strtotime(date('Y-m-d'));
                foreach ($events as $event):
                    $eventDate = strtotime($event['tanggal_event']);
                    $isExpired = ($today > $eventDate);

                    $statusBadge = $isExpired ? 'SELESAI' : 'UPCOMING';
                    $badgeBg = $isExpired ? '#edf2f7' : '#ebf4ff';
                    $badgeColor = $isExpired ? '#718096' : '#3182ce';
            ?>
                    <div class="event-card">
                        <img src="https://images.unsplash.com/photo-1519315901367-f34ff9154487?w=1000" alt="Event KSC">
                        <div class="event-info">
                            <span class="badge" style="background: <?= $badgeBg ?>; color: <?= $badgeColor ?>; padding: 4px 10px; border-radius: 6px; font-size: 0.75rem; font-weight: 700; margin-bottom: 10px; display: inline-block; text-transform: uppercase;">
                                <?= $statusBadge ?>
                            </span>
                            <h3 style="margin-top: 5px;"><?= htmlspecialchars($event['nama_event']) ?></h3>
                            <p>📅 <?= date('d M Y', $eventDate) ?></p>
                            <p>📍 <?= htmlspecialchars($event['lokasi']) ?></p>
                            <a href="/login" style="text-decoration: none;">
                                <button style="cursor: pointer; width: 100%; margin-top: 10px;">Daftar / Detail</button>
                            </a>
                        </div>
                    </div>
                <?php
                endforeach;
            else:
                ?>
                <div style="width: 100%; text-align: center; padding: 40px; color: #718096;">
                    <p>Belum ada agenda kompetisi saat ini. Nantikan info selanjutnya!</p>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <section class="gallery">
        <div class="section-title">
            <h2>Galeri Kegiatan</h2>
            <p>Momen terbaik Krian Swimming Club</p>
        </div>
        <div class="gallery-grid">
            <img src="https://images.unsplash.com/photo-1530549387789-4c1017266635?w=800">
            <img src="https://images.unsplash.com/photo-1560089000-7433a4ebbd64?w=800">
            <img src="https://images.unsplash.com/photo-1517836357463-d25dfeac3438?w=800">
            <img src="https://images.unsplash.com/photo-1526506118085-60ce8714f8c5?w=800">
        </div>
    </section>

    <section class="stats-section">
        <h2>Statistik Krian Swimming Club</h2>
        
        <div class="stats-grid">
            <div class="stat-box">
                <h3 class="counter"><?= htmlspecialchars($atlitAktif) ?></h3>
                <p>Atlit Aktif</p>
            </div>
            <div class="stat-box">
                <h3 class="counter" data-target="<?= $pelatihAktif ?>"><?= htmlspecialchars($pelatihAktif) ?></h3>
                <p>Pelatih Aktif</p>
            </div>
            <div class="stat-box">
                <h3 class="counter">2025</h3>
                <p>Tahun Berdiri</p>
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