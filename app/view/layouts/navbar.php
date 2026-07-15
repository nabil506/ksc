    <header>

        <nav class="navbar">

            <div class="logo">
                <img src="/app/images/profilerenang/logo renang 2.jpg" alt="KSC Logo">
            </div>

            <ul class="nav-links">

                <li><a class="<?= $_SERVER['REQUEST_URI'] == '/' ? 'active' : '' ?>" href="/">Home</a></li>

                <li><a class="<?= $_SERVER['REQUEST_URI'] == '/about' ? 'active' : '' ?>" href="/about">Tentang Kami</a></li>

                <li><a class="<?= $_SERVER['REQUEST_URI'] == '/pelatih' ? 'active' : '' ?>" href="/pelatih">Pelatih</a></li>

                <li><a class="<?= $_SERVER['REQUEST_URI'] == '/event' ? 'active' : '' ?>" href="/event">Event</a></li>

                <li><a class="<?= $_SERVER['REQUEST_URI'] == '/galeri' ? 'active' : '' ?>" href="/galeri">Galeri</a></li>

                <li><a class="<?= $_SERVER['REQUEST_URI'] == '/fasilitas' ? 'active' : '' ?>" href="/fasilitas">Fasilitas</a></li>

                <li><a class="<?= $_SERVER['REQUEST_URI'] == '/kontak' ? 'active' : '' ?>" href="/kontak">Kontak</a></li>

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

    <script src="/app/js/script.js"></script>