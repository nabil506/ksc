<?php

namespace app\controller;

use app\model\BiodataModel;

class BiodataController
{
    public function prosesedit()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['user']['user_id'] ?? null;
            if (!$userId) {
                header("Location: /login");
                exit();
            }

            $dataUpdate = [];

            if (!empty($_POST['umur'])) {
                if ($_POST['umur'] >= 70 || $_POST['umur'] <= 5) {
                $_SESSION['flash_error'] = "Umur tidak valid! (Harus antara 6 - 70 tahun)";                    header("Location: /profil");
                    exit();
                }
                $dataUpdate['umur'] = $_POST['umur'];
            }

            if (!empty($_POST['no_wa'])) {
                $dataUpdate['no_wa'] = htmlspecialchars($_POST['no_wa']);
            }

            if (empty($dataUpdate)) {
                $_SESSION['flash_error'] = "Tidak ada data yang diubah.";
                header("Location: /profil");
                exit();
            }

            $biodata = BiodataModel::editprofil($dataUpdate, $userId);

            if ($biodata) {
                if (isset($dataUpdate['umur'])) $_SESSION['user']['umur'] = $dataUpdate['umur'];
                if (isset($dataUpdate['no_wa'])) $_SESSION['user']['no_wa'] = $dataUpdate['no_wa'];

                $_SESSION['flash_sukses'] = "Data profil berhasil diperbarui!";
            } else {
                $_SESSION['flash_error'] = "Gagal memperbarui profil.";
            }

            header("Location: /profil");
            exit();
        }
    }
}