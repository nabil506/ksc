<?php

namespace app\controller;

use app\model\LoginModel;

class LoginController
{

    public function login()
    {
        require_once __DIR__ . '/../view/login.php';
    }
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
            if ($user && password_verify($password, $user['password'])) {

                $profile = LoginModel::getProfileDetails($user['id'], $user['role']);
                $namaUser = $profile['nama_lengkap'] ?? 'User KSC';

                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['role_aktif'] = $user['role'];
                $_SESSION['nama_aktif'] = $namaUser;

                $_SESSION['status_aktif'] = $user['status_anggota'] ?? 'Nonaktif';

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
