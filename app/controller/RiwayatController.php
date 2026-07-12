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
        
        $user = $_SESSION['user'];

        // 2. Cek role untuk menentukan data mana yang diambil
        if (strtolower($user['role_name']) === 'admin') {
            // Admin melihat semua pendaftaran
            $riwayat = RiwayatModel::getAllRiwayat();
        } else {
            // Atlit (dan Pelatih) hanya melihat pendaftarannya sendiri
            $riwayat = RiwayatModel::getRiwayatByUserId($user['user_id']);
        }
        
        $data = [
            'riwayat'        => $riwayat 
        ];

        View::render('dashboard/riwayat', 
        [
            'data' => $data,
            'user' => $user,
        ]
            );
    }
}