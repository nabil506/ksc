<?php

namespace app\controller;

use app\model\LoginModel;

class LoginController
{

    public function login()
    {
        require_once __DIR__ . '/../view/auth/login.php';
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

            $user = LoginModel::checkEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user'] = [
                    'user_id' => $user['id'],
                    'nama_lengkap' => $user['nama_lengkap'],
                    'email' => $user['email'],
                    'password' => $user['password'],
                    'id_role' => $user['id_role'],
                    'umur' => $user['umur'],
                    'no_wa' => $user['no_wa'],
                    'status_anggota' => $user['status_anggota'] ?? 'Nonaktif',
                    'role_name' => $user['role_name'],
                ];

                header("Location: /dashboard");
                exit();
            } else {
                $_SESSION['flash_error'] = "Email atau Password salah!";
                header("Location: /login");
                exit();
            }
        }
    }


    public function logout()
    {
        // 1. Kosongkan semua data di memori
        $_SESSION = [];
        session_unset();

        // 2. Hancurkan file sesi di server (benar-benar kiamat untuk sesi ini)
        session_destroy();

        // 3. MULAI SESI BARU khusus untuk mengirim pesan bahwa logout berhasil
        session_start();
        $_SESSION['flash_sukses'] = "Anda berhasil keluar dari sistem.";

        // 4. Lempar kembali ke halaman login
        header("Location: /login");
        exit();
    }
}
