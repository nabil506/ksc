<?php

namespace app\model;

use app\config\Database;
use PDOException;

class HomeModel
{

    // Method khusus untuk menghitung Atlit Aktif
    public static function getAtlitAktif()
    {
        try {
            $db = Database::getConnection();
            $query = "
            SELECT COUNT(*) as total 
            FROM users u
            JOIN roles r ON u.id_role = r.id
            WHERE r.role_name = 'atlit' AND u.status_anggota = 'Aktif'
        ";
            $stmt = $db->query($query);
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    public static function getPelatihAktif()
    {
        try {
            $db = Database::getConnection();
            $query = "
            SELECT COUNT(*) as total 
            FROM users u
            JOIN roles r ON u.id_role = r.id
            WHERE r.role_name = 'pelatih' AND u.status_anggota = 'Aktif'
        ";
            $stmt = $db->query($query);
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    public static function getDaftarPelatih()
    {
        try {
            $db = Database::getConnection();
            $query = "
                SELECT u.nama_lengkap 
                FROM users u
                JOIN roles r ON u.id_role = r.id
                WHERE r.role_name = 'pelatih' AND u.status_anggota = 'Aktif'
            ";
            return $db->query($query)->fetchAll(\PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}
