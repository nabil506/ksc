<?php

namespace app\controller;

use app\config\Proteksi;
use app\model\RiwayatModel;

class RiwayatController
{

    public function riwayat()
    {

        Proteksi::proteksilogin();        
        // Cek role untuk menentukan data mana yang diambil
        if ($_SESSION['role_aktif'] === 'admin') {
            // Admin melihat semua pendaftaran
            $riwayat = RiwayatModel::getAllRiwayat();
        } else {
            // Atlit hanya melihat pendaftarannya sendiri
            $riwayat = RiwayatModel::getRiwayatByUserId($_SESSION['user_id']);
        }

        // Memuat tampilan riwayat
        require_once __DIR__ . '/../view/riwayat.php';
    }
}
