<?php

namespace app\controller;

use app\model\LoginModel;

class LoginController
{

    public function login()
    {
        require_once __DIR__ . '/../view/login.php';
    }
    // Fungsi untuk memproses data dari form login
    public function proseslogin()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            if (empty($email) || empty($password)) {
                $_SESSION['flash_error'] = "Email dan Password wajib diisi!";
                header("Location: /login");
                exit();
            }

            // 1. Ambil data akun dari database berdasarkan email lewat LoginModel
            $user = LoginModel::checkEmail($email);
            // 2. Verifikasi jika user ditemukan dan password bcrypt cocok
            if ($user && password_verify($password, $user['password'])) {

                // 3. Ambil data nama lengkap profil aslinya untuk dipajang di dashboard
                $profile = LoginModel::getProfileDetails($user['id'], $user['role']);
                $namaUser = $profile['nama_lengkap'] ?? 'User KSC';

                // 4. Set data penting ke dalam Session aplikasi
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['role_aktif'] = $user['role'];
                $_SESSION['nama_aktif'] = $namaUser;

                // TAMBAHKAN BARIS INI: Ambil status dari database users
                $_SESSION['status_aktif'] = $user['status_anggota'] ?? 'Aktif';

                if (isset($_POST['submit'])) {
                    header("Location: /dashboard");
                    exit();
                }
            } else {
                // Jika password salah atau email tidak terdaftar
                $_SESSION['flash_error'] = "Email atau Password salah!";
                header("Location: /login");
                exit();
            }
        }
    }

    // Fungsi tambahan untuk Logout
    public function logout()
    {
        // Hapus session login
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['role_aktif']);
        unset($_SESSION['nama_aktif']);

        $_SESSION['flash_sukses'] = "Anda berhasil keluar.";
        header("Location: /login");
        exit();
    }
}
