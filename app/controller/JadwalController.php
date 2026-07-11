<?php

namespace app\controller;

use app\config\View;
use app\config\Proteksi;
use app\model\JadwalModel;

class JadwalController
{
    public function jadwal()
    {
        Proteksi::proteksilogin();
        $user = $_SESSION['user'];
        $jadwalList = JadwalModel::getAllJadwal();
        $pelatihList = JadwalModel::getDaftarPelatih();

        // 3. Lempar datanya ke file view jadwal.php
        View::render(
            'dashboard/jadwal',
            [
                'user' => $user,
                'jadwalList' => $jadwalList,
                'pelatihList' => $pelatihList
            ]
        );
    }
    public function tambah()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $hari = $_POST['hari'];
            $waktu = $_POST['waktu'];
            $id_pelatih = $_POST['id_pelatih'];
            $kolam = $_POST['kolam'];
            $keterangan = $_POST['keterangan'];

            // Panggil fungsi model untuk menyimpan
            JadwalModel::tambahJadwal($hari, $waktu, $id_pelatih, $kolam, $keterangan);

            // Redirect kembali ke halaman jadwal
            header("Location: /jadwal");
            exit;
        }
    }

    // Menangkap kiriman ID untuk dihapus
    public function hapus()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            JadwalModel::hapusJadwal($_POST['id']);

            // Redirect kembali ke halaman jadwal
            header("Location: /jadwal");
            exit;
        }
    }
}
