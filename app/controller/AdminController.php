<?php
namespace app\controller;

use app\model\AdminModel;
use app\model\RegisterModel;

class AdminController
{
    public function manageUsers()
    {
        if (!isset($_SESSION['role_aktif']) || $_SESSION['role_aktif'] !== 'admin') {
            $_SESSION['flash_error'] = "Akses ditolak! Halaman khusus Admin.";
            header("Location: /dashboard");
            exit();
        }

        $users = AdminModel::getAllUsers();
        require_once __DIR__ . '/../view/admin_manage_users.php';
    }

    public function updateStatus()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SESSION['role_aktif'] === 'admin') {
            $userId = $_POST['user_id'];
            $statusBaru = $_POST['status_baru'];

            $status = AdminModel::updatestatus($statusBaru, $userId);            
            if ($stmt->execute([$statusBaru, $userId])) {
                $_SESSION['flash_sukses'] = "Status user berhasil diperbarui!";
            } else {
                $_SESSION['flash_error'] = "Gagal memperbarui status.";
            }

            header("Location: /manage-users");
            exit();
        }
    }

    public function tambahPelatih()
    {
        if (!isset($_SESSION['role_aktif']) || $_SESSION['role_aktif'] !== 'admin') {
            header("Location: /dashboard"); 
            exit();
        }
        require_once __DIR__ . '/../view/admin_tambah_pelatih.php';
    }

    public function prosesTambahPelatih()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SESSION['role_aktif'] === 'admin') {
            $nama = htmlspecialchars(trim($_POST['nama'] ?? ''));
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'] ?? '';

            if (empty($nama) || empty($email) || empty($password)) {
                $_SESSION['flash_error'] = "Semua kolom wajib diisi!";
                header("Location: /tambah-pelatih"); 
                exit();
            }

            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $userId = RegisterModel::insert($email, $hashedPassword, 'pelatih');

            if ($userId) {
                RegisterModel::insertPelatihDetail($userId, $nama);
                $_SESSION['flash_sukses'] = "Akun Pelatih atas nama $nama berhasil ditambahkan!";
                header("Location: /manage-users");
                exit();
            } else {
                $_SESSION['flash_error'] = "Gagal! Email mungkin sudah digunakan.";
                header("Location: /tambah-pelatih");
                exit();
            }
        }
    }
}