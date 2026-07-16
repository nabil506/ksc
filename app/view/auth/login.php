<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Anggota - Krian Swimming Club</title>
    <link rel="stylesheet" href="/app/css/style.css">
</head>

<body>
    <section class="auth-page">
        <div class="auth-box">
            <h2>Login Anggota</h2>

            <?php if (isset($_SESSION['flash_error'])): ?>
                <div class="alert alert-danger"
                    style="background-color: #ffe3e3; color: #e53e3e; padding: 12px; border-radius: 8px; margin-bottom: 20px; text-align: left; border-left: 5px solid #e53e3e; font-size: 14px;">
                    ❌ <?= $_SESSION['flash_error']; ?>
                </div>
                <?php unset($_SESSION['flash_error']); // Hapus setelah ditampilkan 
                ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['flash_sukses'])): ?>
                <div class="alert alert-success"
                    style="background-color: #e6fffa; color: #319795; padding: 12px; border-radius: 8px; margin-bottom: 20px; text-align: left; border-left: 5px solid #319795; font-size: 14px;">
                    🚀 <?= $_SESSION['flash_sukses']; ?>
                </div>
                <?php unset($_SESSION['flash_sukses']); // Hapus setelah ditampilkan 
                ?>
            <?php endif; ?>

            <form id="loginForm" action="/proses-login" method="POST">
                <input type="text" name="email" placeholder="Email atau Nama Lengkap" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" name="submit">Masuk</button>
            </form>

            <p style="margin-top: 15px; margin-bottom: 5px;">
                Lupa password?
                <a href="/lupa-password">Reset di sini</a>
            </p>

            <p>
                Belum punya akun?
                <a href="/register">Daftar Sekarang</a>
            </p>
            <p>
                Kembali ke
                <a href="/">beranda</a>
            </p>
        </div>
    </section>

    <script src="/app/js/script.js"></script>
</body>

</html>