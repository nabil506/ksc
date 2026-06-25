<?php
namespace app\model;

use app\config\Database;

class RegisterModel {
    
    // Menyimpan akun ke tabel users
    public static function insert($email, $password, $role) {
        try {
            $db = Database::getConnection();
            $query = "INSERT INTO users (email, password, role) VALUES (?, ?, ?)";
            $stmt = $db->prepare($query);
            $stmt->execute([$email, $password, $role]);
            return $db->lastInsertId();
        } catch (\PDOException $e) {
            return false;
        }
    }

    // Menyimpan biodata Atlit
    public static function insertAtlitDetail($userId, $namaLengkap, $umur, $noWa) {
        try {
            $db = Database::getConnection();
            $query = "INSERT INTO atlit (user_id, nama_lengkap, umur, no_wa) VALUES (?, ?, ?, ?)";
            $stmt = $db->prepare($query);
            return $stmt->execute([$userId, $namaLengkap, $umur, $noWa]);
        } catch (\PDOException $e) {
            return false;
        }
    }

    // Menyimpan biodata Pelatih (Digunakan oleh Admin)
    public static function insertPelatihDetail($userId, $namaPelatih) {
        try {
            $db = Database::getConnection();
            $query = "INSERT INTO pelatih (user_id, nama_pelatih) VALUES (?, ?)";
            $stmt = $db->prepare($query);
            return $stmt->execute([$userId, $namaPelatih]);
        } catch (\PDOException $e) {
            return false;
        }
    }
}