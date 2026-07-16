<?php

namespace app\controller;

use app\model\ResetPasswordModel;
use app\config\View;
// Import class PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ResetPasswordController
{
    // ==========================================
    // TAHAP 1: KIRIM OTP
    // ==========================================
    public function OTP()
    {
        View::render('auth/lupa_password', []);
    }

    public function sendOtp()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';

            // 1. Cek apakah email ada di database KSC
            $user = ResetPasswordModel::checkEmailExists($email);

            if (!$user) {
                $_SESSION['flash_error'] = "Email tidak ditemukan di sistem KSC.";
                header("Location: /lupa-password");
                exit();
            }

            // 2. Buat 6 digit OTP acak dan waktu kedaluwarsa (15 menit)
            $otp = sprintf("%06d", mt_rand(1, 999999));
            $expired_at = date("Y-m-d H:i:s", strtotime("+15 minutes"));

            // 3. Simpan ke database
            if (ResetPasswordModel::saveOtp($email, $otp, $expired_at)) {

                // 4. Proses kirim email dengan PHPMailer
                $mail = new PHPMailer(true);

                try {
                    // --- KONFIGURASI SERVER EMAIL (SMTP) ---
                    $mail->isSMTP();
                    $mail->Host       = 'smtp.gmail.com';
                    $mail->SMTPAuth   = true;
                    $mail->Username   = 'balaikota789@gmail.com';

                    // 👇👇👇 GANTI BARIS DI BAWAH INI DENGAN 16 HURUF SANDI APLIKASI DARI GOOGLE 👇👇👇
                    $mail->Password   = 'wooazvetbuekqjth';

                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port       = 587;

                    // --- PENGIRIM DAN PENERIMA ---
                    $mail->setFrom('balaikota789@gmail.com', 'Admin KSC');
                    $mail->addAddress($email, $user['nama_lengkap']);

                    // --- KONTEN EMAIL ---
                    $mail->isHTML(true);
                    $mail->Subject = 'Kode OTP Reset Password - Krian Swimming Club';
                    $mail->Body    = "
                        <h3>Halo, {$user['nama_lengkap']}</h3>
                        <p>Kami menerima permintaan untuk mereset password akun KSC Anda.</p>
                        <p>Berikut adalah kode OTP Anda:</p>
                        <h2 style='background: #f4f4f4; padding: 10px; display: inline-block; letter-spacing: 5px; color: #0A4D8C;'>{$otp}</h2>
                        <p><i>Kode ini hanya berlaku selama 15 menit. Jangan berikan kode ini kepada siapa pun!</i></p>
                    ";

                    $mail->send();

                    // Simpan email ke session agar user tidak perlu mengetik ulang di halaman verifikasi
                    $_SESSION['reset_email'] = $email;

                    $_SESSION['flash_sukses'] = "Kode OTP telah dikirim ke email Anda.";
                    header("Location: /verifikasi-otp");
                    exit();
                } catch (Exception $e) {
                    $_SESSION['flash_error'] = "Gagal mengirim email OTP. Kesalahan: {$mail->ErrorInfo}";
                    header("Location: /lupa-password");
                    exit();
                }
            } else {
                $_SESSION['flash_error'] = "Terjadi kesalahan pada sistem. Silakan coba lagi.";
                header("Location: /lupa-password");
                exit();
            }
        }
    }

    // ==========================================
    // TAHAP 2: VERIFIKASI OTP
    // ==========================================
    public function verifyOtpPage()
    {
        if (!isset($_SESSION['reset_email'])) {
            header("Location: /lupa-password");
            exit();
        }

        // Kita bisa mengirim variabel email ke view jika dibutuhkan
        View::render('auth/verifikasi_otp', [
            'email' => $_SESSION['reset_email']
        ]);
    }

    public function processOtp()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $otp = trim($_POST['otp'] ?? '');
            $email = $_SESSION['reset_email'] ?? '';

            $isValid = ResetPasswordModel::verifyOtp($email, $otp);

            if ($isValid) {
                $_SESSION['otp_verified'] = true;
                header("Location: /reset-password");
                exit();
            } else {
                $_SESSION['flash_error'] = "Kode OTP salah atau sudah kedaluwarsa!";
                header("Location: /verifikasi-otp");
                exit();
            }
        }
    }

    // ==========================================
    // TAHAP 3: RESET PASSWORD BARU
    // ==========================================
    public function resetPasswordPage()
    {
        if (!isset($_SESSION['otp_verified']) || !isset($_SESSION['reset_email'])) {
            header("Location: /lupa-password");
            exit();
        }

        View::render('auth/reset_password', []);
    }

    public function processResetPassword()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $password = $_POST['password'] ?? '';
            $confirm_password = $_POST['confirm_password'] ?? '';
            $email = $_SESSION['reset_email'];

            if (strlen($password) < 6) {
                $_SESSION['flash_error'] = "Password minimal 6 karakter!";
                header("Location: /reset-password");
                exit();
            }

            if ($password !== $confirm_password) {
                $_SESSION['flash_error'] = "Konfirmasi password tidak cocok!";
                header("Location: /reset-password");
                exit();
            }

            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            if (ResetPasswordModel::updatePassword($email, $hashed_password)) {
                unset($_SESSION['reset_email']);
                unset($_SESSION['otp_verified']);

                $_SESSION['flash_sukses'] = "Password berhasil diubah! Silakan login dengan password baru.";
                header("Location: /login");
                exit();
            } else {
                $_SESSION['flash_error'] = "Gagal mengubah password. Silakan hubungi admin.";
                header("Location: /reset-password");
                exit();
            }
        }
    }
}
