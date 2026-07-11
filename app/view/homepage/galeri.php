<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri - Krian Swimming Club</title>
    <link rel="stylesheet" href="/app/css/style.css">
</head>

<body>
<?php include __DIR__ . '/../layouts/navbar.php' ?>

    <section class="page-banner">
        <h1>Galeri Kegiatan</h1>
    </section>

    <section class="gallery-page">
        <h2>Dokumentasi Krian Swimming Club</h2>
        <div class="filter-buttons">
            <button onclick="filterGallery('all')">Semua</button>
            <button onclick="filterGallery('latihan')">Latihan</button>
            <button onclick="filterGallery('kompetisi')">Kompetisi</button>
            <button onclick="filterGallery('prestasi')">Prestasi</button>
        </div>

        <div class="gallery-container">
            <div class="gallery-item latihan">
                <img src="https://images.unsplash.com/photo-1530549387789-4c1017266635?w=1000" alt="Latihan">
            </div>
            <div class="gallery-item kompetisi">
                <img src="https://images.unsplash.com/photo-1560090995-01632a28895b?w=1000" alt="Kompetisi">
            </div>
            <div class="gallery-item prestasi">
                <img src="https://images.unsplash.com/photo-1517836357463-d25dfeac3438?w=1000" alt="Prestasi">
            </div>
            <div class="gallery-item latihan">
                <img src="https://images.unsplash.com/photo-1600965962102-9d260a71890d?w=1000" alt="Latihan">
            </div>
            <div class="gallery-item kompetisi">
                <img src="https://images.unsplash.com/photo-1519315901367-f34ff9154487?w=1000" alt="Kompetisi">
            </div>
            <div class="gallery-item prestasi">
                <img src="https://images.unsplash.com/photo-1526506118085-60ce8714f8c5?w=1000" alt="Prestasi">
            </div>
        </div>
    </section>

    <div id="lightbox">
        <img id="lightbox-img" alt="">
    </div>

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
                <p>✉ info@ksc.com</p>
            </div>
        </div>
        <div class="footer-bottom">
            © 2026 Krian Swimming Club. All Rights Reserved.
        </div>
    </footer>

    <script src="/app/js/script.js"></script>
</body>
</html>