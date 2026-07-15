<?php

namespace app\model;

use app\config\Database;
use PDOException;

class RegisterModel
{

    // Menyimpan akun ke tabel users
    public static function insert($namalengkap, $email, $umur, $no_wa, $password, $id_role)
    {
        try {
            $db = Database::getConnection();
            $query = "INSERT INTO users (nama_lengkap, email, umur, no_wa, password, id_role) VALUES (?,?,?,?, ?, ?)";
            $stmt = $db->prepare($query);
            $stmt->execute([$namalengkap, $email, $umur, $no_wa, $password, $id_role]);
            return $db->lastInsertId();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}
