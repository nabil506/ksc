<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event - Krian Swimming Club</title>
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
                <li><a href="/pelatih">Pelatih</a></li>
                <li><a href="/event" class="active">Event</a></li>
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
        <h1>Agenda Kompetisi</h1>
    </section>

    <section class="event-page">
        <h2>Event Mendatang</h2>
        <div class="event-grid">
            <div class="event-item">
                <img src="https://images.unsplash.com/photo-1519315901367-f34ff9154487?w=1000" alt="KSC National Cup">
                <div class="event-body">
                    <h3>KSC National Cup 2026</h3>
                    <p>📅 30 Juni 2026</p>
                    <p>📍 Kolam Renang Krian</p>
                    <div id="countdown"></div>
                    <button class="register-event-btn" onclick="openEventForm()">Daftar Event</button>
                </div>
            </div>
            <div class="event-item">
                <img src="https://images.unsplash.com/photo-1560090995-01632a28895b?w=1000" alt="Liga Renang">
                <div class="event-body">
                    <h3>Liga Renang Jawa Timur</h3>
                    <p>📅 15 Juli 2026</p>
                    <p>📍 Surabaya</p>
                    <button class="register-event-btn" onclick="openEventForm()">Daftar Event</button>
                </div>
            </div>
        </div>
    </section>

    <section class="calendar-event">
        <h2>Kalender Kompetisi 2026</h2>
        <table>
            <tr>
                <th>Bulan</th>
                <th>Kegiatan</th>
            </tr>
            <tr>
                <td>Juni</td>
                <td>KSC National Cup</td>
            </tr>
            <tr>
                <td>Juli</td>
                <td>Liga Renang Jawa Timur</td>
            </tr>
            <tr>
                <td>Agustus</td>
                <td>Kejurkab Renang</td>
            </tr>
        </table>
    </section>

    <div id="eventModal" class="event-modal">
        <div class="event-modal-content">
            <span class="close-modal" onclick="closeEventForm()">×</span>
            <h2>Pendaftaran Atlet</h2>
            <form id="eventForm">
                <input type="text" id="namaAtlet" placeholder="Nama Atlet" required>
                <input type="number" id="umurAtlet" placeholder="Umur" required>
                <input type="text" id="waAtlet" placeholder="Nomor WhatsApp" required>
                <select id="kategori">
                    <option>50m Gaya Bebas</option>
                    <option>100m Gaya Bebas</option>
                    <option>200m Gaya Dada</option>
                    <option>4x100 Relay</option>
                </select>
                <button type="submit">Kirim Pendaftaran</button>
            </form>
        </div>
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