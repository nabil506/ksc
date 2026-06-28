<?php

namespace app\controller;

use app\model\RiwayatModel;

class RiwayatController
{

    public function riwayat()
    {

        // Pastikan user sudah login
        if (!isset($_SESSION['user_id']) || !isset($_SESSION['role_aktif'])) {
            header("Location: /login");
            exit();
        }

        // Cek role untuk menentukan data mana yang diambil
        if ($_SESSION['role_aktif'] === 'admin') {
            // Admin melihat semua pendaftaran
            $riwayat = \app\model\RiwayatModel::getAllRiwayat();
        } else {
            // Atlit hanya melihat pendaftarannya sendiri
            $riwayat = \app\model\RiwayatModel::getRiwayatByUserId($_SESSION['user_id']);
        }

        // Memuat tampilan riwayat
        require_once __DIR__ . '/../view/riwayat.php';
    }
}
