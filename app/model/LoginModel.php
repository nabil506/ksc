<?php

namespace app\model;

use app\config\Database;

class LoginModel
{

    public static function checkEmail($inputLogin)
    {
        try {
            $db = Database::getConnection();

            // 1. Cari dulu user berdasarkan email di tabel users
            $query = "SELECT * FROM users WHERE email = ?";
            $stmt = $db->prepare($query);
            $stmt->execute([$inputLogin]);
            $user = $stmt->fetch();

            if ($user) return $user;

            // 2. Jika tidak ketemu, cari berdasarkan nama di tabel atlit
            $queryAtlit = "SELECT users.* FROM users JOIN atlit ON users.id = atlit.user_id WHERE atlit.nama_lengkap = ?";
            $stmtAtlit = $db->prepare($queryAtlit);
            $stmtAtlit->execute([$inputLogin]);
            $userAtlit = $stmtAtlit->fetch();

            if ($userAtlit) return $userAtlit;

            // 3. Jika belum ketemu, cari berdasarkan nama di tabel pelatih
            $queryPelatih = "SELECT users.* FROM users JOIN pelatih ON users.id = pelatih.user_id WHERE pelatih.nama_pelatih = ?";
            $stmtPelatih = $db->prepare($queryPelatih);
            $stmtPelatih->execute([$inputLogin]);
            $userPelatih = $stmtPelatih->fetch();
            
            // Kembalikan hasil temuan (jika tidak ketemu, akan mengembalikan false otomatis)
            return $userPelatih;

        } catch (\PDOException $e) {
            return false;
        }
    }

    public static function getProfileDetails($userId, $role)
    {
        try {
            $db = Database::getConnection();

            // Jika role pelatih, ambil dari tabel pelatih dengan kolom 'nama_pelatih'
            if ($role === 'pelatih') {
                $query = "SELECT nama_pelatih AS nama_lengkap FROM pelatih WHERE user_id = ?";
            } else {
                // Untuk atlit maupun admin, ambil dari tabel atlit
                $query = "SELECT nama_lengkap FROM atlit WHERE user_id = ?";
            }

            $stmt = $db->prepare($query);
            $stmt->execute([$userId]);
            $result = $stmt->fetch();

            if ($result && !empty($result['nama_lengkap'])) {
                return $result;
            }

            return ['nama_lengkap' => $role === 'admin' ? 'Admin KSC' : 'Anggota KSC'];
        } catch (\PDOException $e) {
            return ['nama_lengkap' => 'User KSC'];
        }
    }
}