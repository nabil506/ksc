<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Atlit - Krian Swimming Club</title>
    <link rel="stylesheet" href="/app/css/style.css">
</head>
<body>
    <section class="auth-page">
        <div class="auth-box">
            <h2>Daftar Calon Atlit KSC</h2>

            <?php if (isset($_SESSION['flash_error'])): ?>
                <div class="alert alert-danger" style="background-color: #ffe3e3; color: #e53e3e; padding: 12px; border-radius: 8px; margin-bottom: 20px; font-size: 14px; text-align: left; border-left: 5px solid #e53e3e;">
                    ❌ <?= $_SESSION['flash_error']; unset($_SESSION['flash_error']); ?>
                </div>
            <?php endif; ?>

            <form id="registerForm" action="/proses-register" method="POST">
                <input type="text" name="nama" placeholder="Nama Lengkap Anak/Atlit" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="password" name="confirm_password" placeholder="Konfirmasi Password" required>
                <button type="submit">Daftar Sekarang</button>
            </form>

            <p>Sudah punya akun? <a href="/login">Login di sini</a></p>
        </div>
    </section>
</body>
</html>