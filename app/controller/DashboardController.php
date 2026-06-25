<?php

namespace app\controller;

use app\model\JadwalModel;
use app\model\EventModel;

class DashboardController
{
    // Fungsi bantuan untuk mengecek hak akses
    private function cekRole($roleDiizinkan)
    {
        // Pastikan user sudah login
        if (!isset($_SESSION['role_aktif'])) {
            header("Location: /login");
            exit();
        }

        // Jika role user saat ini tidak ada di daftar yang diizinkan
        if (!in_array($_SESSION['role_aktif'], $roleDiizinkan)) {
            $_SESSION['flash_error'] = "Kamu tidak memiliki akses ke halaman ini!";
            header("Location: /dashboard"); // Lempar kembali ke beranda
            exit();
        }
    }

    public function jadwal()
    {
        // Semua role bisa lihat jadwal (Admin, Pelatih, Atlit)
        $this->cekRole(['admin', 'pelatih', 'atlit']); 
        
        // AMBIL DATA DINAMIS DARI DATABASE
        // $jadwalList = JadwalModel::getAllJadwal(); 
        
        require_once __DIR__ . '/../view/jadwal.php';
    }

    public function manageAdmin()
    {
        // HANYA ADMIN yang bisa masuk halaman ini
        $this->cekRole(['admin']); 
        
        require_once __DIR__ . '/../view/admin/manage_users.php';
    }
}