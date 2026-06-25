<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Krian Swimming Club</title>

    <link rel="stylesheet" href="/app/css/style.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
</head>

<body>

    <header>

        <nav class="navbar">

            <div class="logo">
                <img src="/app/images/logo renang 2.jpg" alt="KSC Logo">
            </div>

            <ul class="nav-links">

                <li><a href="/" class="active">Home</a></li>

                <li><a href="/about">Tentang Kami</a></li>

                <li><a href="/pelatih">Pelatih</a></li>

                <li><a href="/event">Event</a></li>

                <li><a href="/galeri">Galeri</a></li>

                <li><a href="/fasilitas">Fasilitas</a></li>

                <li><a href="/kontak">Kontak</a></li>

            </ul>

            <div class="menu-toggle">

                ☰

            </div>

            <button id="darkModeToggle" class="dark-btn">
                🌙
            </button>

            <div class="auth-buttons">

                <a href="/login" class="login-btn">
                    Masuk
                </a>

                <a href="/register" class="register-btn">
                    Daftar
                </a>

            </div>

        </nav>

    </header>

    <section class="hero">

        <div class="overlay"></div>

        <div class="hero-content">

            <span class="welcome">
                SELAMAT DATANG DI
            </span>

            <h1>
                KRIAN <br>
                SWIMMING CLUB
            </h1>

            <p>
                Tempat terbaik untuk belajar berenang,
                meningkatkan kebugaran, dan meraih prestasi.
            </p>

            <div class="quote">
                "Muridku adalah prioritasku,
                latihanku adalah ibadahku."
            </div>

        </div>

    </section>

    <section class="stats">

        <div class="stat-card">
            <h2>150+</h2>
            <p>Anggota Aktif</p>
        </div>

        <div class="stat-card">
            <h2>10</h2>
            <p>Pelatih Profesional</p>
        </div>

        <div class="stat-card">
            <h2>25</h2>
            <p>Kejuaraan</p>
        </div>

        <div class="stat-card">
            <h2>5</h2>
            <p>Tahun Berdiri</p>
        </div>

    </section>

    <section class="about hidden">

        <div class="about-image">
            <img src="https://images.unsplash.com/photo-1600965962102-9d260a71890d?w=800" alt="">
        </div>

        <div class="about-content">

            <span>TENTANG KAMI</span>

            <h2>
                Krian Swimming Club
            </h2>

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

    <section class="coach hidden">

        <h2>Tim Pelatih</h2>

        <div class="coach-container">

            <div class="coach-card">

                <img src="https://randomuser.me/api/portraits/men/32.jpg">

                <h3>Coach Andi</h3>

                <p>Pelatih Renang Dasar</p>

            </div>

            <div class="coach-card">

                <img src="https://randomuser.me/api/portraits/women/44.jpg">

                <h3>Coach Rina</h3>

                <p>Pelatih Prestasi</p>

            </div>

            <div class="coach-card">

                <img src="https://randomuser.me/api/portraits/men/68.jpg">

                <h3>Coach Budi</h3>

                <p>Pelatih Fisik</p>

            </div>

        </div>

    </section>

    <section class="event-section hidden">

        <div class="section-title">
            <h2>Agenda Kompetisi</h2>
            <p>Jangan lewatkan kesempatan untuk bersinar.</p>
        </div>

        <div class="event-container">

            <div class="event-card">

                <img src="https://images.unsplash.com/photo-1519315901367-f34ff9154487?w=1000" alt="">

                <div class="event-info">

                    <span class="badge">BERJALAN</span>

                    <h3>KSC National Cup 2026</h3>

                    <p>📅 30 Mei 2026</p>
                    <p>🕒 08:00 WIB</p>
                    <p>📍 Kolam Renang Krian</p>

                    <button>Lihat Detail</button>

                </div>

            </div>

            <div class="event-card">

                <img src="https://images.unsplash.com/photo-1560090995-01632a28895b?w=1000" alt="">

                <div class="event-info">

                    <span class="badge">BERJALAN</span>

                    <h3>Liga Renang KSC 2026</h3>

                    <p>📅 31 Mei 2026</p>
                    <p>🕒 08:00 WIB</p>
                    <p>📍 Kraton Waterpark Krian</p>

                    <button>Lihat Detail</button>

                </div>

            </div>

        </div>

    </section>

    <section class="gallery hidden">

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

    <section class="stats-section hidden">

        <h2>Statistik Krian Swimming Club</h2>

        <div class="stats-grid">

            <div class="stat-box">

                <h3 class="counter" data-target="150">
                    0
                </h3>

                <p>Anggota Aktif</p>

            </div>

            <div class="stat-box">

                <h3 class="counter" data-target="25">
                    0
                </h3>

                <p>Kejuaraan</p>

            </div>

            <div class="stat-box">

                <h3 class="counter" data-target="12">
                    0
                </h3>

                <p>Pelatih</p>

            </div>

            <div class="stat-box">

                <h3 class="counter" data-target="8">
                    0
                </h3>

                <p>Tahun Berdiri</p>

            </div>

        </div>

    </section>

    <footer class="footer">

        <div class="footer-container">

            <div class="footer-col">

                <h3>Krian Swimming Club</h3>

                <p>
                    Klub renang yang berkomitmen
                    mencetak atlet berprestasi dan
                    meningkatkan kualitas olahraga
                    renang di Kabupaten Sidoarjo.
                </p>

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

            © 2026 Krian Swimming Club.
            All Rights Reserved.

        </div>

    </footer>

    <script src="/app/js/script.js"></script>


</body>

</html>