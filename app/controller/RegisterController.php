<?php
namespace app\controller; 

use app\model\RegisterModel;

class RegisterController
{
    public function register()
    {
        require_once __DIR__ . '/../view/auth/daftar.php';
    }

    public function prosesregister()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama_lengkap = htmlspecialchars(trim($_POST['nama'] ?? ''));
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';
            
            // ID Role 2 = atlit (berdasarkan tabel roles di database)
            $id_role_atlit = 2;
            
            // Set null agar kosong (bisa diisi nanti di profil)
            $umur = null;
            $no_wa = null;

            if (empty($nama_lengkap) || empty($email) || empty($password) || empty($confirmPassword)) {
                $_SESSION['flash_error'] = "Semua kolom wajib diisi!";
                header("Location: /register");
                exit();
            }

            if ($password !== $confirmPassword) {
                $_SESSION['flash_error'] = "Konfirmasi password tidak cocok!";
                header("Location: /register");
                exit();
            }

            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            
            // Lakukan 1 kali INSERT saja
            $userId = RegisterModel::insert($nama_lengkap, $email, $umur, $no_wa, $hashedPassword, $id_role_atlit);

            if ($userId) {
                // Tidak perlu lagi memanggil insertAtlitDetail
                $_SESSION['flash_sukses'] = "Pendaftaran Atlit Berhasil! Silakan Login.";
                header("Location: /login");
                exit();
            }

            $_SESSION['flash_error'] = "Pendaftaran Gagal! Email mungkin sudah digunakan.";
            header("Location: /register");
            exit();
        }
    }
}