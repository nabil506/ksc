<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event - Krian Swimming Club</title>
    <link rel="stylesheet" href="/app/css/style.css">
</head>

<body>
    <?php include __DIR__ . '/../layouts/navbar.php' ?>
    <section class="page-banner">
        <h1>Agenda Kompetisi</h1>
    </section>

    <section class="event-page">
        <h2>Event Mendatang</h2>
        <div class="event-grid">

            <?php if (!empty($allevent)): ?>
                <?php foreach ($allevent as $event):
                    // Logika Pengecekan Tanggal Event
                    $eventDate = strtotime($event['tanggal_event']);
                    $isExpired = ($today > $eventDate);
                ?>
                    <div class="event-item">

                        <img src="https://images.unsplash.com/photo-1519315901367-f34ff9154487?w=1000" alt="<?= htmlspecialchars($event['nama_event']) ?>">

                        <div class="event-body">
                            <h3><?= htmlspecialchars($event['nama_event']) ?></h3>
                            <p>📅 <?= date('d F Y', $eventDate) ?></p>
                            <p>📍 <?= htmlspecialchars($event['lokasi']) ?></p>

                            <div id="countdown-<?= $event['id'] ?>"></div>

                            <?php if ($isExpired): ?>
                                <button class="register-event-btn" style="background: #e2e8f0; color: #a0aec0; cursor: not-allowed;" disabled>Pendaftaran Ditutup</button>
                            <?php else: ?>
                                <button class="register-event-btn" onclick="window.location.href='/login'">Daftar Event</button>
                            <?php endif; ?>

                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>

                <div style="grid-column: 1 / -1; text-align: center; color: #718096; padding: 40px;">
                    Belum ada event mendatang saat ini.
                </div>

            <?php endif; ?>

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

    <script src="/app/js/script.js"></script>
</body>

</html>