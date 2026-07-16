<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Password Baru - Krian Swimming Club</title>
    <link rel="stylesheet" href="/app/css/style.css">
</head>
<body>
    <section class="auth-page">
        <div class="auth-box">
            <h2>Buat Password Baru</h2>
            <p style="margin-bottom: 20px; font-size: 14px; color: #cbd5e0;">
                Silakan buat password baru untuk akun Anda. Gunakan kombinasi yang kuat dan mudah diingat.
            </p>

            <?php if (isset($_SESSION['flash_error'])): ?>
                <div class="alert alert-danger" style="background-color: #ffe3e3; color: #e53e3e; padding: 12px; border-radius: 8px; margin-bottom: 20px; text-align: left; border-left: 5px solid #e53e3e; font-size: 14px;">
                    ❌ <?= $_SESSION['flash_error']; unset($_SESSION['flash_error']); ?>
                </div>
            <?php endif; ?>

            <form action="/proses-reset-password" method="POST">
                <input type="password" name="password" placeholder="Password Baru (Min. 6 Karakter)" required>
                <input type="password" name="confirm_password" placeholder="Konfirmasi Password Baru" required>
                <button type="submit" name="submit">Simpan Password Baru</button>
            </form>
        </div>
    </section>
</body>
</html>