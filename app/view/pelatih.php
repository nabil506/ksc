<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pelatih - Krian Swimming Club</title>
    <link rel="stylesheet" href="/app/css/style.css">
</head>

<body>

    <header>
        <nav class="navbar">
            <div class="logo">
                <img src="/app/images/logo renang 2.jpg" alt="KSC Logo">
            </div>

            <ul class="nav-links">
                <li><a href="/">Home</a></li>
                <li><a href="/about">Tentang Kami</a></li>
                <li><a href="/pelatih" class="active">Pelatih</a></li>
                <li><a href="/event">Event</a></li>
                <li><a href="/galeri">Galeri</a></li>
                <li><a href="/fasilitas">Fasilitas</a></li>
                <li><a href="/kontak">Kontak</a></li>
            </ul>

            <div class="menu-toggle">☰</div>

            <button id="darkModeToggle" class="dark-btn">🌙</button>

            <div class="auth-buttons">
                <a href="/login" class="login-btn">Masuk</a>
                <a href="/register" class="register-btn">Daftar</a>
            </div>
        </nav>
    </header>

    <section class="page-banner">
        <h1>Tim Pelatih</h1>
    </section>

    <section class="coach-page">
        <h2>Pelatih Profesional KSC</h2>
        <div class="coach-grid">
            <div class="coach-profile">
                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Coach Andi">
                <h3>Coach Andi Pratama</h3>
                <p>Pelatih Renang Dasar</p>
                <span>🏅 Sertifikasi PRSI</span>
            </div>
            <div class="coach-profile">
                <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Coach Rina">
                <h3>Coach Rina Putri</h3>
                <p>Pelatih Prestasi</p>
                <span>🏅 Nasional Swimming Coach</span>
            </div>
            <div class="coach-profile">
                <img src="https://randomuser.me/api/portraits/men/68.jpg" alt="Coach Budi">
                <h3>Coach Budi Santoso</h3>
                <p>Pelatih Fisik</p>
                <span>🏅 Strength & Conditioning</span>
            </div>
            <div class="coach-profile">
                <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="Coach Dinda">
                <h3>Coach Dinda Larasati</h3>
                <p>Pelatih Kelompok Umur</p>
                <span>🏅 Youth Swimming Coach</span>
            </div>
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
            <tr>
                <td>Coach Andi</td>
                <td>Senin - Rabu</td>
                <td>15.00 - 17.00</td>
            </tr>
            <tr>
                <td>Coach Rina</td>
                <td>Selasa - Kamis</td>
                <td>16.00 - 18.00</td>
            </tr>
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