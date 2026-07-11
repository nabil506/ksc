<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak - Krian Swimming Club</title>
    <link rel="stylesheet" href="/app/css/style.css">
</head>

<body>
<?php include __DIR__ . '/../layouts/navbar.php' ?>
    <section class="contact-section">
        <h1>Hubungi Kami</h1>
        <p class="contact-subtitle">
            Kami siap membantu dan menjawab pertanyaan Anda.
        </p>

        <div class="contact-container">
            <div class="contact-form">
                <form id="contactForm">
                    <input type="text" placeholder="Nama Lengkap" required>
                    <input type="email" placeholder="Email" required>
                    <textarea rows="6" placeholder="Tulis pesan Anda..." required></textarea>
                    <button type="submit">Kirim Pesan</button>
                </form>
            </div>

            <div class="contact-info">
                <h3>Informasi Klub</h3>
                <p>📍 Krian, Sidoarjo</p>
                <p>📞 0812-3456-7890</p>
                <p>✉ info@krianswimmingclub.com</p>
                <p>🕒 Senin - Sabtu</p>
                <p>07.00 - 18.00 WIB</p>
            </div>
        </div>

        <div class="map-container">
            <iframe src="https://www.google.com/maps?q=Krian,Sidoarjo&output=embed" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </section>

    <footer class="footer">
        <div class="footer-bottom">
            © 2026 Krian Swimming Club
        </div>
    </footer>

    <script src="/app/js/script.js"></script>
</body>
</html>