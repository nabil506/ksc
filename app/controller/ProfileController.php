<?php

namespace app\controller;

use app\config\Proteksi;
use app\config\View;
use app\model\ProfileModel;

class ProfileController
{

    public function profil()
    {
        Proteksi::proteksilogin();
        $user = $_SESSION['user'];
        View::render('dashboard/profil', $user);
    }

    public function prosesedit()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['user']['user_id'] ?? $_SESSION['user']['id'] ?? null;
            if (!$userId) {
                header("Location: /login");
                exit();
            }

            $dataUpdate = [];

            // 1. PROSES UPLOAD FOTO PROFIL
            if (isset($_FILES['foto_profile']) && $_FILES['foto_profile']['error'] !== UPLOAD_ERR_NO_FILE) {

                // Cek apakah ada error sistem dari PHP (Misal: ukuran file terlalu besar)
                if ($_FILES['foto_profile']['error'] !== UPLOAD_ERR_OK) {
                    $_SESSION['flash_error'] = "Upload gagal! Pastikan ukuran foto di bawah 2MB.";
                    header("Location: /profil");
                    exit();
                }

                $ext = pathinfo($_FILES['foto_profile']['name'], PATHINFO_EXTENSION);
                $fileName = 'profile_' . $userId . '_' . time() . '.' . $ext;

                // Tentukan lokasi penyimpanan (masuk ke dalam folder /profile/)
                $targetPath = $_SERVER['DOCUMENT_ROOT'] . '/app/images/profile/' . $fileName;
                if (move_uploaded_file($_FILES['foto_profile']['tmp_name'], $targetPath)) {
                    $dataUpdate['foto_profile'] = $fileName;
                } else {
                    // Error jika folder app/images/profile/ tidak ditemukan
                    $_SESSION['flash_error'] = "Gagal memindahkan foto. Pastikan folder /app/images/profile/ tersedia.";
                    header("Location: /profil");
                    exit();
                }
            }

            // 2. PROSES UPDATE UMUR
            if (!empty($_POST['umur'])) {
                if ($_POST['umur'] >= 70 || $_POST['umur'] <= 5) {
                    $_SESSION['flash_error'] = "Umur tidak valid! (Harus antara 6 - 70 tahun)";
                    header("Location: /profil");
                    exit();
                }
                $dataUpdate['umur'] = $_POST['umur'];
            }

            // 3. PROSES UPDATE NO WHATSAPP
            if (!empty($_POST['no_wa'])) {
                $dataUpdate['no_wa'] = htmlspecialchars($_POST['no_wa']);
            }

            // Jika form disubmit tapi benar-benar kosong
            if (empty($dataUpdate)) {
                $_SESSION['flash_error'] = "Tidak ada data yang diubah.";
                header("Location: /profil");
                exit();
            }

            // 4. EKSEKUSI KE DATABASE MENGGUNAKAN MODEL
            $biodata = ProfileModel::editprofil($dataUpdate, $userId);

            if ($biodata) {
                // Perbarui Session
                if (isset($dataUpdate['umur'])) $_SESSION['user']['umur'] = $dataUpdate['umur'];
                if (isset($dataUpdate['no_wa'])) $_SESSION['user']['no_wa'] = $dataUpdate['no_wa'];
                if (isset($dataUpdate['foto_profile'])) $_SESSION['user']['foto_profile'] = $dataUpdate['foto_profile'];

                $_SESSION['flash_sukses'] = "Data profil berhasil diperbarui!";
            } else {
                $_SESSION['flash_error'] = "Gagal memperbarui profil.";
            }

            header("Location: /profil");
            exit();
        }
    }
}
