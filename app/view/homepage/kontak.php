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
                <!-- PERUBAHAN: Menambahkan event onsubmit untuk menjalankan JavaScript -->
                <form id="contactForm" onsubmit="kirimKeWhatsApp(event)">
                    <!-- PERUBAHAN: Menambahkan atribut 'id' agar datanya bisa diambil -->
                    <input type="text" id="namaPengirim" placeholder="Nama Lengkap" required>
                    <input type="email" id="emailPengirim" placeholder="Email" required>
                    <textarea id="pesanPengirim" rows="6" placeholder="Tulis pesan Anda..." required></textarea>

                    <button type="submit">Kirim Pesan</button>
                </form>
            </div>

            <div class="contact-info">
                <h3>Informasi Klub</h3>
                <p>📍 Krian, Sidoarjo</p>
                <p>📞 0812-3456-7890</p>
                <p>✉  krianswimmingclub@gmail.com</p>
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

    <!-- SCRIPT UNTUK MENGIRIM KE WHATSAPP -->
    <script>
        function kirimKeWhatsApp(event) {
            // Mencegah halaman web melakukan reload
            event.preventDefault();

            let nama = document.getElementById('namaPengirim').value;
            let email = document.getElementById('emailPengirim').value;
            let pesan = document.getElementById('pesanPengirim').value;

            // Pastikan menggunakan format 62 tanpa 0 atau +
            let noWA = "6285806661464";

            let teksPesan = `Halo Admin KSC!%0A%0ASaya ingin bertanya:%0A*Nama:* ${nama}%0A*Email:* ${email}%0A*Pesan:*%0A${pesan}`;

            // Deteksi apakah pengunjung menggunakan HP atau PC/Laptop
            let isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
            let linkWA = "";

            if (isMobile) {
                // Buka aplikasi WA langsung jika di HP
                linkWA = `https://api.whatsapp.com/send?phone=${noWA}&text=${teksPesan}`;
            } else {
                // Paksa buka WA Web jika di Laptop/Linux agar tidak error
                linkWA = `https://web.whatsapp.com/send?phone=${noWA}&text=${teksPesan}`;
            }

            // Buka link di tab baru
            window.open(linkWA, '_blank');
        }
    </script>

    <script src="/app/js/script.js"></script>
</body>

</html>