<?php

namespace app\controller;

use app\config\Proteksi;
use app\config\View;
use app\model\RiwayatModel;

class RiwayatController
{
    public function riwayat()
    {
        Proteksi::proteksilogin();        
        
        // 1. Ambil session dengan cara yang benar
        $roleName = $_SESSION['user']['role_name'] ?? '';
        // Fallback untuk id (berjaga-jaga jika login memakai 'id' atau 'user_id')
        $userId = $_SESSION['user']['id'] ?? $_SESSION['user']['user_id'] ?? null;

        // 2. Cek role untuk menentukan data mana yang diambil
        if (strtolower($roleName) === 'admin') {
            // Admin melihat semua pendaftaran
            $riwayat = RiwayatModel::getAllRiwayat();
        } else {
            // Atlit (dan Pelatih) hanya melihat pendaftarannya sendiri
            $riwayat = RiwayatModel::getRiwayatByUserId($userId);
        }
        
        // 3. Siapkan semua data yang akan dikirim ke View
        $data = [
            'nama_lengkap'   => $_SESSION['user']['nama_lengkap'],
            'role_name'      => $roleName,
            'role'           => $roleName, // jaga-jaga kalau view masih pakai variabel $role
            'status_anggota' => $_SESSION['user']['status_anggota'],
            'riwayat'        => $riwayat // INI PENTING! Agar $riwayat bisa dilooping di view
        ];

        // 4. Render ke view
        View::render('dashboard/riwayat', $data);
    }
}