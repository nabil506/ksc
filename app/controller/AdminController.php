<?php

namespace app\controller;

use app\config\View;
use app\model\AdminModel;
use app\model\RegisterModel;

class AdminController
{
    public function manageUsers()
    {
        if (!isset($_SESSION['user']['role_name']) || $_SESSION['user']['role_name'] !== 'admin') {
            $_SESSION['flash_error'] = "Akses ditolak! Halaman khusus Admin.";
            header("Location: /dashboard");
            exit();
        }

        $data = [
            'users'        => AdminModel::getAllUsers(), // Data tabel
            'nama_lengkap' => $_SESSION['user']['nama_lengkap'], // Data sidebar
            'role_name'    => $_SESSION['user']['role_name'],    // Data sidebar
            'role'         => $_SESSION['user']['role_name']     // Untuk kondisi navigasi
        ];
        View::render('dashboard/admin_manage_users', $data);
    }

    public function updateStatus()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SESSION['user']['role_name'] === 'admin') {
            $userId = $_POST['user_id'];
            $statusBaru = $_POST['status_baru'];

            // Controller cukup memanggil Model dan menampung hasilnya (true/false)
            $status = AdminModel::updatestatus($statusBaru, $userId);

            // Pengecekan langsung menggunakan variabel $status tanpa sintaks database
            if ($status) {
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
        if (!isset($_SESSION['user']['role_name']) || $_SESSION['user']['role_name'] !== 'admin') {
            header("Location: /dashboard");
            exit();
        }
        require_once __DIR__ . '/../view/dashboard/admin_tambah_pelatih.php';
    }

    public function prosesTambahPelatih()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SESSION['user']['role_name'] === 'admin') {
            // Perbaikan penamaan variabel agar konsisten
            $nama_lengkap = htmlspecialchars(trim($_POST['nama'] ?? ''));
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'] ?? '';

            // Set null seperti yang kamu inginkan
            $id_role = 3;
            $umur = null;
            $no_wa = null;

            if (empty($nama_lengkap) || empty($email) || empty($password)) {
                $_SESSION['flash_error'] = "Semua kolom wajib diisi!";
                header("Location: /tambah-pelatih");
                exit();
            }



            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Proses insert ditangani 100% oleh Model (disimpan langsung ke tabel users)
            // Pastikan urutan parameternya: nama_lengkap, email, password, umur, no_wa, id_role
            $userId = RegisterModel::insert($nama_lengkap,$email,$umur,$no_wa,$hashedPassword, $id_role);

            if ($userId) {
                // HAPUS insertPelatihDetail karena tabelnya tidak ada
                $_SESSION['flash_sukses'] = "Akun Pelatih atas nama $nama_lengkap berhasil ditambahkan!";
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
