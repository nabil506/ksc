<?php
namespace app\controller; 

use app\model\RegisterModel;

class RegisterController
{
    public function register()
    {
        require_once __DIR__ . '/../view/daftar.php';
    }

    public function prosesregister()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama = htmlspecialchars(trim($_POST['nama'] ?? ''));
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';
            
            // Otomatis diset menjadi atlit
            $role = 'atlit';
            $umur = 0;
            $no_wa = '-';

            if (empty($nama) || empty($email) || empty($password) || empty($confirmPassword)) {
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
            $userId = RegisterModel::insert($email, $hashedPassword, $role);

            if ($userId) {
                $detailSaved = RegisterModel::insertAtlitDetail($userId, $nama, $umur, $no_wa);

                if ($detailSaved) {
                    $_SESSION['flash_sukses'] = "Pendaftaran Atlit Berhasil! Silakan Login.";
                    header("Location: /login");
                    exit();
                }
            }

            $_SESSION['flash_error'] = "Pendaftaran Gagal! Email mungkin sudah digunakan.";
            header("Location: /register");
            exit();
        }
    }
}