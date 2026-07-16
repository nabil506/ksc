<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP - Krian Swimming Club</title>
    <link rel="stylesheet" href="/app/css/style.css">
</head>
<body>
    <section class="auth-page">
        <div class="auth-box">
            <h2>Verifikasi Kode OTP</h2>
            <p style="margin-bottom: 20px; font-size: 14px; color: #cbd5e0;">
                Kode 6 digit telah dikirim ke email <b><?= htmlspecialchars($email) ?></b>. Silakan masukkan kode tersebut di bawah ini.
            </p>

            <?php if (isset($_SESSION['flash_error'])): ?>
                <div class="alert alert-danger" style="background-color: #ffe3e3; color: #e53e3e; padding: 12px; border-radius: 8px; margin-bottom: 20px; text-align: left; border-left: 5px solid #e53e3e; font-size: 14px;">
                    ❌ <?= $_SESSION['flash_error']; unset($_SESSION['flash_error']); ?>
                </div>
            <?php endif; ?>
            <?php if (isset($_SESSION['flash_sukses'])): ?>
                <div class="alert alert-success" style="background-color: #e6fffa; color: #319795; padding: 12px; border-radius: 8px; margin-bottom: 20px; text-align: left; border-left: 5px solid #319795; font-size: 14px;">
                    ✅ <?= $_SESSION['flash_sukses']; unset($_SESSION['flash_sukses']); ?>
                </div>
            <?php endif; ?>

            <form action="/proses-verifikasi-otp" method="POST">
                <input type="text" name="otp" placeholder="Masukkan 6 Digit OTP" required maxlength="6" style="text-align: center; letter-spacing: 5px; font-weight: bold; font-size: 20px;">
                <button type="submit" name="submit">Verifikasi Kode</button>
            </form>

            <p style="margin-top: 20px;">
                Salah email? <a href="/lupa-password">Kembali</a>
            </p>
        </div>
    </section>
</body>
</html>