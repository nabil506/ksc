<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - Krian Swimming Club</title>
    <link rel="stylesheet" href="/app/css/style.css">
</head>

<body>
    <section class="auth-page">
        <div class="auth-box">
            <h2>Lupa Password</h2>
            <p style="margin-bottom: 20px; font-size: 14px; color: #cbd5e0;">
                Masukkan email yang terdaftar pada akun Anda. Kami akan mengirimkan 6 digit kode OTP untuk mereset password.
            </p>

            <?php if (isset($_SESSION['flash_error'])): ?>
                <div class="alert alert-danger" style="background-color: #ffe3e3; color: #e53e3e; padding: 12px; border-radius: 8px; margin-bottom: 20px; text-align: left; border-left: 5px solid #e53e3e; font-size: 14px;">
                    ❌ <?= $_SESSION['flash_error'];
                        unset($_SESSION['flash_error']); ?>
                </div>
            <?php endif; ?>

            <form action="/proses-lupa-password" method="POST">
                <input type="email" name="email" placeholder="Masukkan Email Anda" required>
                <button type="submit" name="submit">Kirim Kode OTP</button>
            </form>

            <p style="margin-top: 20px;">
                Ingat password Anda?
                <a href="/login">Kembali ke Login</a>
            </p>
        </div>
    </section>
</body>

</html>